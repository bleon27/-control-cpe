<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        //'first_name',
        //'second_name',
        'surnames',
        //'second_surname',
        //  'full_names',
        'document_number',
        'ci',
        'unit',
        'position',
    ];

    public function getUnitAbbreviateAttribute()
    {
        $str = mb_strtoupper($this->attributes['unit'], 'UTF-8');
        $strSeparate = explode(' ', $str);
        $strConst = ['A', 'E', 'I', 'O', 'U', 'DE', 'CON', 'POR', 'Y', 'EL', 'LAS', 'LOS', 'LA'];
        $abreviado = '';
        foreach ($strSeparate as $key => $value) {
            $ctrl = false;
            foreach ($strConst as $key2 => $value2) {
                if ($value == $value2) {
                    $ctrl = true;
                }
            }
            if (!$ctrl) {
                $abreviado .= substr($value, 0, 1);
            }

        }
        return $abreviado;
    }
}
