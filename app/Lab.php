<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DateTimeInterface;

class Lab extends Model
{

      protected $fillable = [
        'name', 'capacity', 'program','location', 'supervisor'
    ];

    // Add UUID to the Lab model before storing it in the DB
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lab) {
            $lab->{$lab->getKeyName()} = (string) Str::uuid();
        });
    }

    // Cancel auto-increment for the the model primary key
    public function getIncrementing()
    {
        return false;
    }

    // Store the primary key as String values
    public function getKeyType()
    {
        return 'string';
    }

    // Get all the devices in the lab
    public function devices(){
        return $this->hasMany('App\Device');
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