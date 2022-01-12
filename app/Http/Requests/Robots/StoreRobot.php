<?php

namespace App\Http\Requests\Robots;

use Illuminate\Foundation\Http\FormRequest;

class StoreRobot extends FormRequest
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
            'username' => 'required|min:4',
            'password' => 'required|min:4',
            'proxy' => 'required|min:4'
        ];
    }
}
