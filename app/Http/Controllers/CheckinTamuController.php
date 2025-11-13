<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use App\Models\M_tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\GuestCheckedIn;

class CheckinTamuController extends Controller
{
    public function index()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        $tamu = M_tamu::where('acara_id', $acara->id)->where('konfirmasi_kehadiran', true)->orderBy('waktu_hadir', 'desc')->get();
        return view('checkin-tamu.index', [
            'title' => 'Check-In Tamu',
            'tamu' => $tamu,
            'acara' => $acara
        ]);
    }

    public function scanner(Request $request)
    {
        $code = $request->qr_code;
        $acara_id = $request->acara_id;

        $tamu = M_tamu::where('acara_id', $acara_id)->where('qr_code', $code)->first();

        if ($tamu) {
            if ($tamu->konfirmasi_kehadiran === true) {
                return response()->json([
                    'status' => 'info',
                    'message' => $tamu->nama_lengkap . ' sudah melakukan check in.'
                ], 200);
            } else {
                $tamu->update([
                    'konfirmasi_kehadiran' => true,
                    'waktu_hadir' => now(),
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Check In Berhasil. Selamat Datang ' . $tamu->nama_lengkap
                ]);
            }
        } else {
            $tamuCheck = M_tamu::where('qr_code', $code)->first();
            if ($tamuCheck) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ada di dalam acara tersebut.'
                ], 404);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
        }
    }
}
