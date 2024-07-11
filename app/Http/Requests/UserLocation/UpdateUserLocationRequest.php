<?php

namespace App\Http\Requests\UserLocation;

use App\Enums\Area;
use App\Enums\Attendance;
use App\Enums\UserStatus;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateUserLocationRequest extends FormRequest
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
            User::AREA_ID => [Rule::enum(Area::class)->except([Area::NONE])],
            User::ATTENDANCE_ID => [Rule::enum(Attendance::class)->except([Attendance::NONE])],
            User::USER_STATUS_ID => [Rule::enum(UserStatus::class)->except([UserStatus::NONE])],
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
