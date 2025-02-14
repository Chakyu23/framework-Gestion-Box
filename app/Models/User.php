<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contractModels()
    {
        return $this->hasMany(ContractModel::class, 'owner_id');
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'owner_id');
    }
    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'data_owner_id');
    }
    public function boxes()
    {
        return $this->hasMany(Box::class, 'owner_id');
    }
    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Contract::class, 'owner_id', 'contract_id');
    }
}
