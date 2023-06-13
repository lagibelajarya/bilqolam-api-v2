<?php

namespace App\Http\Controllers;

use App\Models\guruModel;
use App\Models\lembagaModel;
use App\Models\santriModel;
use App\Models\wilayahModel;
use Illuminate\Http\Request;

class laporanController extends Controller
{
    public function getLembagaProv($keyWilayah)
    {
        $lembaga = lembagaModel::get();
        $santri = santriModel::get();
        $guru = guruModel::get();
        $wilayah = wilayahModel::whereRaw('LENGTH(kode) = ?', [2])->get();
        $rowLaporan = [];
        foreach ($wilayah as  $key => $w) {
            $totalLembaga = lembagaModel::where($keyWilayah, $w->kode)->get();
            $totalGuru = guruModel::where($keyWilayah, $w->kode)->get();
            $totalSantri = santriModel::where($keyWilayah, $w->kode)->get();
            $lembagaFormal = lembagaModel::select('*')->where([['status', '=', 'formal'], [$keyWilayah, '=', $w->kode]])->get();
            $lembagaNonFormal = lembagaModel::select('*')->where([['status', '=', 'nonformal'], [$keyWilayah, '=', $w->kode]])->get();
            if (count($rowLaporan) == 0) {
                array_push(
                    $rowLaporan,
                    [
                        'index' => $key + 1,
                        'namaWilayah' => $w->nama_wilayah,
                        'kodeWilayah' => $w->kode,
                        'totalLembaga' => count($totalLembaga),
                        'totalGuru' => count($totalGuru),
                        'totalSantri' => count($totalSantri),
                        'totalLembagaFormal' => count($lembagaFormal),
                        'totalLembagaNonFormal' => count($lembagaNonFormal),
                    ]
                );
            } else {
                $newKey =  key($rowLaporan);
                if ($rowLaporan[$newKey]['namaWilayah'] ==  $w->nama_wilayah) {
                } else {
                    array_push(
                        $rowLaporan,
                        [
                            'index' => $key + 1,
                            'namaWilayah' => $w->nama_wilayah,
                            'kodeWilayah' => $w->kode,
                            'totalLembaga' => count($totalLembaga),
                            'totalGuru' => count($totalGuru),
                            'totalSantri' => count($totalSantri),
                            'totalLembagaFormal' => count($lembagaFormal),
                            'totalLembagaNonFormal' => count($lembagaNonFormal),
                        ]
                    );
                }
            }
        }
        $allLembaga = count($lembaga);
        $allSantri = count($santri);
        $allGuru = count($guru);
        return response()->json([
            'status' => true,
            'row_lembaga' => $rowLaporan,
            'allLembaga' => $allLembaga,
            'allSantri' => $allSantri,
            'allGuru' => $allGuru,
        ]);
    }

    public function getLembagaDetail($wilayah)
    {
        $lembaga = lembagaModel::get();
        $santri = santriModel::get();
        $guru = guruModel::get();
        $rowLaporan = [];
        $n = strlen($wilayah);
        $m = ($n == 2 ? 5 : ($n == 5 ? 8 : 13));
        $wilayahName =  '';
        if ($m == 5) {
            $wilayahName = 'kode_kabupaten';
        } else if ($m == 8) {
            $wilayahName = 'kode_kecamatan';
        } else if ($m == 13) {
            $wilayahName = 'kode_kelurahan';
        }
        $rowWilayah = wilayahModel::select('kode', 'nama_wilayah')
            ->whereRaw("LEFT(kode, $n) = '$wilayah'")
            ->whereRaw("CHAR_LENGTH(kode) = $m")
            ->orderBy('nama_wilayah')
            ->get();
        foreach ($rowWilayah as $key => $w) {
            $totalLembaga = lembagaModel::where($wilayahName, $w->kode)->get();
            $totalGuru = guruModel::where($wilayahName, $w->kode)->get();
            $totalSantri = santriModel::where($wilayahName, $w->kode)->get();
            $lembagaFormal = lembagaModel::select('*')->where([['status', '=', 'formal'], [$wilayahName, '=', $w->kode]])->get();
            $lembagaNonFormal = lembagaModel::select('*')->where([['status', '=', 'nonformal'], [$wilayahName, '=', $w->kode]])->get();
            if (count($rowLaporan) == 0) {
                array_push(
                    $rowLaporan,
                    [
                        'index' => $key + 1,
                        'namaWilayah' => $w->nama_wilayah,
                        'kodeWilayah' => $w->kode,
                        'totalLembaga' => count($totalLembaga),
                        'totalGuru' => count($totalGuru),
                        'totalSantri' => count($totalSantri),
                        'totalLembagaFormal' => count($lembagaFormal),
                        'totalLembagaNonFormal' => count($lembagaNonFormal),
                    ]
                );
            } else {
                $newKey =  key($rowLaporan);
                if ($rowLaporan[$newKey]['namaWilayah'] ==  $w->nama_wilayah) {
                } else {
                    array_push(
                        $rowLaporan,
                        [
                            'index' => $key + 1,
                            'namaWilayah' => $w->nama_wilayah,
                            'kodeWilayah' => $w->kode,
                            'totalLembaga' => count($totalLembaga),
                            'totalGuru' => count($totalGuru),
                            'totalSantri' => count($totalSantri),
                            'totalLembagaFormal' => count($lembagaFormal),
                            'totalLembagaNonFormal' => count($lembagaNonFormal),
                        ]
                    );
                }
            }
        }
        $allLembaga = count($lembaga);
        $allSantri = count($santri);
        $allGuru = count($guru);
        return response()->json([
            'status' => true,
            'nama_wilayah' => $wilayahName,
            'row_lembaga' => $rowLaporan,
            'allLembaga' => $allLembaga,
            'allSantri' => $allSantri,
            'allGuru' => $allGuru,
        ]);
    }

    public function getLembagaWilayah($keyWilayah, $wilayah)
    {
        $lembaga = lembagaModel::where($keyWilayah, $wilayah)->get();
        return response()->json([
            'status' => true,
            'data' => $lembaga
        ]);
    }
    public function getGuruWilayah($keyWilayah, $wilayah)
    {
        $guru = guruModel::where($keyWilayah, $wilayah)->get();
        return response()->json([
            'status' => true,
            'data' => $guru
        ]);
    }
    public function getSantriWilayah($keyWilayah, $wilayah)
    {
        $santri = santriModel::where($keyWilayah, $wilayah)->get();
        return response()->json([
            'status' => true,
            'data' => $santri
        ]);
    }
    public function getLembagaFormalWilayah($keyWilayah, $wilayah)
    {
        $lembagaFormal = lembagaModel::select('*')->where([['status', '=', 'formal'], [$keyWilayah, '=', $wilayah]])->get();
        return response()->json([
            'status' => true,
            'data' => $lembagaFormal
        ]);
    }
    public function getLemagaNonFormalWilayah($keyWilayah, $wilayah)
    {
        $lembagaNonFormal = lembagaModel::select('*')->where([['status', '=', 'nonformal'], [$keyWilayah, '=', $wilayah]])->get();
        return response()->json([
            'status' => true,
            'data' => $lembagaNonFormal
        ]);
    }
}
