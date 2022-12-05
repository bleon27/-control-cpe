<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    use PasswordValidationRules;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'names' => ['required', 'string','max:255'],
            'surnames' => ['required', 'string','max:255'],
            'ci' => ['required', 'digits:10', 'unique:App\Models\User'],
            'email' =>['required','string','email','max:255', 'unique:App\Models\User'],
            'unit' => ['required', 'string','max:255'],
            'role_id' => ['required', 'integer', 'min:1', Rule::exists('App\Models\Role', 'id')],
            'position' => ['required', 'string','max:255'],
            'password' => ['required', $this->passwordRules()],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                //'slug' => Str::slug($this->slug),
                'names' => trim($this->nombres_completos),
                'surnames' => trim($this->nombres_completos),
                'email' => trim($this->correo),
                'ci' => trim($this->cedula),
                'unit' => trim($this->unidad),
                'position' => trim($this->cargo),
                'role_id' => trim($this->rol),
                'password' => trim($this->contrasena),
                'password_confirmation' => trim($this->confirmar_contrasena),
            ]
        );
    }

    public function attributes()
    {
        return [
            'names' => 'Nombres Completos',
            'surnames' => 'Nombres Completos',
            'email' => 'Correo',
            'ci' => 'Cédula',
            'unit' => 'Unidad',
            'position' => 'Cargo',
            'role_id' => 'Rol',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmar Contraseña
            ',
        ];
    }
}
