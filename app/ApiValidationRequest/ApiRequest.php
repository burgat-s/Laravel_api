<?php

namespace App\ApiValidationRequest;

use App\Dto\ApiResponseDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiRequest extends FormRequest
{
    /**
     * Get the failed validation response for the request.
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        $transformed = [];

        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }
        return  (new ApiResponseDto)->responseError(Response::HTTP_BAD_REQUEST,null,$transformed);
    }

    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->response(
            $this->formatErrors($validator)
        ));
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->getMessageBag()->toArray();
    }
}
