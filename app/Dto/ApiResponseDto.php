<?php

namespace App\Dto;

use App\Dto\BaseDto;

class ApiResponseDto extends BaseDto
{
    protected $status;
    protected $code;
    protected $message;
    protected $result;
    protected $token;
    protected $errors;

    public static function okStructure()
    {
        return ["status", "code", "message", "result"];
    }

    public static function errorStructure()
    {
        return ["status", "code", "message", "errors"];
    }

    public function response(int $code, mixed $result = false , string $message = null , array|bool $token = false)
    {
        $attributes =[];
        $attributes["status"] = "success";
        $attributes["code"] = $code;
        if ($token){
            $attributes["token"] = $token;
        }
        if ($result){
            $attributes["result"] = $result;
        }

        if ($message !== null ) {
            $attributes["message"] = $message;
        } else {
            switch ($code) {
                case 200:
                    $attributes["message"] = "La solicitud ha tenido éxito.";
                    break;
                case 201:
                    $attributes["message"] = "El recurso se creo correctamente.";
                    break;
                default:
                    $attributes["message"] = "Se ha producido un error";
            }
        }

        $this->fillCustom($attributes);
        return $this->send();
    }

    public function responseError( int $code , string $message = null , $errors =[] , $model = null )
    {
        $attributes =[];
        $attributes["status"] = "ERROR";
        $attributes["code"] = $code;

        if ( !empty($errors) ) {
            $attributes["errors"] = $errors;
        }

        if ($message !== null ) {
            $attributes["message"] = $message;
        } else {
            switch ($code) {
                case 400:
                    $attributes["message"] = "Solicitud incorrecta.";
                    break;
                case 401:
                    $attributes["message"] = "Usuario no autorizado.";
                    break;
                case 403:
                    $attributes["message"] = "El Usuario no tiene permisos para esta action.";
                    break;
                case 404:
                    $attributes["message"] = "Objeto $model no encontrado.";
                    break;
                default:
                    $attributes["message"] = $message;
            }
        }
        $this->fillCustom($attributes);
        return $this->send();
    }

    private function send(){
        return response()->json($this, $this->code);
    }

}
