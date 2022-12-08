<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ItemAccessUser;
use Carbon\Carbon;

class UpdateItemAccessUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reason_return' => ["max:255"],
            'returned_at' => ["date"],
        ];
    }

    protected function prepareForValidation()
    {
        $fecha = Carbon::now();
        $this->merge(
            [
                'id' => trim($this->id),
                'reason_return' => trim($this->razon),
                'returned_at' => $fecha->format('y-m-d h:m:s'),
            ]
        );
    }

    public function attributes()
    {
        return [
            'id' => 'Ficha de asignacion',
            'reason_return' => 'Razon',
            'returned_at' => 'Fecha de recepcion',
        ];
    }
}
