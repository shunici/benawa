<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\spk;
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
    protected $description = 'menghapus data dalam waktu 120 hari';

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
        spk::where('created_at', '<', Carbon::now()->subWeek(16))->delete();
        $name = $this->info('data 120 hari dihapus');
    }
}

