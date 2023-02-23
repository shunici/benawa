<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\produk;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\spkCollection;
use Illuminate\Support\filter;
use File;
use Illuminate\Support\Facades\Storage;
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

        $file = null;
        $input = $request->all();
        if($request->hasFile('foto')){                        
            $file =  $this->simpan_foto( $request->file('foto') );                         
            $input['foto'] = $file;        
        }
       
        produk::create($input);

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
        $file = $data->foto;

        if ($request->hasFile('foto')) {
            !empty($file) ? Storage::disk('public')->delete('/produk/'. $data->foto) :null;
            $file = $this->simpan_foto( $request->file('foto') );
        }
                                                 
        $input = $request->all();  
        $input['foto'] = $file;                                  
        $data->update($input);
        return response()->json("berhasil");
    }

    public function delete($id)
    {
        $data = produk::findOrFail($id);
        Storage::disk('public')->delete('/produk/'. $data->foto);
        $data->delete();
        return response()->json('berhasil');
    }

    
    private function simpan_foto($file)
    {
        $fileName = 'foto'. time() .'.'. $file->getClientOriginalExtension();
        $file->storeAs('public/produk', $fileName);
        return $fileName;
    }


}

