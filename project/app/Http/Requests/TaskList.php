<?php

namespace App\Http\Requests;

class TaskList extends APIRequest
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
            'title'       => 'max:255',
            'description' => 'max:255',
            'order_by'    => 'in:title,-title,description,-description'
        ];
    }
}
