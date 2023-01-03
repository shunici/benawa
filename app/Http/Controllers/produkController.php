<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\produk;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\spkCollection;
use Illuminate\Support\filter;
class produkController extends Controller
{
    public function index()
    {
        
        $kategori = request()->kueri;
        if($kategori != "") {
            $produk = produk::orderBy('created_at', 'ASC')->where('kategori', $kategori);
        }else{
            $produk = produk::orderBy('created_at', 'ASC'); 
        }
        
        if (request()->q != '') {
            $produk = $produk->where('nama', 'LIKE', '%' . request()->q . '%')            
            ->orWhere('panjang', 'LIKE', '%' . request()->q . '%')
            ->orWhere('lebar', 'LIKE', '%' . request()->q . '%')
            ->orWhere('uk_alias', 'LIKE', '%' . request()->q . '%');
        }                
        $produk = $produk->paginate( request()->per_page );
        return new spkCollection($produk);

        
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',       
        ]);

        $data = DB::table('produks')->insert($request->all());
        return response()->json('data berhasil');
    }

    public function edit($id)
    {
        $data = produk::findOrFail($id);
        return response()->json([
            'data' => $data
            ]);
    } 

    public function update(Request $request, $id)
    {                                        
        $data = produk::find($id);                                             
        $input = $request->all();                                       
        $data->update($input);
        return response()->json("berhasil");
    }

    public function delete($id)
    {
        $data = produk::findOrFail($id);
        $data->delete();
        return response()->json('berhasil');
    }


}

