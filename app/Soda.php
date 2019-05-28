<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Soda extends Model
{
    protected $connection = 'mongodb';
    protected $fillable = [
        'brand', 'liters', 'type', 'quantity', 'pricePerUnit'
    ];

}
