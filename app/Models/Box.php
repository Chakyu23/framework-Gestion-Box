<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $table = 'boxes';

    protected $fillable = [
        'name',
        'address',
        'prices',
        'owner_id'
    ];

    /**
     * Relation avec l'utilisateur (propriétaire du box)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'box_id');
    }
}
