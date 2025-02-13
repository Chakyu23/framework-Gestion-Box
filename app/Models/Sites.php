<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table="sites";
    protected $fillable = [
        'name',
        'address',
        'postalCode',
        'telephone',
        'mail',
        'user_id',
        'active'
    ];

    public function belong_user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function has_box() {
        return $this->hasMany(Box::class);
    }
}
