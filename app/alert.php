<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alert extends Model
{
    protected $guarded =[];
    
    public function spk()
    {
        return $this->belongsTo(spk::class);
    }
}
