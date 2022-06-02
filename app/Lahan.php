<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $fillable = [
        'electricity','size','tapwater','nearestSchool','nearestRailway','nearestBusStop'
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
