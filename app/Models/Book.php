<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author');
    }

    public function covers()
    {
        return $this->hasOne('App\Models\Cover');
    }

}
