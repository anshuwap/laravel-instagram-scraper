<?php

namespace App\Http\Requests\Scraper;

use Illuminate\Foundation\Http\FormRequest;

class File extends FormRequest
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
            'select-robot' => 'required',
            'pagesFile' => 'required',
        ];
    }
}
