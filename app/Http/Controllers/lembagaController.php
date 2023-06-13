<?php

namespace App\Http\Controllers;

use App\Http\Resources\lembagaResource;
use App\Models\lembagaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lembagaController extends Controller
{
    public function index()
    {
        $data = lembagaModel::get();
        return response()->json([
            'status' => true,
            'data' => lembagaResource::collection($data)
        ]);
    }

    public function createLembaga(Request $request)
    {
        $rowCount = lembagaModel::get();
        $file = new lembagaModel();
        $file->no_reg = date('ymd') . count($rowCount) + 1;
        $file->nama = $request->nama;
        $file->alamat = $request->alamat;
        $file->email = $request->email;
        $file->status = $request->status;
        $file->no_hp = $request->no_hp;
        if (empty($request->no_nsl)) {

            $file->no_nsl = "-";
        } else {
            $file->no_nsl = $request->no_nsl;
        }
        $file->no_npl = $request->no_npl;
        $file->jml_santri = $request->jml_santri;
        $file->jml_guru = $request->jml_guru;
        $file->kode_kabupaten = $request->kode_kabupaten;
        $file->kode_provinsi = $request->kode_provinsi;
        $file->kode_kecamatan = $request->kode_kecamatan;
        $file->kode_kelurahan = $request->kode_kelurahan;
        if (empty($request->kode_post)) {
            $file->kode_pos = "-";
        } else {
            $file->kode_pos = $request->kode_pos;
        }
        $file->save();
        return response()->json([
            'status' => true,
            'message' => 'Beerhasil Membuat Lembaga'
        ]);
    }

    public function updateLembaga(Request $request, $id)
    {
        $lembaga = lembagaModel::find($id);

        $lembaga->nama = $request->nama;
        $lembaga->alamat = $request->alamat;
        $lembaga->email = $request->email;
        $lembaga->no_hp = $request->no_hp;
        if ($request->no_nsl == "") {
            $lembaga->no_nsl = "-";
        } else {
            $lembaga->no_nsl = $request->no_nsl;
        }
        $lembaga->no_npl = $request->no_npl;
        $lembaga->jml_santri = $request->jml_santri;
        $lembaga->jml_guru = $request->jml_guru;
        $lembaga->status = $request->status;
        $lembaga->kode_provinsi = $request->kode_provinsi;
        $lembaga->kode_kabupaten = $request->kode_kabupaten;
        $lembaga->kode_kecamatan = $request->kode_kecamatan;
        $lembaga->kode_kelurahan = $request->kode_kelurahan;
        if ($request->kode_pos == "") {
            $lembaga->kode_pos = "-";
        } else {
            $lembaga->kode_pos = $request->kode_pos;
        }
        $lembaga->save();
        return response()->json([
            'status' => true,
            'message' => 'Beerhasil Update Lembaga'
        ]);
    }
    public function deleteLembaga($id)
    {
        $lembaga = lembagaModel::find($id);
        $lembaga->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Lembaga'
        ]);
    }
}
