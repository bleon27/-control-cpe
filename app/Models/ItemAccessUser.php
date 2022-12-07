<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemAccessUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'status',
        'reason',
        'reason_return',
        'observation',
        'user_id',
        'access_user_id',
        'item_id',
        'assigned_at',
        'returned_at',
    ];

    public $timestamps = false;

    public function accessUser()
    {
        return $this->belongsTo(AccessUser::class);
    }

    public function itemAccessUserDetails()
    {
        return $this->hasMany(ItemAccessUserDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
