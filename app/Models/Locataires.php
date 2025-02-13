<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locataires extends Model
{
    protected $table="locataires";
    protected $fillable = [
        'firstname',
        'lastname',
        'telephone',
        'mail',
        'IBAN',
        'adresse',
        'postalCode',
        'city',
        'active',
        'user_id'
    ];

    protected $hidden = [
        'IBAN'
    ];

    public function belong_user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function has_box() {
        return $this->hasMany(Box::class);
    }
}
