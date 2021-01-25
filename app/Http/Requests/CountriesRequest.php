<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountriesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.ar'       => 'required',
            'name.en'       => 'required',
            'mob'           => 'required',
            'code'          => 'required',
            'currency.ar'   => 'required',
            'currency.en'   => 'required',
            // 'logo'          => 'required'
        ];
    }
}
