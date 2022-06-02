<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    public function article(){

        return $this->belongsTo(Post::class);
        
    }

    public function user(){

        return $this->belongsTo(User::class);
        
    }
}
