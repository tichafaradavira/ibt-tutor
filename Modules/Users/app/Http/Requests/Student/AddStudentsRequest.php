<?php

namespace Modules\Users\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class AddStudentsRequest extends FormRequest
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
        //todo make sure validation occurs
        $rules = [];
        $students = $this->input();
        for($i = 0 ; $i > sizeof($students); $i++ ){
            $rules[$i.'.first_name'] = 'required|max:255';
            $rules[$i.'.last_name'] = 'required|max:255';
            $rules[$i.'.email'] = 'email|required|unique:Modules\Users\Models\User,email';
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name is required',
            'last_name.required' => 'The last is required',
            'email.required' => 'The email address is required',
            'email.email' => 'The email address should be a valid email',
        ];
    }
}
