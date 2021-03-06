<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiZakatController extends Controller
{
    public function index(){
        $user = Auth::guard('sanctum')->user();

        if ($user->tokenCan('app:zakat')) {
           $transaksi = DB::connection('zakat')
                            ->table('transaksi_zakat')
                            ->join('mustahik', 'transaksi_zakat.mustahik_id', '=', 'mustahik.id')
                            ->select('transaksi_zakat.*', 'mustahik.nama_keluarga', 'mustahik.alamat', 'mustahik.rt', 'mustahik.rw', 'mustahik.kelurahan', 'mustahik.kecamatan', 'mustahik.jumlah_anggota_keluarga')
                            ->paginate(10);

            return response($transaksi, 200);
        }

        return response("Dare?", 401);
    }

    public function searchData($keyword){
        $user = Auth::guard('sanctum')->user();

        if ($user->tokenCan('app:zakat')) {
           $transaksi = DB::connection('zakat')
                            ->table('transaksi_zakat')
                            ->join('mustahik', 'transaksi_zakat.mustahik_id', '=', 'mustahik.id')
                            ->where('mustahik.nama_keluarga', 'like', '%'.$keyword.'%')
                            ->select('transaksi_zakat.*', 'mustahik.nama_keluarga')
                            ->paginate(10);

            return response($transaksi, 200);
        }

        return response("Dare?", 401);
    }

    public function store(Request $req){
        $user = Auth::guard('sanctum')->user();

        if ($user->tokenCan('app:zakat')) {
            $req->validate([
                'mustahik_id' => 'required',
                'jenis_zakat' => 'required',
                'jumlah' => 'required',
            ]);

            try {
                DB::connection('zakat')->table('transaksi_zakat')->insert([
                    'mustahik_id' => $req['mustahik_id'],
                    'jenis_zakat' => $req['jenis_zakat'],
                    'jumlah' => $req['jumlah'],
                    'updated_at' => now()
                ]);
                return response('berhasil', 201);

            } catch (QueryException $ex) {
                return response($ex, 400);
            }

        }

        return response('Dare?!', 401);
    }

    public function delete($id){
        $user = Auth::guard('sanctum')->user();

        if ($user->tokenCan('app:zakat')) {
            try {
                DB::connection('zakat')->table('transaksi_zakat')->where('id', $id)->delete();

                return response("Berhasil dihapus", 200);
            } catch (QueryException $ex) {
                return response($ex, 400);
            }
        }

        return response('Dare?!', 401);
    }

    public function update(Request $req, $id){
        $user = Auth::guard('sanctum')->user();

        if ($user->tokenCan('app:zakat')) {
            $req->validate([
                'mustahik_id' => 'required',
                'jenis_zakat' => 'required',
                'jumlah' => 'required',
            ]);

            try {
                DB::connection('zakat')->table('transaksi_zakat')->where('id', $id)->update([
                    'mustahik_id' => $req['mustahik_id'],
                    'jenis_zakat' => $req['jenis_zakat'],
                    'jumlah' => $req['jumlah'],
                    'updated_at' => now(),
                ]);
                return response('berhasil', 201);

            } catch (QueryException $ex) {
                return response($ex, 400);
            }

        }

        return response('Dare?!', 401);
    }
}
