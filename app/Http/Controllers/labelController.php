<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\label;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\pemesanCollection;
class labelController extends Controller
{
    
    public function index(Request $request)
    {
        $label = label::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $label = $label->where('nama', 'LIKE', '%' . request()->q . '%');
        }
        $label = $label->paginate(500);
        return new pemesanCollection($label);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'nama' => 'required'          
        ]);           
        $input = $request->all();                    
        label::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = label::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required'
          ]);                                                
              $data = label::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = label::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}
