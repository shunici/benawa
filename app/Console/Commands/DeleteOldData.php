<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\spk;
use Illuminate\Support\Facades\Storage;
class DeleteOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menghapus data dalam waktu 4 hari';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $data =  spk::where('created_at', '<', Carbon::now()->subDay(2))->get();
       $total = $data->count();  //jika nol berrti tidak ada
       if($total > 5) {        
        foreach($data as $row) { //hapus satu satu secara loop
            $spk = spk::findOrFail($row->id);    
            Storage::disk('public')->delete('/spk/'. $spk->foto_spk);                              
            $spk->delete();
        } //foreach
     } //if
        $name = $this->info('data 4 hari dihapus');
    }
}


