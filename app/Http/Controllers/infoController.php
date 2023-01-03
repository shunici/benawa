<?php

namespace App\Http\Controllers;
use App\Http\Resources\spkCollection;
use Illuminate\Http\Request;
use App\info;
class infoController extends Controller
{
   
    public function index(Request $request)
    {
        $info = info::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $info = $info->where('nama', 'LIKE', '%' . request()->q . '%');
        }
        $info = $info->paginate(500);

        return new spkCollection($info);
    }



    public function store(Request $request)
    {
        $this->validate($request, [
          'deskripsi' => 'required'          
        ]);           
        $input = $request->all();                    
        info::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = info::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
    


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'deskripsi' => 'required'          
          ]);                                         
              $data = info::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = info::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}
