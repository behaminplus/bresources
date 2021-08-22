<?php

namespace Behamin\BResources\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Validation\ValidationException;

class BasicRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, apiResponse()->status(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->errors(
                $validator->errors()->first(),
                $validator->errors()->toArray()
            )->get(), $this->errorBag);
    }
}
