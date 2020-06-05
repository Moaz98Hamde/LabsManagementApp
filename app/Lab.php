<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{

      protected $fillable = [
        'name', 'capacity', 'program','location', 'supervisor'
    ];


    public function devices(){
        return $this->hasMany('App\Device');
    }


}