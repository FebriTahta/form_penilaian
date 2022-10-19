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
        // return 0;
        // Karyawan::update(['blass','0']);
        $reset_   = Karyawan::where('blass','0')->orwhere('blass', null)->orwhere('blass','1')->update(['blass'=>'0']);
        $karyawan = Karyawan::where('telp_karyawan', '!=', null)->where('blass','0')->get();

        foreach ($karyawan as $key => $value) {
            # code...
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
                            'message' => 'Mengingatkan<br>Yth, '.$jenkel.' - '.$value->nama_karyawan.'<br>*Dimohon untuk mengisi amalan harian pada* <br><br>*https://form.tilawatipusat.com/form/amalan-harian-karyawan-pes-nf*',

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

                Karyawan::where('id', $value->id)->update(['blass'=>'1']);
                // jeda 3 detik gagal
                // sleep(3);
        }

        $this->info('Mengirim pesan kepada seluruh karyawan');  
    }
}
