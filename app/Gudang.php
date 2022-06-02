<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $fillable = [
        'agreement','electricity','carpark','size'
    ];

    public function property(){

        return $this->belongsTo(Property::class);

    }

    public function offers(){

        return $this->hasMany(Transaksi::class);

    }

    public function reportproperties(){

        return $this->hasMany(ReportProperty::class);

    }
}
