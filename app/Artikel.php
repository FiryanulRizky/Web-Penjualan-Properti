<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Artikel extends Model
{
    public function admin(){

        return $this->belongsTo(Admin::class);

    }

    public function comments(){

        return $this->hasMany(Komentar::class);
    }

    public static function archive(){
        return DB::table("artikels")
        ->select(DB::raw("YEAR(created_at) year, MONTHNAME(created_at) month, COUNT(*) article_count"))
        ->groupBy("year","month")
        ->orderBy("year", "desc")
        ->orderBy("month", "desc")
        ->get();
    }
}
