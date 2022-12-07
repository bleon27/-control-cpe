<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemAccessUserDetail extends Model
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
        'type',
        'state',
        'amount',
        'item_id',
        'item_access_user_id',
    ];
}
