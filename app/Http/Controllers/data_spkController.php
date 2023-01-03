<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\data_spk;
class data_spkController extends Controller
{
    public function index()
    {
        $data_spks = DB::table('data_spks')->orderBy('kategori', 'DESC')
        ->when(request()->q, function($data_spks) {             
            $data_spks = $data_spks->where('nama_brg', 'LIKE', '%' . request()->q . '%')
                 ->orWhere('kategori', 'LIKE', '%' . request()->q . '%')
                 ->orWhere('ukuranP', 'LIKE', '%' . request()->q . '%')
                ->orWhere('ukuranP', 'LIKE', '%' . request()->q . '%')
                ->orWhere('ukuranL', 'LIKE', '%' . request()->q . '%')
                ->orWhere('uk_alias', 'LIKE', '%' . request()->q . '%');                
        })->paginate(50); 
        return response()->json(['status' => 'success', 'data' => $data_spks]);
        
    }

    public function create(Request $request)
    {
       

        $data = DB::table('data_spks')->insert($request->all());
        return response()->json('data berhasil');
    }

    public function edit($id)
    {
        $data = data_spk::findOrFail($id);
        return response()->json([
            'data' => $data
            ]);
    } 

    public function update(Request $request, $id)
    {
    
        $data = data_spk::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = data_spk::findOrFail($id);
        $data->delete();
        return response()->json('berhasil');
    }
}
