<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\AccessUser;

class StoreTempItemAccessUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tempItemAccessUser = new Item;
        $tableTemp = $tempItemAccessUser->getTable();
        $accessUser = new AccessUser;
        $tableAccessUser = $accessUser->getTable();
        $user = new User;
        $tableUser = $user->getTable();
        return [
            'item_id' => ["exists:$tableTemp,id"],
            'access_user_id' => ["exists:$tableAccessUser,id"],
            'user_id' => ["exists:$tableUser,id"],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'item_id' => trim($this->id),
                'access_user_id' => trim($this->idClient),
                'user_id' => auth()->user()->id,
            ]
        );
    }

    public function attributes()
    {
        return [
            'item_id' => 'Item',
            'access_user_id' => 'Usuario',
            'user_id' => 'Usuario Administrador',
        ];
    }
}
