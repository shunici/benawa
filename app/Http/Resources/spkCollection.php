<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class spkCollection extends ResourceCollection
{
    

    
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}