<?php

namespace App\Http\Requests\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'number' => 'required',
            'password' => 'alphaNum|min:6|required_with:password_conf|same:password_conf',
            'password_conf' => 'min:6'
        ];
    }
}
