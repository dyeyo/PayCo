<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Clients;

class Wallet extends Model
{
    protected $fillable=['dinner', 'id_cliente','docuement','name'];

    public function client(){
        return $this->belongsTo(Clients::class);
    }
}
