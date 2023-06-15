<?php

namespace App\Http\Controllers;

use App\Http\Resources\santriResource;
use App\Models\santriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class santriController extends Controller
{
    public function index()
    {
        $data = santriModel::get();
        return response()->json([
            'status' => true,
            'data' => santriResource::collection($data)
        ]);
    }
    public function createSantri(Request $request)
    {
        $file = new santriModel();
        $file->nama_santri = $request->nama_santri;
        $file->nama_ayah = $request->nama_ayah;
        $file->ttl = $request->ttl;
        $file->alamat = $request->alamat;
        $file->kode_kabupaten = $request->kode_kabupaten;
        $file->kode_provinsi = $request->kode_provinsi;
        $file->kode_kecamatan = $request->kode_kecamatan;
        $file->kode_kelurahan = $request->kode_kelurahan;
        $file->telp_wali = $request->telp_wali;
        $file->id_lembaga = $request->id_lembaga;
        $file->pend_terakhir = $request->pend_terakhir;
        $file->jilid = $request->jilid;
        $file->save();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Menambahkan Santri'
        ]);
    }

    public function showSantri($id)
    {
        $santri = santriModel::find($id);
        return response()->json([
            'status' => true,
            'data' => $santri
        ]);
    }
    public function updateSantri(Request $request, $id)
    {

        $file = santriModel::find($id);
        $file->nama_santri = $request->nama_santri;
        $file->nama_ayah = $request->nama_ayah;
        $file->ttl = $request->ttl;
        $file->alamat = $request->alamat;
        $file->kode_kabupaten = $request->kode_kabupaten;
        $file->kode_provinsi = $request->kode_provinsi;
        $file->kode_kecamatan = $request->kode_kecamatan;
        $file->kode_kelurahan = $request->kode_kelurahan;
        $file->telp_wali = $request->telp_wali;
        $file->id_lembaga = $request->id_lembaga;
        $file->pend_terakhir = $request->pend_terakhir;
        $file->jilid = $request->jilid;
        $file->save();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Update Santri'
        ]);
    }
    public function deleteSantri($id)
    {
        $file = santriModel::find($id);
        $file->delete();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Santri'
        ]);
    }
}
