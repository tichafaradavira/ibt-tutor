<?php

namespace Modules\Users\Http\Requests\Tutor;

use Illuminate\Foundation\Http\FormRequest;

class UserSignUpRequest extends FormRequest
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

        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'email|required',
        'dob' => '',
        'country' => '',
        'language' => '',
        'phone_number' => 'required',
        'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name is required',
            'last_name.required' => 'The last is required',
            'email.required' => 'The email address is required',
            'email.email' => 'The email address should be a valid email',
            'password.min' => 'The password should have a minimum of 8 characters.',
        ];
    }
}
