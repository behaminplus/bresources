<?php

namespace Behamin\BResources\Requests;

use BResources\Resources\BasicResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BasicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(new BasicResource([
            'message' => "Validation Error!",
            'errors' => $validator->errors()
        ]), 422));
    }
}
