<?php

namespace App\Console\Commands;
use App\Models\Karyawan;
use Illuminate\Console\Command;

class ResetStatusBlassKaryawanAmalanHarian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset status pesan karyawan yang sebelumnya di broadcast untuk mengisi amalan harian';

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
        $karyawan   = Karyawan::where('telp_karyawan', '!=', null)->where('blass', '1')->update(
            [
                'blass' => '0'
            ]
        );

        $this->info('Mereset status karyawan yang sudah menerima broadcast menjadi siap dibroadcast lagi');  
    }
}
