<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['name', 'updated_at','logo','address','id','email','phone','created_at'];
    public    $timestamps = true;
}
