<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\karyawan;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\pemesanCollection;
class karyawanController extends Controller
{
   
    public function index(Request $request)
    {
        $karyawan = karyawan::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $karyawan = $karyawan->where('nama', 'LIKE', '%' . request()->q . '%');
        }
        $karyawan = $karyawan->paginate(10);
        return new pemesanCollection($karyawan);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'nama' => 'required'          
        ]);           
        $input = $request->all();                    
        karyawan::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = karyawan::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required'
          ]);                                                
              $data = karyawan::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = karyawan::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}