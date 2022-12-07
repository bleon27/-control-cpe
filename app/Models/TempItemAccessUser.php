<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempItemAccessUser extends Model
{
    use HasFactory;

    //protected $table = 'temp_item_access_users';

    protected $fillable = [
        'amount',
        'user_id',
        'item_id',
        'access_user_id',
    ];

    public function item()
    {
        return $this->hasOne(Item::class);
    }
}
