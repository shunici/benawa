<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\pemesanCollection;

use App\agenda;

class agendaController extends Controller
{
 
    public function index(Request $request)
    {
        $agenda = agenda::orderBy('posisi', 'ASC');
        if (request()->q != '') {
            $agenda = $agenda->where('nama', 'LIKE', '%' . request()->q . '%');
        }
        $agenda = $agenda->paginate(100);
        return new pemesanCollection($agenda);
    }

    public function gabung(Request $request)
    {
             $data = $request->all();             
                
             foreach($data as $row){ 
                $update = agenda::find($row['id']); 
                $update->nama = $row['nama'];
                $update->posisi = $row['posisi']; 
                $update->papan = $row['papan']; 
                $update->save(); 
          }
           
        return response()->json(['data-terkirim' => 'berhasil' ], 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'nama' => 'required'          
        ]);           
        $input = $request->all();                    
        agenda::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = agenda::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required'
          ]);                                                
              $data = agenda::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = agenda::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}
