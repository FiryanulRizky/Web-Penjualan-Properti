<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function property(){

        return $this->belongsTo(Property::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }
}
