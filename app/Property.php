<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name', 'latitude', 'longitude','type','amount','city','postalCode','province','description','images','availability','contactNo','contatctEmail'
    ];

    public function house(){

        return $this->belongsTo(Rumah::class);

    }

    public function land(){

        return $this->belongsTo(Lahan::class);

    }

    public function building(){

        return $this->belongsTo(Gedung::class);

    }

    public function apartment(){

        return $this->belongsTo(Apartemen::class);

    }

    public function warehouse(){

        return $this->belongsTo(Gedung::class);

    }

    public function user(){

        return $this->belongsTo(User::class);
        
    }

    public function offers(){

        return $this->hasMany(Transaksi::class);

    }

    public function reportproperties(){

        return $this->hasMany(ReportProperty::class);

    }

    public function favorites(){

        return $this->hasMany(Favorit::class);

    }
}
