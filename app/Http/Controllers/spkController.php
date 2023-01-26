<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\filter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\spk;
use App\Http\Resources\spkCollection;

class spkController extends Controller
{
      
    public function index(Request $request)
    {
        $kategori = request()->kategori;
        if($kategori != "") {
            $spk = spk::orderBy('posisi', 'ASC')->where('kategori', $kategori);
        }else{
            $spk = spk::orderBy('posisi', 'ASC'); 
        }
        $status = request()->status;        
        if($status == "csd") {
            $spk = $spk->where('status', $status);
        }

        $no_nota = request()->no_nota;             
        if($no_nota != "") {
            $spk = $spk->where('no_nota', $no_nota);
        }
        
        $desainer = request()->desainer;             
        if($desainer != "") {
            $spk = $spk->where('desainer', $desainer);
        }
        if (request()->q != '') {
            $spk = $spk->where('nama_pemesan', 'LIKE', '%' . request()->q . '%')
            ->orWhere('desainer', 'LIKE', '%' . request()->q . '%');
        }
      
        if( request()->mulai_tgl and request()->akhir_tgl ){
            $spk = $spk->whereBetween('created_at', array( request()->mulai_tgl, request()->akhir_tgl) );
        }

        $spk = $spk->paginate( request()->per_page );

        return new spkCollection($spk);
    }

    public function queriData(Request $request)
    {
        $data = DB::table('spks')->pluck('data');
        $array = [];

        foreach($data as $row){
                $hasil =  json_decode($row, true);                
               $array[]= $hasil;
        }  
        $data=[];
        for($i = 0; $i < count($array); $i++) {
            for($a = 0; $a < count($array[$i]); $a++) {
                    $data[] = array(
                        'nama_brg' => $array[$i][$a]['nama_brg'],
                        'produk_id' => $array[$i][$a]['produk_id'],
                        'bahan_id' => $array[$i][$a]['bahan_id'],
                        'ukuranP' => $array[$i][$a]['ukuranP'],
                        'ukuranL' => $array[$i][$a]['ukuranL'],
                        'uk_alias' => $array[$i][$a]['uk_alias'],
                        'qty' => $array[$i][$a]['qty'],
                        'fns' => $array[$i][$a]['fns'],
                        'ls' => $array[$i][$a]['ls'],
                        'ket' => $array[$i][$a]['ket'],
                    );
            }
        }                
    
        return new spkCollection($data);
    }



    public function  color()
    {
      $namaWarna = [
       "#15e67f", 
       "#e3de8c", 
       "#d8a076", 
       "#d83762", 
       "#673ab7", 
       "#ffeb3b", 
       "#210324" 
      ];
      return response()->json(['warna' => $namaWarna]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'nama_pemesan' => 'required'          
        ]); 
        $input['no_nota'] = 0;        
        $input = $request->all();                    
        spk::create($input);     
        return response()->json(['status' => $request->all()], 200);
    }

    public function jadikancsd()
    {

            $spk = spk::where('status', 'cs')->get();

             $data = $spk;             
                
             foreach($data as $row){ 
                $update = spk::find($row['id']); 
                $update->posisi = $row['posisi']; 
                $update->status = 'csd'; 
                $update->save(); 
          }
           
        return response()->json(['data-terkirim' => 'berhasil' ], 200);
    }

    public function gabung(Request $request)
    {
             $data = $request->all();             
                
             foreach($data as $row){ 
                $update = spk::find($row['id']); 
                $update->posisi = $row['posisi']; 
                $update->status = $row['status']; 
                $update->save(); 
          }
           
        return response()->json(['data-terkirim' => 'berhasil' ], 200);
    }

    public function updatelabel(Request $request)
    {
         
        return response()->json(['tesss' => $request->all()], 200);
    }
  

    public function edit($id)
    {
        $data = spk::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
    
    public function csd($id)
    {
        $data = spk::findOrFail($id);
        if($data) {         
            $data->status = 'csd'; 
            $data->save(); 
        }
        return response()->json(['status' => 'success'], 200);
    }
    public function cs($id)
    {
        $data = spk::findOrFail($id);
        if($data) {         
            $data->status = 'cs'; 
            $data->save(); 
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function handlespk(Request $request, $id)    {
                                                
        $data = spk::find($id);                                                   
        if($data) {                           
            $myArray = (object) [
                'nama' => $request->nama,
                'ket' => $request->ket,
                'waktu' => $request->waktu
            ];
            $user= $data->user;           
            array_push($user, $myArray);
            $data->user = $user; 
            $data->save(); 
        }
         
    return response()->json(['status' => 'berhasill' ], 200);
}

    public function update(Request $request, $id){                                                
              $data = spk::find($id);                                             
              $input = $request->all();                                       
              $data->update($input);
               
          return response()->json(['status' => $request->all()], 200);
    }

    public function destroy($id)
    {
        $data = spk::findOrFail($id);        
        $data->delete();  
        return response()->json(['status' => 'success'], 200);
    }
}
