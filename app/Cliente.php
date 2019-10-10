<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function contatos()
    {
        return $this->hasMany('App\ContatoCliente');
    }
}
