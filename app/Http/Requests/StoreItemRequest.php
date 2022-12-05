<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'serie' => ['nullable', 'string', 'unique:App\Models\Item'],
            'cne_code' => ['nullable', 'integer', 'digits:7', 'unique:App\Models\Item'],
            'processor' => ['nullable', 'string', 'min:1'],
            'ram' => ['nullable', 'string', 'max:255'],
            'disk' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                //'slug' => Str::slug($this->slug),
                'name' => trim($this->nombre),
                'brand' => trim($this->marca),
                'model' => trim($this->modelo),
                'serie' => trim($this->serie),
                'cne_code' => trim($this->codigo_cne),
                'processor' => trim($this->procesador),
                'ram' => trim($this->ram),
                'disk' => trim($this->disco),
                'state' => trim($this->estado),
            ]
        );
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'brand' => 'Marca',
            'model' => 'Modelo',
            'serie' => 'Serie',
            'cne_code' => 'Codigo de CNE',
            'processor' => 'Procesador',
            'ram' => 'Ram',
            'disk' => 'Disco',
            'state' => 'Estado',
        ];
    }
}
