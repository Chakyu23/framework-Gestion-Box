<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box_models extends Model
{
    protected $table="box_models";
    protected $fillable = [
        'name',
        'surface',
        'height',
        'security',
        'refrigerate',
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
