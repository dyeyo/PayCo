<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable=['docuement', 'name', 'email', 'phone'];

    public function waller(){
        return $this->belongsTo(Wallet::class);
    }
}
