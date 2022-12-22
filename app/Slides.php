<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $table = 'slides';
    protected $fillable = ['title', 'updated_at','images','url','id','type','created_at'];
    public    $timestamps = true;
}
