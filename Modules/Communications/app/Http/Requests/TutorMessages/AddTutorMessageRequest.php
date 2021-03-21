<?php

namespace Modules\Communications\Http\Requests\TutorMessages;

use Illuminate\Foundation\Http\FormRequest;

class AddTutorMessageRequest extends FormRequest
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
        $rules = [
            'message' => 'required',
            'tutor' => 'required'
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'message.required' => 'The communication name is required',
        ];
    }
}
