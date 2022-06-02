<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $fillable = [
        'agreement','floorsize','floor','lift','carpark','nearestSchool','nearestRailway','nearestBusStop'
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
