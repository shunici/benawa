<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alert;
use Illuminate\Support\Facades\DB;
use App\spk;
use App\Http\Resources\pemesanCollection;
class alertController extends Controller
{
  
    public function index(Request $request)
    {
        
        $kategori = request()->kueri;
        if($kategori != "") {
            $alert = alert::orderBy('posisi', 'ASC')->where('kategori', $kategori)->with('spk');
        }else{
            $alert = alert::orderBy('posisi', 'ASC')->with('spk');
        }
        
        if (request()->q != '') {
            $alert = $alert->where('text', 'LIKE', '%' . request()->q . '%');
        }

        $alert = $alert->paginate( request()->per_page );
        return new pemesanCollection($alert);


    }

    public function gabung(Request $request)
    {
             $data = $request->all();             
                
             foreach($data as $row){ 
                $update = alert::find($row['id']);                 
                $update->posisi = $row['posisi'];          
                $update->save(); 
          }
           
        return response()->json(['data-terkirim' => 'berhasil' ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'kategori' => 'required'          
        ]);           
        $input = $request->all();                    
        alert::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = alert::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
    
    public function carialert($id)
    {
        $data = alert::where('spk_id', $id)->first();
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kategori' => 'required'
          ]);                                                
              $data = alert::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = alert::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}
