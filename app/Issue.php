<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    protected $fillable = ['title', 'description', 'device_id'];
    protected $casts = ['resolved' => 'boolean'];

    public function device(){
        return $this->belongsTo('App\Device');
    }

    public function resolve(){
       $this->resolved = true;
       $this->save();
    }

    public function retreat(){
       $this->resolved = false;
       $this->save();
    }
}