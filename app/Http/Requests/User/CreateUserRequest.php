<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            User::USER_NAME => ['required', 'max:255'],
            User::USER_NAME_KANA => ['required', 'max:255'],
            User::MAIL_ADDRESS => ['required', 'max:255'],
            User::PASSWORD => ['required', 'max:255'],
            User::IS_ADMIN => ['required'],
            User::DEFAULT_AREA_ID => ['required']
        ];
    }

    /**
     * エラーハンドリング
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->unprocessableEntityResponse($validator->errors()->toArray()));
    }
}
