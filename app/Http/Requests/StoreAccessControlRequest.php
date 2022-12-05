<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidarIdentificacion;

class StoreAccessControlRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'identificacion' => ['required', 'digits_between:9,10', new ValidarIdentificacion],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                //'slug' => Str::slug($this->slug),
                'identificacion' => trim($this->identificacion),
            ]
        );
    }
}
