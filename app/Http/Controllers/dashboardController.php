<?php

namespace App\Http\Controllers;

use App\Http\Resources\lembagaResource;
use App\Models\guruModel;
use App\Models\lembagaModel;
use App\Models\santriModel;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $lembaga = lembagaModel::get();
        $allLembaga = count($lembaga);
        $nonFormal = count($lembaga->where('status', 'nonformal'));
        $formal = count($lembaga->where('status', 'formal'));
        $lembagaNow = lembagaModel::whereDate('created_at', '>=', date('Y-m-d'))->get();
        $allSantri = count(santriModel::get());
        $allGuru = count(guruModel::get());
        return response()->json([
            'lembaga_formal' => $formal,
            'lembaga_nonformal' => $nonFormal,
            'lembaga_now' => lembagaResource::collection($lembagaNow),
            'lembaga' => $allLembaga,
            'santri' => $allSantri,
            'guru' => $allGuru,
        ], 200);
    }
}
