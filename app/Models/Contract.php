<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'date_start',
        'date_end',
        'monthly_price',
        'owner_id',
        'tenant_id',
        'box_id',
        'contract_model_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }

    public function contractModel()
    {
        return $this->belongsTo(ContractModel::class, 'contract_model_id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'contract_id');
    }
}
