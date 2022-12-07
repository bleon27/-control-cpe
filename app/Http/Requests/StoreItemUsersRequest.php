<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\AccessUser;

class StoreItemUsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $accessUser = new AccessUser;
        $tableAccessUser = $accessUser->getTable();

        return [
            'access_user_id' => ["exists:$tableAccessUser,id"],
            'observation' => ["max:255", 'string', 'nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'access_user_id' => trim($this->idCliente),
                'observation' => trim($this->observacion),
            ]
        );
    }

    public function attributes()
    {
        return [
            'access_user_id' => 'Usuario',
            'observation' => 'Observacion',
        ];
    }
}
