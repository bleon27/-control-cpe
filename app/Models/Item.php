<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'serie',
        'cne_code',
        'processor',
        'ram',
        'disk',
        'descripcion',
        'type',
        'state',
    ];

    protected $dates = ['deleted_at'];
}
