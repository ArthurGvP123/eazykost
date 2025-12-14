<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\RentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KostController extends Controller
{
    // Halaman Detail Publik
    public function show($slug)
    {
        $kost = Kost::where('slug', $slug)->firstOrFail();
        
        // Cek apakah user yang login sudah pernah mengajukan sewa di kos ini
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = RentRequest::where('kost_id', $kost->id)
                                     ->where('user_id', Auth::id())
                                     ->exists();
        }

        return view('kost.show', compact('kost', 'hasApplied'));
    }

    // Aksi "Hubungi / Ajukan Sewa"
    public function requestRent($id)
    {
        // Cegah Pemilik menyewa
        if (Auth::user()->role === 'owner') {
            return back()->with('error', 'Pemilik kos tidak dapat mengajukan sewa.');
        }

        // Cegah Spam (Double Request)
        $existing = RentRequest::where('kost_id', $id)->where('user_id', Auth::id())->first();
        if ($existing) {
            return back()->with('info', 'Anda sudah mengirim permintaan sebelumnya.');
        }

        RentRequest::create([
            'kost_id' => $id,
            'user_id' => Auth::id(),
            'status' => 'pending'
        ]);

        return back()->with('success', 'Permintaan terkirim! Pemilik akan menghubungi Anda.');
    }

    // [BARU] Halaman Riwayat Pengajuan Saya
    public function myRequests()
    {
        // Ambil data RentRequest milik user yang login
        // 'with' digunakan untuk mengambil data kost dan gambarnya sekaligus (Eager Loading)
        $requests = RentRequest::where('user_id', Auth::id())
                               ->with('kost.images') 
                               ->latest()
                               ->get();

        return view('kost.my_requests', compact('requests'));
    }
}