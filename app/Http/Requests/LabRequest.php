<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:1,40',
            'capacity' => 'numeric',
            'program' => 'image',
            'location' => 'string',
            'supervisor' => 'string'
        ];
    }
}
