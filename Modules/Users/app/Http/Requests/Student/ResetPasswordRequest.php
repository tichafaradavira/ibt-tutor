<?php

namespace Modules\Users\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'email' => 'email|required',
            'password' => 'required:min:8',
        ];


    }

    public function messages()
    {
        return [
            'password.required' => 'The password required',
            'password.min' => 'The password needs a minimum of 8 characters ',
            'email.required' => 'The email address is required',
            'email.email' => 'The email address should be a valid email',
        ];
    }
}
