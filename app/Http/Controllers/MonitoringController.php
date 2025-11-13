<?php

namespace App\Http\Controllers;

use App\Models\M_tamu;
use App\Models\M_acara;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index(){
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        $tamu = M_tamu::where('acara_id', $acara->id)->where('konfirmasi_kehadiran', true)->orderBy('waktu_hadir', 'desc')->first();
        return view('monitoring.index',[
            'tamu' => $tamu,
            'acara' => $acara
        ]);
    }
}
