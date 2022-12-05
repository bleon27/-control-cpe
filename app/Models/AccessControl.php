<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_user_id',
        'entry_date',
        'departure_date',
    ];

    public $timestamps = false;

    public function accessUser()
    {
        return $this->belongsTo(AccessUser::class);
    }
}
