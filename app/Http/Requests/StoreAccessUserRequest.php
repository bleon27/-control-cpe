<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidarIdentificacion;

class StoreAccessUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_names' => ['required', 'string'],
            'ci' => ['required', 'digits:10', 'unique:App\Models\AccessUser'],
            'document_number' => ['nullable', 'digits:9', 'unique:App\Models\AccessUser'],
            'unit' => ['required', 'string'],
            'position' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                //'slug' => Str::slug($this->slug),
                'full_names' => trim($this->nombres_completos),
                'ci' => trim($this->cedula),
                'document_number' => trim($this->numero_documento),
                'unit' => trim($this->unidad),
                'position' => trim($this->cargo),
            ]
        );
    }

    public function attributes()
    {
        return [
            'full_names' => 'Nombres Completos',
            'ci' => 'Cédula',
            'document_number' => 'Número de Documentó',
            'unit' => 'Unidad',
            'position' => 'Cargo',
        ];
    }
}
