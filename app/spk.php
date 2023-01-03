<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spk extends Model
{
    protected $guarded =[];
    public function getdataAttribut($value)
    {
        return json_decode($value);
    }   
    public function getlabelAttribut($value)
    {
        return json_decode($value);
    }  

    public function getuserAttribut($value)
    {
        return json_decode($value);
    }  
    protected $casts = [
        'data' => 'array',
        'label' => 'array',
        'user' => 'array',
    ];


    public function getdateAttribute($value)
	{
		return Carbon::parse($value)->format('d-m-Y');
	}
}
