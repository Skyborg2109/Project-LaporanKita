<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /** Halaman Semua Laporan (publik, dengan filter & search) */
    public function semualaporan(Request $request)
    {
        $query = Laporan::with(['user', 'supports'])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search judul / deskripsi
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%");
            });
        }

        $laporans     = $query->paginate(12)->appends($request->all());
        $totalLaporan = Laporan::count();
        $totalDiproses = Laporan::where('status', 'diproses')->count();
        $totalSelesai  = Laporan::where('status', 'selesai')->count();

        // Cek laporan yang sudah didukung user (jika login)
        $supportedLaporanIds = collect();
        if (auth()->check()) {
            $supportedLaporanIds = \App\Models\Support::where('user_id', auth()->id())
                ->pluck('laporan_id');
        }

        return view('public.semualaporan', compact(
            'laporans', 'totalLaporan', 'totalDiproses', 'totalSelesai', 'supportedLaporanIds'
        ));
    }

    /** Halaman Pelajari Lebih Lanjut – info layanan darurat */
    public function pelajari()
    {
        return view('public.pelajari');
    }

    /** Halaman Syarat & Ketentuan */
    public function syaratKetentuan()
    {
        return view('public.syarat-ketentuan');
    }

    /** Halaman Kebijakan Privasi */
    public function kebijakanPrivasi()
    {
        return view('public.kebijakan-privasi');
    }

    /** Halaman Prosedur Laporan */
    public function prosedurLaporan()
    {
        return view('public.prosedur-laporan');
    }

    /** Halaman FAQ / Bantuan */
    public function faq()
    {
        return view('public.faq');
    }
}
