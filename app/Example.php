<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $table='examples';
    protected $fillable=[
        'arabic',
        'deutsch',
        'english',
        'french',
        'turki',
        'spanish',
        'italian'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
