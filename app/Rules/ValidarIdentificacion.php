<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AccessUser;
use App;

class ValidarIdentificacion implements Rule
{
    public $identificacion = '';
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $this->identificacion = $value;
        $accessUser = AccessUser::where('ci', $value)->orWhere('document_number', $value);
        if ($accessUser->exists()) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return "El usuario $this->identificacion no esta registrado";
    }
}
