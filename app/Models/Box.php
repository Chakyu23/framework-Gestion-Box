<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table="modelBox";
    protected $fillable = [
        'designation',
        'prices',
        'user_id',
        'model_id',
        'site_id',
        'locataire_id',
        'active'
    ];

    public function belong_user() {
        return $this->belongsTo(User::class, "user_id");
    }
    public function belong_model() {
        return $this->belongsTo(Box_models::class, "model_id");
    }
    public function belong_site() {
        return $this->belongsTo(Site::class, "site_id");
    }
    public function belong_locataires() {
        return $this->belongsTo(Locataire::class, "locataire_id");
    }
}
