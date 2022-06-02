<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartemen extends Model
{
    protected $fillable = [
        'kitchen','rooms','washroom','size','nearestSchool','nearestRailway','nearestBusStop'
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
