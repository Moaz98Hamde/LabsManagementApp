<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

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

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}