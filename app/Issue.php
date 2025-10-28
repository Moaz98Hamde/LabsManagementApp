<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Issue extends Model
{

    protected $fillable = ['title', 'description'];
    protected $casts = ['resolved' => 'boolean'];
    protected $hidden = ['device_id'];

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