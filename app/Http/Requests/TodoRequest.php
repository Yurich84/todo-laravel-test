<?php

namespace App\Http\Requests;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            Todo::COLUMN_NAME           => 'required',
            Todo::COLUMN_DESCRIPTION    => 'required',
            Todo::COLUMN_DATE           => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            Todo::COLUMN_NAME.'.required' => 'A name is required',
            Todo::COLUMN_DESCRIPTION.'.required'  => 'A description is required',
            Todo::COLUMN_DATE.'.required'  => 'A date is required',
        ];
    }
}
