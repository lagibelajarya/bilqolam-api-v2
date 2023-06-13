<?php

namespace App\Http\Controllers;

use App\Http\Resources\guruResource;
use App\Models\guruModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class guruController extends Controller
{
    public function index()
    {
        $data = guruModel::get();
        return response()->json([
            'status' => true,
            'data' => guruResource::collection($data)
        ]);
    }

    public function createGuru(Request $request)
    {
        $guru = new guruModel();
        $guru->nama_guru  = $request->nama_guru;
        $guru->nama_ayah  = $request->nama_ayah;
        $guru->ttl  = $request->ttl;
        $guru->no_hp  = $request->no_hp;
        $guru->email  = $request->email;
        $guru->alamat  = $request->alamat;
        $guru->kode_provinsi  = $request->kode_provinsi;
        $guru->kode_kabupaten  = $request->kode_kabupaten;
        $guru->kode_kecamatan  = $request->kode_kecamatan;
        $guru->kode_kelurahan  = $request->kode_kelurahan;
        $guru->syahadah  = $request->syahadah;
        $guru->syahadah  = $request->syahadah;
        $guru->pendidikan  = $request->pendidikan;
        $guru->id_lembaga  = $request->id_lembaga;
        $guru->sertifikat_training  = $request->sertifikat_training;
        $guru->save();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Menambahkan Guru'
        ]);
    }


    public function updateGuru(Request $request, $id)
    {
        $guru = guruModel::find($id);
        $guru->nama_guru  = $request->nama_guru;
        $guru->nama_ayah  = $request->nama_ayah;
        $guru->ttl  = $request->ttl;
        $guru->no_hp  = $request->no_hp;
        $guru->email  = $request->email;
        $guru->alamat  = $request->alamat;
        $guru->kode_provinsi  = $request->kode_provinsi;
        $guru->kode_kabupaten  = $request->kode_kabupaten;
        $guru->kode_kecamatan  = $request->kode_kecamatan;
        $guru->kode_kelurahan  = $request->kode_kelurahan;
        $guru->syahadah  = $request->syahadah;
        $guru->syahadah  = $request->syahadah;
        $guru->pendidikan  = $request->pendidikan;
        $guru->id_lembaga  = $request->id_lembaga;
        $guru->sertifikat_training  = $request->sertifikat_training;
        $guru->save();
        $guru->save();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Updates Guru'
        ]);
    }

    public function deleteGuru($id)
    {
        $guru = guruModel::find($id);
        $guru->delete();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Guru'
        ]);
    }
}
