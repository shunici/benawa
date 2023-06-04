<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\pemesan;
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
  
    if (str_contains($path, 'kostumer')) {         
           $post_id = str_replace('kostumer/', '', $path); 
          $post = pemesan::find($post_id);
       
            if ($post) {      
              $meta = [       
              "title" => $post->nama,    
              "description" => $post->kategori,     
              "url" => 'https://benawa.link' . '/'. $path,   
              // "image" => 'https://benawa.link'. '/storage/produk/'. $post->foto    
              ];   
              
          }
          // 127.0.0.1:8000/storage/produk/foto1677170450.jpg
          // "image" => 'http://127.0.0.1:8000'. '/storage/produk/'. $post->foto    
          // "url" => config('app.url') . '/'. $path,  
     }
    
    return view('index', ['meta' => $meta]);
  }
}

