<?php

namespace App\Notifications;

use App\Dto\SendEmailDto;
use App\Mail\ForgotPassword;
use App\Repository\EmailTiposRepository;
use App\Service\V1\EmailTiposService;
use App\Service\V1\EmailService;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{

    const FORGOT_EMAIL = 1;
    private $emailTiposService;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;
    private $path;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, $path)
    {
        $this->token = $token;
        $this->path = $path;
        $this->emailTiposService = new EmailTiposService(new EmailTiposRepository());
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $emailTo = $notifiable->getEmailForPasswordReset();

        $email = new EmailService();

        //Obtengo datos de email tipo
        $emailTipoObject = $this->emailTiposService->find(self::FORGOT_EMAIL);
        $template = new ForgotPassword($notifiable->nombre,$notifiable->apellido,$emailTo,$this->token,$emailTipoObject->template,request()->headers->get('origin'),$this->path);

        $data["to"] = $emailTo;
        $data["subject"] = $emailTipoObject->subject;
        $data["type"] = self::FORGOT_EMAIL;
        $data["files"] = [];
        $data["body"]["type"] = "html";
        $data["body"]["content"] = $template->render();
        $data["userId"] = $notifiable->id;

        $dto = new SendEmailDto($data);

        $email->sendEmail($dto);

        //TODO Devuelvo el template porq es lo que solicita la clase.
        return $template;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
