<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;
    protected $fillable = ['small'];
    public function books()
    {
        return $this->hasOne('App\Models\Book');
    }
}
