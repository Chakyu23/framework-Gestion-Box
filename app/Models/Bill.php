<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'periode_number',
        'payment_date',
        'paiment_amount',
        'contract_id'
    ];

    /**
     * Relation avec le contrat
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}

