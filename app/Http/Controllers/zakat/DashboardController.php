<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $dbFitrah = DB::connection('zakat')->table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear);
        
        $i = 1;

        while ($i <= 12) {
            $queryPemasukkan =  DB::connection('zakat')->table('infaq')
                                    ->where('deleted_at',  '=', null)
                                    ->whereYear('updated_at', '=', $currentYear)
                                    ->whereMonth('updated_at', '=', $i)
                                    ->select( DB::raw('SUM(jumlah) as total'))
                                    ->get();

            $queryPengeluaran =  DB::connection('zakat')->table('transaksi_infaq')
                                    ->whereYear('updated_at', '=', $currentYear)
                                    ->whereMonth('updated_at', '=', $i)
                                    ->select( DB::raw('SUM(jumlah) as total'))
                                    ->get();
            $i++;
            $dataPemasukkanInfaq[] = $queryPemasukkan;
            $dataPengeluaranInfaq[] = $queryPengeluaran;
        }

        // Optimisasi Query Infaq
        // Get all data by year
        // Loop data, lalu masukkan data per bulan / atau (kalau bisa) Pakai collection()->map()
        


        $data = [
            'infaq' => [
                'year' => $currentYear,
                'totalInfaq' => $dataPemasukkanInfaq,
                'pengeluaran' => $dataPengeluaranInfaq

                // 'totalInfaq' =>  DB::connection('zakat')->table('infaq')
                //                     ->where('deleted_at',  '=', null)
                //                     ->whereYear('updated_at', '=', $currentYear)
                //                     ->select( DB::raw('SUM(jumlah) as total'), DB::raw('MONTH(updated_at) as month') )
                //                     ->groupBy('month')
                //                     ->orderBy('updated_at', 'ASC')
                //                     ->get(),
                
                // 'pengeluaran' => DB::connection('zakat')->table('transaksi_infaq')
                //                               ->whereYear('updated_at', '=', $currentYear)
                //                               ->select( DB::raw('SUM(jumlah) as total'), DB::raw('MONTH(updated_at) as month') )
                //                               ->groupBy('month')
                //                               ->orderBy('updated_at', 'ASC')
                //                               ->get()
            ],
            'fitrah' => [
                'year' => $currentYear,
                'totalData' =>  $dbFitrah
                    ->select(
                        DB::raw("COUNT(IF(jenis = 'beras', id, NULL)) as muzakkiBeras"), 
                        DB::raw("COUNT(IF(jenis = 'uang', id, NULL)) as muzakkiUang"),
                        DB::raw("SUM(CASE WHEN jenis = 'uang' THEN jumlah ELSE 0 END) as totalUang "), 
                        DB::raw("SUM(CASE WHEN jenis = 'beras' THEN jumlah ELSE 0 END) as totalBeras ")
                            )
                    ->get(),
            ]
        ];

        return response($data, 200);
    }
}
