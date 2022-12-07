<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //dd(Rule::unique('access_users', 'ci')->ignore($this->cedula, 'ci'));
        return [
            'names' => ['required', 'string','max:255'],
            'surnames' => ['required', 'string','max:255'],
            'ci' => ['required', 'digits:10', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'unit' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                //'slug' => Str::slug($this->slug),
                'names' => trim($this->nombres),
                'surnames' => trim($this->apellidos),
                'email' => trim($this->correo),
                'ci' => trim($this->cedula),
                'unit' => trim($this->unidad),
                'position' => trim($this->cargo),
            ]
        );
    }

    public function attributes()
    {
        return [
            'full_names' => 'Nombres Completos',
            'email' => 'Correo',
            'ci' => 'Cédula',
            'unit' => 'Unidad',
            'position' => 'Cargo',
        ];
    }
}
