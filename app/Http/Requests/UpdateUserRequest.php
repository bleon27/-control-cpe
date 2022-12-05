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
            'role_id' => ['required', 'integer', 'min:1', Rule::exists('App\Models\Role', 'id')],
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
                'role_id' => trim($this->rol),
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
            'role_id' => 'Rol',
        ];
    }
}
