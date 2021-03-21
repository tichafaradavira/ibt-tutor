<?php

namespace Modules\Users\Http\Requests\Tutor;

use Illuminate\Foundation\Http\FormRequest;

class EditTutorRequest extends FormRequest
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
        'dob' => 'required',
        'country' => 'required',
        'language' => 'required',
        'phone_number' => '',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name is required',
            'last_name.required' => 'The last is required',
        ];
    }
}
