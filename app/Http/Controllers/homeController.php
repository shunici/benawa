<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\pemesan;
use File;
use Carbon\Carbon;
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
              $date = Carbon::now();         
              $meta = [       
              "title" => $post->nama,    
              "description" => 'Data Cetakan Masuk Hari '.  Carbon::parse($date)->isoFormat('dddd, D MMMM Y'),    
              "url" => 'https://benawa.link' . '/'. $path,   
              "image" => 'https://raw.githubusercontent.com/shunici/program_hitung/master/benawa.jpg'
              ];   
              
          }
          // 127.0.0.1:8000/storage/produk/foto1677170450.jpg
          // "image" => 'http://127.0.0.1:8000'. '/storage/produk/'. $post->foto    
          // "url" => config('app.url') . '/'. $path,  
     }
    
    return view('index', ['meta' => $meta]);
  }
}

