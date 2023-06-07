<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pemesan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\Http\Resources\pemesanCollection;
class pemesanController extends Controller
{
    public function index()
    {
        $pemesans = pemesan::orderBy('created_at', 'DESC')
        ->when(request()->q, function($pemesans) {             
            $pemesans = $pemesans->where('nama', 'LIKE', '%' . request()->q . '%')
                ->orWhere('kategori', 'LIKE', '%' . request()->q . '%');                       
        })->paginate(50); 
        return response()->json(['status' => 'success', 'data' => $pemesans]);
        
    }

    public function cari_pemesan(Request $request)
    {
        $data = DB::table('pemesans')->pluck('inisial');
        $array = [];

        foreach($data as $row){
                $hasil =  json_decode($row, true);                
               $array[]= $hasil;
        }  
        $pemesan=[];
        for($i = 0; $i < count($array); $i++) {
            for($a = 0; $a < count($array[$i]); $a++) {
                    $pemesan[] = array(
                        'nama' => $array[$i][$a]['nama'],
                        'nama_asli' => $array[$i][$a]['nama_asli'],
                        'telpon' => $array[$i][$a]['telpon'],
                        'id_kostumer' => $array[$i][$a]['id_kostumer'],
                    );
            }
        }                
    
        return new pemesanCollection($pemesan);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',            
        ]);
        

        $file = null;
        
        if($request->hasFile('foto')){                        
            $file =  $this->simpan_foto( $request->file('foto') );                         
               
        }
            pemesan::create([
                'nama' => $request->nama,
                'telpon' => $request->telpon,
                'kategori' => $request->kategori,
                'foto' => $file,
                'inisial' => $request->inisial
            ]);
    
        if($request->inisial != null){
            $inisial = json_decode($request->inisial);
            $pemesan = pemesan::orderBy('created_at', 'desc')->latest()->first();
            $objek = [];
            foreach($inisial as $row){
                $objek[] = array( 
                    'nama_asli' => $request->nama,
                    'nama' => $row->nama, 
                    'telpon' => $request->telpon,
                    'id_kostumer' => $pemesan->id,
                );
            }
            $json = json_encode($objek); //konversi data inisial supaya bisa save ke DB

           
            $data = pemesan::find($pemesan->id);          
               $data->inisial = $json;
               $data->save();           
        }   
         
        return response()->json(['pesann' => $objek ]);
    }

    public function edit($id)
    {
        $data = pemesan::findOrFail($id);
        return response()->json([
            'data' => $data
            ]);
    } 

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',            
        ]);
        
        $json = null;       
            $inisial = json_decode($request->inisial);
            $objek = [];
            foreach($inisial as $row){
                $objek[] = array( 
                    'nama_asli' => $request->nama,
                'nama' => $row->nama, 
                'telpon' => $request->telpon,
                'id_kostumer' => $id,
            );
            }
            $json = json_encode($objek); //konversi data inisial supaya bisa save ke DB                                               

        $data = pemesan::findOrFail($id);
        $file = $data->foto;
        if ($request->hasFile('foto')) {
            !empty($file) ? Storage::disk('public')->delete('/pemesan/'. $data->foto) :null;
            $file = $this->simpan_foto( $request->file('foto') );
        }

        $input = $request->all();
        $input['foto'] = $file;  
        $input['inisial'] = $json;

        $data->update($input);
        return response()->json($objek);
    }

    public function delete($id)
    {
        $data = pemesan::findOrFail($id);
        $data->delete();
        return response()->json('berhasil');
    }

       
    private function simpan_foto($file)
    {
        $fileName = 'barcode'. time() .'.'. $file->getClientOriginalExtension();
        $file->storeAs('public/pemesan', $fileName);
        return $fileName;
    }
}
