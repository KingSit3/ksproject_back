<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $dbFitrah = DB::table('fitrah')->where('deleted_at',  '=', null)->whereYear('updated_at', '=', $currentYear);
        
        $data = [
            'infaq' => [
                'year' => $currentYear,
                'totalInfaq' => DB::table('infaq')
                                    ->where('deleted_at',  '=', null)
                                    ->whereYear('updated_at', '=', $currentYear)
                                    ->select( DB::raw('SUM(jumlah) as total'), DB::raw('MONTHNAME(updated_at) as month') )
                                    ->groupBy('month')
                                    ->orderBy('updated_at', 'ASC')
                                    ->get()
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
