<?php

namespace App\Http\Requests\Robots;

use Illuminate\Foundation\Http\FormRequest;

class updateRobot extends FormRequest
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
            'username' => 'nullable|min:3',
            'password' => 'nullable|min:3',
            'proxy' => 'nullable|min:3',
        ];
    }
}
