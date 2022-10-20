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
        // $karyawan = Karyawan::where('telp_karyawan', '!=', null)->get();
        $karyawan = Karyawan::where('telp_karyawan', '081329146514')->get();

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
                            'message' => ''.$jenkel.' - '.$value->nama_karyawan.
                            '<br>Mugi-Mugi mboten lali, hari ini habis sholat dhuha *(terus buka HP - pencet Laporan Amaliyah harian)*'.
                            '<br><br>============'.
                            '<br>Mengingatkan diri sendiri ttg.:'.
                            '<br>============'.
                            '<br><br>1. Keaktifan sholat berjamaah di Masjid (khusus Pria)'.
                            "<br>2. Pentingnya baca *Do'a tolak balak*".
                            "<br>3. Sholat sunnah *Qobliyah maupun Ba'diyah*".
                            "<br>4. Qiyamullail *(Tahajjud)* = agar tubuh sll sehat & urusan lancar".
                            "<br>5. Mendoakan *Pimpinan dan Karyawan Nf*".
                            "<br>6. Sholat *Dhuha & do'a nya*".
                            "<br>7. Istiqomah baca *Qs. Al Waqi'ah bakda Maghrib & Shubuh*".
                            "<br>8. Baca Alquran dg target *Khotam 30 juz*".
                            "<br>9. Sujud Syukur *(telah di beri nikmat,lebih dari yg lain)*".
                            "<br><br>Bismillah".
                            "<br>*Niki dalane :*  https://form.tilawatipusat.com/form/amalan-harian-karyawan-pes-nf".
                            "<br>Smoga di mudahkan Alloh SWT. Aamiin YRA",

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
