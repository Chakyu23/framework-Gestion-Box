<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractModel extends Model
{
    use HasFactory;

    protected $table = 'contract_models';

    protected $fillable = [
        'name',
        'content',
        'owner_id'
    ];

    /**
     * Relation avec l'utilisateur (propriétaire du modèle de contrat)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'contract_model_id');
    }
}
