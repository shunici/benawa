<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bahan;
use App\Http\Resources\spkCollection;
use Illuminate\Support\Facades\DB;
class bahanController extends Controller
{
    public function index()
    {               
        $kategori = request()->kueri;
        if($kategori != "") {
            $bahan = bahan::orderBy('created_at', 'ASC')->where('kategori', $kategori);
        }else{
            $bahan = bahan::orderBy('created_at', 'ASC'); 
        }
        
        if (request()->q != '') {
            $bahan = $bahan->where('nama', 'LIKE', '%' . request()->q . '%')            
            ->orWhere('panjang', 'LIKE', '%' . request()->q . '%')
            ->orWhere('lebar', 'LIKE', '%' . request()->q . '%')
            ->orWhere('keterangan', 'LIKE', '%' . request()->q . '%')
            ->orWhere('uk_alias', 'LIKE', '%' . request()->q . '%');
        }                
        $bahan = $bahan->paginate( request()->per_page );
        return new spkCollection($bahan);
        
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            
        ]);

        $data = DB::table('bahans')->insert($request->all());
        return response()->json('data berhasil');
    }

    public function edit($id)
    {
        $data = bahan::findOrFail($id);
        return response()->json([
            'data' => $data
            ]);
    } 

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            
        ]);
        $data = bahan::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = bahan::findOrFail($id);
        $data->delete();
        return response()->json('berhasil');
    }

    public function total() 
    {

       $total = [
        
       ];
        for($aa = 1; $aa <= 80; $aa++){
            $nama_total = $aa.'x';
            $total[] = ['nama' => $nama_total, 'qty' => $aa];
        };
        for($ab = 1; $ab <= 80; $ab++){
            $nama_total = $ab.' x';
            $total[] = ['nama' => $nama_total, 'qty' => $ab];
        };
        for($ac = 1; $ac <= 80; $ac++){
            $nama_total = $ac.'lembar';
            $total[] = ['nama' => $nama_total, 'qty' => $ac];
        };
        for($ad = 1; $ad <= 80; $ad++){
            $nama_total = $ad.' lembar';
            $total[] = ['nama' => $nama_total, 'qty' => $ad];
        };
        for($ae = 1; $ae <= 80; $ae++){
            $nama_total = $ae.'lbr';
            $total[] = ['nama' => $nama_total, 'qty' => $ae];
        };
        for($af = 1; $af <= 80; $af++){
            $nama_total = $af.' lbr';
            $total[] = ['nama' => $nama_total, 'qty' => $af];
        };
        for($ag = 1; $ag <= 80; $ag++){
            $nama_total = $ag.'pcs';
            $total[] = ['nama' => $nama_total, 'qty' => $ag];
        };
        for($ah = 1; $ah <= 80; $ah++){
            $nama_total = $ah.' pcs';
            $total[] = ['nama' => $nama_total, 'qty' => $ah];
        };
        for($bb = 1; $bb <= 80; $bb++){
            $nama_total = '='.$bb.'x';
            $total[] = ['nama' => $nama_total, 'qty' => $bb];
        };
        
        for($bd = 1; $bd <= 80; $bd++){
            $nama_total = '='.$bd.'lembar';
            $total[] = ['nama' => $nama_total, 'qty' => $bd];
        };
        
        for($bf = 1; $bf <= 80; $bf++){
            $nama_total = '='.$bf.'lbr';
            $total[] = ['nama' => $nama_total, 'qty' => $bf];
        };
        
        for($bh = 1; $bh <= 80; $bh++){
            $nama_total = '='.$bh.'pcs';
            $total[] = ['nama' => $nama_total, 'qty' => $bh];
        };
        
        for($bi = 1; $bi <= 80; $bi++){
            $nama_total = $bi.'kali';
            $total[] = ['nama' => $nama_total, 'qty' => $bi];
        };

        
        for($bj = 1; $bj <= 80; $bj++){
            $nama_total = $bj.' kali';
            $total[] = ['nama' => $nama_total, 'qty' => $bj];
        };
      
        for($bk = 1; $bk <= 5; $bk++){
            $nama_total = $bk.' box';
            $total[] = ['nama' => $nama_total, 'qty' => $bk*4];
        };

        
        for($bl = 1; $bl <= 5; $bl++){
            $nama_total = $bl.'box';
            $total[] = ['nama' => $nama_total, 'qty' => $bl*4];
        };

        $ket = [
            ['nama' => 'mata ayam', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'ma', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'fns', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'fs', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'mata kucing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],   
            ['nama' => 'berlobang', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],        
            ['nama' => 'brlobang', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],        
            ['nama' => 'dilubangi', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'lubang', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'lubangi', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'lobangi', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'lbg', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'lbang', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],

            ['nama' => 'finishing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finising', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finhishnig', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsihing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinishing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],  
            ['nama' => 'pinising', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinhishnig', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinsihing', 'ket' => 'mata ayam', 'pns' => true, 'ls' => false],
            ['nama' => 'pinsing', 'ket' => 'mata ayam', 'fns' => true, 'ls' => false],
//fns tanpa lubang
            
            ['nama' => 'finishing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finising tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finhishnig tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsihing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinishing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],  
            ['nama' => 'pinising tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinhishnig tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinsihing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'pns' => true, 'ls' => false],
            ['nama' => 'pinsing tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            
            ['nama' => 'finishing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finising tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finhishnig tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsihing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinishing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],  
            ['nama' => 'pinising tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinhishnig tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinsihing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'pns' => true, 'ls' => false],
            ['nama' => 'pinsing tanpa lbang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
                        
            ['nama' => 'finishing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finising tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finhishnig tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsihing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinishing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],  
            ['nama' => 'pinising tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinhishnig tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinsihing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'pns' => true, 'ls' => false],
            ['nama' => 'pinsing tanpa ma', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],

            ['nama' => 'finishing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finising tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finhishnig tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsihing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'finsing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinishing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],  
            ['nama' => 'pinising tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinhishnig tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pinsihing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'pns' => true, 'ls' => false],
            ['nama' => 'pinsing tanpa mata ayam', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],

            ['nama' => 'fs tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'fns tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            ['nama' => 'pns tanpa lubang', 'ket' => 'fns tanpa mata ayam', 'fns' => true, 'ls' => false],
            //lebih sisi
            ['nama' => 'lbs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'ls', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],


            ['nama' => 'lebih sisi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lebih ss', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lebih ssi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbih ssi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbih sis', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbih ss', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbh ss', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbh sis', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbh ssi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            
            
            ['nama' => 'sisi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lebih bahan', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'lbh bahan', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],


                //============
                ['nama' => 'tanpa finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa berlubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa brlubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa berlobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa brlobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

                ['nama' => 'tanpa belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
                ['nama' => 'tanpa dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

            ['nama' => 'tidak finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak berlubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak brlubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak berlobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak brlobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tidak dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

            
            ['nama' => 'tdk finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tdk dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

            
            ['nama' => 'tak finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'tak dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

            
            ['nama' => 'kada finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kada dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

            
            ['nama' => 'kd finishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd finising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd finhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd finsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pinishing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pinising', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pinhishnig', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pinsihing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pinsing', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd fs', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd fns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd pns', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd belubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd lubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd belobang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd blubang', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd dlubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],
            ['nama' => 'kd dilubangi', 'ket' => 'lebih sisi', 'fns' => false, 'ls' => true],

//selongsong
            ['nama' => 'selongsong ab', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong ab', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],
            ['nama' => 'selongsong atas bawah', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong atas bawah', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],    
            ['nama' => 'selongsong atas bwh', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong atas bwh', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],   

            ['nama' => 'selongsong atas bwah', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong atas bwah', 'ket' => 'selongsong atas bawah', 'fns' => false, 'ls' => false], 
            

            ['nama' => 'selongsong kk', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong kk', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            ['nama' => 'selongsong kiri kanan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong kiri kanan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],

            
            ['nama' => 'selongsong kri kanan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong kri kanan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            

            ['nama' => 'selongsong kiri knan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],
            ['nama' => 'slongsong kiri knan', 'ket' => 'selongsong kiri kanan', 'fns' => false, 'ls' => false],        
        ];
        //mencari 1 sisi
        $sisi =[
            //satu sisi
            ['nama' => '1 sisi', 'ket' => '1 sisi'],
            ['nama' => '1 ssi', 'ket' => '1 sisi'],
            ['nama' => '1 sis', 'ket' => '1 sisi'],
            
            ['nama' => 'satu sisi', 'ket' => '1 sisi'],
            ['nama' => 'satu ssi', 'ket' => '1 sisi'],
            ['nama' => 'satu sis', 'ket' => '1 sisi'],
            
            ['nama' => 'stu sisi', 'ket' => '1 sisi'],
            ['nama' => 'stu ssi', 'ket' => '1 sisi'],
            ['nama' => 'stu sis', 'ket' => '1 sisi'],

            // dua sisi
            ['nama' => '2 sisi', 'ket' => '2 sisi'],
            ['nama' => '2 ssi', 'ket' => '2 sisi'],
            ['nama' => '2 sis', 'ket' => '2 sisi'],
            
            ['nama' => 'dua sisi', 'ket' => '2 sisi'],
            ['nama' => 'dua ssi', 'ket' => '2 sisi'],
            ['nama' => 'dua sis', 'ket' => '2 sisi'],            
            ['nama' => 'bolak balik', 'ket' => '2 sisi'],

        //tanpa spasi
        
            //satu sisi
            ['nama' => '1sisi', 'ket' => '1 sisi'],
            ['nama' => '1ssi', 'ket' => '1 sisi'],
            ['nama' => '1sis', 'ket' => '1 sisi'],
            
            ['nama' => 'satusisi', 'ket' => '1 sisi'],
            ['nama' => 'satussi', 'ket' => '1 sisi'],
            ['nama' => 'satusis', 'ket' => '1 sisi'],
            
            ['nama' => 'stusisi', 'ket' => '1 sisi'],
            ['nama' => 'stussi', 'ket' => '1 sisi'],
            ['nama' => 'stusis', 'ket' => '1 sisi'],

            // dua sisi
            ['nama' => '2sisi', 'ket' => '2 sisi'],
            ['nama' => '2ssi', 'ket' => '2 sisi'],
            ['nama' => '2sis', 'ket' => '2 sisi'],
            
            ['nama' => 'duasisi', 'ket' => '2 sisi'],
            ['nama' => 'duassi', 'ket' => '2 sisi'],
            ['nama' => 'duasis', 'ket' => '2 sisi'],            
            ['nama' => 'bolakbalik', 'ket' => '2 sisi'],
         
        ];
        
        $laminasi =[

            ['nama' => 'laminasi', 'ket' => 'tanyakan laminasi'],
            ['nama' => 'glossi', 'ket' => 'laminasi glossi'],
            ['nama' => 'glossy', 'ket' => 'laminasi glossi'],            
            ['nama' => 'glosi', 'ket' => 'laminasi glossi'],
            ['nama' => 'glosy', 'ket' => 'laminasi glossi'],
            ['nama' => 'glos', 'ket' => 'laminasi glossi'],
            ['nama' => 'gloss', 'ket' => 'laminasi glossi'],                      
            ['nama' => 'doft', 'ket' => 'laminasi doft'],
            ['nama' => 'doff', 'ket' => 'laminasi doft'],            
            ['nama' => 'dop', 'ket' => 'laminasi doft'],
            ['nama' => 'dops', 'ket' => 'laminasi doft'],
            ['nama' => 'dopt', 'ket' => 'laminasi doft'],                                                                                      
        ];

        $printCut = [
            ['nama' => 'printcutt', 'ket' => ' + print n cut'],
            ['nama' => 'printcut', 'ket' => ' + print n cut'],
            ['nama' => 'cutt', 'ket' => ' + print n cut'],
            ['nama' => 'cutting', 'ket' => ' + print n cut'],
            ['nama' => 'print n cut', 'ket' => ' + print n cut'],  
            ['nama' => 'print cut', 'ket' => ' + print n cut'],  
            ['nama' => 'potong', 'ket' => ' + potong'],  
            ['nama' => 'ptong', 'ket' => ' + potong'],  
            ['nama' => 'ptng', 'ket' => ' + potong'],  
            ['nama' => 'potongkan', 'ket' => ' + potong'],  
            ['nama' => 'ptongkan', 'ket' => ' + potong'],                                                                            
        ];

        return response()->json([
            "total" => $total,
            "ket" => $ket, //outdoor
            "sisi" => $sisi,
            "laminasi" => $laminasi,
            "printcut" => $printCut,
        ]);

    }
}

