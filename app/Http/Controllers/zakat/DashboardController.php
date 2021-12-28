<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $i = 1;

        while ($i <= 12) {
            $queryPemasukkan =  DB::connection('zakat')->table('infaq')
                                    ->where('deleted_at',  '=', null)
                                    ->whereYear('updated_at', '=', $currentYear)
                                    ->whereMonth('updated_at', '=', $i)
                                    ->sum('jumlah');
            $queryPengeluaran =  DB::connection('zakat')->table('transaksi_infaq')
                                    ->whereYear('updated_at', '=', $currentYear)
                                    ->whereMonth('updated_at', '=', $i)
                                    ->sum('jumlah');
            $i++;
            $dataPemasukkanInfaq[] = $queryPemasukkan;
            $dataPengeluaranInfaq[] = $queryPengeluaran;
        }

        $muzakkiBeras = DB::connection('zakat')->table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear)->where('jenis', '=', 'beras')->count('jumlah');
        $muzakkiUang = DB::connection('zakat')->table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear)->where('jenis', '=', 'uang')->count('jumlah');
        $totalUang = DB::connection('zakat')->table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear)->where('jenis', '=', 'uang')->sum('jumlah');
        $totalBeras = DB::connection('zakat')->table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear)->where('jenis', '=', 'beras')->sum('jumlah');

        $data = [
            'infaq' => [
                'year' => $currentYear,
                'totalInfaq' => $dataPemasukkanInfaq,
                'pengeluaran' => $dataPengeluaranInfaq
            ],
            'fitrah' => [
                'year' => $currentYear,
                'totalData' =>  [
                    'muzakkiBeras' => $muzakkiBeras, 
                    'muzakkiUang' => $muzakkiUang, 
                    'totalUang' => $totalUang, 
                    'totalBeras' => $totalBeras, 
                ]
            ]
        ];

        return response($data, 200);
    }
}
