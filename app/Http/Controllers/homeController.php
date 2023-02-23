<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use File;
class homeController extends Controller
{
  public function index(Request $request)
  {
    $path = request()->path();
    $meta = [
        "title" => 'judul',
        "description" => "deskripsi",
        "url" => $path,
        "image" => '',
    ];
  
    if (str_contains($path, 'produk/edit')) {         
           $post_id = str_replace('produk/edit/', '', $path); 
          $post = produk::find($post_id);
            if ($post) {      
              $meta = [       
              "title" => $post->nama,    
              "description" => $post->kategori,     
              "url" => config('app.url') . '/'. $path,   
              "image" => config('app.url'). '/storage/produk/'. $post->foto    
              ];   
              
          }
          // 127.0.0.1:8000/storage/produk/foto1677170450.jpg
          // "image" => 'http://127.0.0.1:8000'. '/storage/produk/'. $post->foto    
     }
    return view('index', ['meta' => $meta]);
  }
}

