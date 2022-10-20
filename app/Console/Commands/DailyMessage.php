<?php

namespace App\Console\Commands;
use App\Models\Karyawan;
use Illuminate\Console\Command;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'message:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Mengirim pesan tiap hari ke karyawan untuk mengisi fiakolilah';

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
        // $karyawan = Karyawan::where('telp_karyawan', '081329146514')->get();
        // return 0;
        $karyawan   = Karyawan::where('telp_karyawan', '!=', null)->where('blass', '0')->get();
        $value      = $karyawan->first();
        
        // penyebutan
        $jenkel;
        if ($value->jenkel == 'L') {
            # code...
            $jenkel = 'Saudara';
        }else {
            # code...
            $jenkel = 'Saudari';
        }

        set_time_limit(0);
        $curl = curl_init();
        $token = "ErPMCdWGNfhhYPrrGsTdTb1vLwUbIt35CQ2KlhffDobwUw8pgYX4TN5rDT4smiIc";
        $payload = [
            "data" => [
                [
                    'phone' =>  $value->telp_karyawan,
                    'message' => 'Assalamualaikum<br>'.$jenkel.' - '.$value->nama_karyawan.
                    '<br>*Dimohon kesediannya untuk mengisi amalan harian pada link dibawah ini*'.
                    "<br><br>*Form :*  https://form.tilawatipusat.com/form/amalan-harian-karyawan-pes-nf".
                    "<br><br>Smoga di mudahkan Alloh SWT. Aamiin YRA".
                    "<br>Terimakasih. Wassalamualaikum Wr. Wb,",
                    
                    'secret' => false, // or true
                    'retry' => false, // or true
                    'isGroup' => false, // or true
                ]
            ]
                
        ];
                
                
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
                
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        
        // update status pesan sudah terkirim
        $value->update(['blass'=>'1']);
        $this->info('Mengirim pesan kepada seluruh karyawan');  

    }
}
