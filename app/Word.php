<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table='word';

    protected $fillable =
        [
//            'id',
            'arabic',
            'arabic_filtered',
            'german',
            'article',
            'arabic_description',
            'german_description',
            'rank'
        ];

    public $timestamps = false;
    public $incrementing = false;
}
