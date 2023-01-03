<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    protected $guarded =[];
     
    public function getlabelAttribut($value)
    {
        return json_decode($value);
    }  

    protected $casts = [       
        'label' => 'array',
    ];
}
