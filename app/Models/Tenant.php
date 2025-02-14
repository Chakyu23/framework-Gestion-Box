<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'data_owner_id'
    ];

    /**
     * Relation avec l'utilisateur (propriétaire des données)
     */
    public function dataOwner()
    {
        return $this->belongsTo(User::class, 'data_owner_id');
    }

    /**
     * Relation avec les contrats associés à ce locataire
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'tenant_id');
    }

    /**
     * Relation avec les factures associées à ce locataire (via les contrats)
     */
    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Contract::class, 'tenant_id', 'contract_id');
    }
}
