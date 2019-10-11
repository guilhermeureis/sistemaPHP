<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
	use SoftDeletes;

    public function contatos()
    {
        return $this->hasMany('App\ContatoCliente');
    }
}
