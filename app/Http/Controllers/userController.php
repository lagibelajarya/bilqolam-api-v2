<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($request->foto)) {
            $foto = $this->uploadImg($request->foto);
            $user->foto = $foto;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Update User'
        ]);
    }

    public function uploadImg($img)
    {

        $extFile = $img->getClientOriginalName();
        $path = $img->move('foto', $extFile);
        $path = str_replace('\\', '/', $path);
        return $path;
    }
}
