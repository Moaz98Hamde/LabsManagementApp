<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $fillable = ['description'];
    protected $hidden = ['lab_id'];

    public function issues(){
        return $this->hasMany('App\Issue');
    }

    public function lab(){
       return $this->belongsTo('App\Lab');
    }
}