<?php
/*
 *
 * Project: Safit
 * File:    EmailService.php
 * Date:   2/8/21 10:04
 * Time:   10 : 4
 *
 * @author           Nelson Gerardo Palacios <npalacios@sugit.com.ar>
 * @version         2021
 */

namespace App\Service\V1;

use App\Dto\SendEmailDto;
use App\Entities\Eloquent\Email;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\Exception;
use App\Mail\ForgotPassword;
use App\Repository\EmailRepository;
use App\Repository\EmailTiposRepository;
use App\Service\BaseService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException as GuzzleError;
use Illuminate\Support\Facades\Validator;


class EmailService extends BaseService
{
    const TIMEOUT_SEGUNDOS = 30;
    const FORGOT_EMAIL = 1;
    private $client;
    private $host;
    private $token;
    private $username;
    private $sendMethod;
    private $emailRepository;
    private $external_id;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => self::TIMEOUT_SEGUNDOS,
            'allow_redirects' => false,
        ]);

        $this->host = config("mail.empsat.host");
        $this->token = config("mail.empsat.token");
        $this->username = config("mail.empsat.username");
        $this->sendMethod = config("mail.empsat.send_method");

        $this->emailRepository = new EmailRepository();
        $this->emailTiposService = new EmailTiposService(new EmailTiposRepository());
    }

    public function envioMailReseteoPassword($user, string $path): void
    {
        $emailTo = $user->getEmailForPasswordReset();
        $emailTipoObject = $this->emailTiposService->find(self::FORGOT_EMAIL);
        $template = new ForgotPassword($user->nombre, $user->apellido, $emailTo, $this->token, $emailTipoObject->template, request()->headers->get('origin'),$path);

        $data["to"] = $emailTo;
        $data["subject"] = $emailTipoObject->subject;
        $data["type"] = self::FORGOT_EMAIL;
        $data["files"] = [];
        $data["body"]["type"] = "html";
        $data["body"]["content"] = $template->render();
        $data["userId"] = $user->id;

        $dto = new SendEmailDto($data);

        $this->sendEmail($dto);
    }

    public function sendEmail(SendEmailDto $sendEmailDto)
    {
        try {

            $params = [
                "token" => $this->token,
                "system" => $this->username,
                "to" => $sendEmailDto->getTo(),
                "subject" => $sendEmailDto->getSubject(),
                "type" => $sendEmailDto->getType(),
                "files" => [], //TODO ver la posibilidad de esto mejorarlo
                "body" => [
                    "type" => $sendEmailDto->getBody()["type"],
                    "content" => base64_encode($sendEmailDto->getBody()["content"])
                ]
            ];
            $this->validateRequest($params);

            $emailArray = $this->makeEmailArray($sendEmailDto);

            $emailObject = $this->emailRepository->create($emailArray);

            $params["external_id"] = $this->external_id = $emailObject->id;

            $response = $this->client->post($this->host . "/" . $this->sendMethod,
                [
                    'json' => $params
                ]
            );
            return $this->validateResponse($response->getBody()->getContents(), $params);

        } catch (GuzzleError $e) {

            $mensaje = $e->getResponse()->getBody()->getContents();
            $codigo = $e->getResponse()->getStatusCode();

            $this->emailRepository->update(["microservice_response" => $mensaje,
                "status" => Email::EMAIL_ERROR],
                $this->external_id);

            throw new Exception($mensaje, $codigo);
        }

    }

    private function validateRequest($params)
    {
        $validator = Validator::make($params, [
            'token' => 'required',
            'system' => 'required',
            'to' => 'required',
            'subject' => 'required',
            'type' => 'required',
            'body.type' => 'required',
            'body.content' => 'required',
        ]);
        if ($validator->fails()) {
            throw new BadRequestException("Parametros para enviar el email inválidos");
        }
    }

    private function makeEmailArray(SendEmailDto $sendEmailDto)
    {
        $emailArray["body"] = $sendEmailDto->getBody()["content"];
        $emailArray["subject"] = $sendEmailDto->getSubject();
        $emailArray["creation_date"] = now();
        $emailArray["to_email"] = $sendEmailDto->getTo();
        $emailArray["email_tipo_id"] = $sendEmailDto->getType();
        $emailArray["modification_date"] = null;
        $emailArray["usuario_id"] = $sendEmailDto->getUserId();
        $emailArray["attempts"] = null;
        $emailArray["status"] = null;
        $emailArray["attach"] = null;
        $emailArray["sent_date"] = now();
        return $emailArray;
    }

    private function validateResponse($response, $params)
    {

        $respuesta = json_decode($response, true);

        $this->emailRepository->update(["microservice_response" => $respuesta,
            "status" => Email::EMAIL_ENVIADO,
            'email_id'=>$respuesta['response']['email_id']],
            $params["external_id"]);

        return $respuesta;
    }


}
