<?php

namespace App\Exceptions;

use App\Dto\ApiResponseDto;
use App\Exceptions\Api\UnauthorizedException;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\BackedEnumCaseNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Exceptions\Api\Exception;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        if(!env('IGNORE_HANDLER')){
            $this->renderable(function (ModelNotFoundException $e) {
                $explode = explode('\\', $e->getModel());
                return (new ApiResponseDto)->responseError(Response::HTTP_NOT_FOUND, null, true, end($explode));
            });

            $this->renderable(function (MethodNotAllowedHttpException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_METHOD_NOT_ALLOWED, $e->getMessage());
            });

            $this->renderable(function (NotFoundHttpException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_NOT_FOUND, $e->getMessage());
            });

            // ACA TOMA LOS MSJS CUSTOM DE EXCEPTION
            $this->renderable(function (Exception $e) {
                return (new ApiResponseDto)->responseError($e->getCode() === 500 ? Response::HTTP_BAD_REQUEST : $e->getCode(), $e->getMessage());
            });

            $this->renderable(function (AuthenticationException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_UNAUTHORIZED);
            });

            $this->renderable(function (RoleDoesNotExist $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_BAD_REQUEST, "Rol Inexistente.");
            });

            $this->renderable(function (UnauthorizedException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_BAD_REQUEST, "Usuario no autorizado.");
            });


            $this->renderable(function (ErrorException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, "Error interno del sistema.");
            });

            $this->renderable(function (QueryException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, "Error interno del sistema. SQL");
            });

            $this->renderable(function (TooManyRequestsException $e) {
                return (new ApiResponseDto)->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, "Demasiadas peticiones en poco tiempo");
            });

        }
    }

    protected function prepareException(Throwable $e)
    {
        // las cosas que se declaran y las puede tomar el default dejarlas porque laravel lo maneja raro y no funciona bien.
        return match (true) {
            $e instanceof BackedEnumCaseNotFoundException => new NotFoundHttpException($e->getMessage(), $e),
            $e instanceof ModelNotFoundException => $e,
            $e instanceof TokenMismatchException => new HttpException(419, $e->getMessage(), $e),
            $e instanceof SuspiciousOperationException => new NotFoundHttpException('Bad hostname provided.', $e),
            $e instanceof RecordsNotFoundException => new NotFoundHttpException('Not found.', $e),
            default => $e,
        };
    }

}
