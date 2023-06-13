<?php

namespace App\Http\Controllers;

use App\Models\wilayahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class wilayahController extends Controller
{
    public function selectWilayah(Request $request)
    {
        $n = strlen($request->id);
        $m = ($n == 2 ? 5 : ($n == 5 ? 8 : 13));
        $wilayah = '';
        if ($request->nama == 'provinsi') {
            $wilayah = 'kabupaten';
        } else if ($request->nama == 'kabupaten') {
            $wilayah = 'kecamatan';
        } else if ($request->nama == 'kecamatan') {
            $wilayah = 'kelurahan';
        }
        $query = wilayahModel::select('kode', 'nama_wilayah')
            ->whereRaw("LEFT(kode, $n) = '$request->id'")
            ->whereRaw("CHAR_LENGTH(kode) = $m")
            ->orderBy('nama_wilayah')
            ->get();

        return response()->json([
            'status' => true,
            'wilayah' => $wilayah,
            'data' => $query
        ]);
    }
}
