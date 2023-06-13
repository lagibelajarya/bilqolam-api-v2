<?php

namespace App\Http\Controllers;

use App\Http\Resources\lembagaResource;
use App\Mail\userMail;
use App\Models\lembagaModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function loginPageData()
    {
        $data = lembagaModel::get();
        return response()->json([
            'status' => true,
            'data' => lembagaResource::collection($data)
        ]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => 'Login Failed'
                ]
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => 'Email atau password yang anda masukan salah'
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('auth')->accessToken
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email Sudah Terdaftar'
            ]);
        }
        $rowCount = lembagaModel::get();
        $file = new lembagaModel();
        $file->no_reg = date('ymd') . count($rowCount) + 1;
        $file->nama = $request->nama;
        $file->alamat = $request->alamat;
        $file->email = $request->email;
        $file->status = $request->status;
        $file->no_hp = $request->no_hp;
        $file->no_nsl = $request->no_nsl;
        $file->no_npl = $request->no_npl;
        $file->jml_santri = $request->jml_santri;
        $file->jml_guru = $request->jml_guru;
        $file->kode_kabupaten = $request->kode_kabupaten;
        $file->kode_provinsi = $request->kode_provinsi;
        $file->kode_kecamatan = $request->kode_kecamatan;
        $file->kode_kelurahan = $request->kode_kelurahan;
        if (empty($request->kode_pos)) {
            $file->kode_pos = null;
        } else {

            $file->kode_pos = $request->kode_pos;
        }
        $file->save();

        $newUser = new User();
        $newUser->name = $request->nama;
        $newUser->email = $request->email;
        $newUser->role = 'user';
        $newUser->foto = null;
        $newUser->password = Hash::make(md5($request->email));
        $newUser->save();
        $email = $request->email;
        $sendMail = Mail::to($email)->send(new userMail($email, md5($email)));
        return response()->json([
            'message' => 'Registrasi Berhasil, Silahkan check email anda'
        ]);
    }
    public function logout(Request $request)
    {

        $removeToken = $request->user()->tokens()->delete();
        if ($removeToken) {
            return response()->json([
                'status' => true,
                'message' => 'Logout Success!',
            ], 200);
        }
    }

    public function make()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->role = 'admin';
        $user->foto = null;
        $user->password = Hash::make('admin');
        $user->save();
        return response()->json([
            'Berhasil Membuat admin'
        ]);
    }
}
