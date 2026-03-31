<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\LaporanStatusNotification;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik Laporan
        $totalCount = Laporan::count();
        $baruCount = Laporan::where('status', 'baru')->count();
        $prosesCount = Laporan::where('status', 'diproses')->count();
        $selesaiCount = Laporan::where('status', 'selesai')->count();

        // 5 Laporan Terbaru
        $recentReports = Laporan::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data Chart (7 hari terakhir)
        $chartData = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->isoFormat('ddd');
            $chartData[] = Laporan::whereDate('created_at', $date)->count();
        }

        return view('dashboardadmin.dashboardAdmin', compact(
            'totalCount',
            'baruCount',
            'prosesCount',
            'selesaiCount',
            'recentReports',
            'chartData',
            'labels'
        ));
    }

    public function semuaLaporan()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboardadmin.semualaporan', compact('laporans'));
    }

    public function filterLaporan(Request $request)
    {
        $query = Laporan::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $laporans = $query->paginate(10);
        return view('dashboardadmin.filterlaporan', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('dashboardadmin.detaillaporan', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai,ditolak',
        ]);

        $laporan = Laporan::with('user')->findOrFail($id);
        $oldStatus = $laporan->status;
        $laporan->status = $request->status;
        $laporan->save();

        // Kirim notifikasi ke pelapor jika status berubah
        if ($oldStatus !== $laporan->status && $laporan->user) {
            $laporan->user->notify(new LaporanStatusNotification($laporan));
        }

        return redirect()->back()->with('success', 'Status laporan #' . $laporan->id . ' berhasil diperbarui!');
    }

    // ========================
    // PROFIL ADMIN
    // ========================
    public function profil()
    {
        $admin = Auth::user();
        return view('dashboardadmin.profiladmin', compact('admin'));
    }

    public function updateProfil(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $admin->id,
            'telepon'   => 'nullable|string|max:20',
            'nip'       => 'nullable|string|max:30',
            'instansi'  => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'telepon'  => $request->telepon,
            'nip'      => $request->nip,
            'instansi' => $request->instansi,
        ];

        if ($request->hasFile('foto_profil')) {
            if ($admin->foto_profil) {
                Storage::delete($admin->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profil');
        }

        $admin->update($data);

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.'])->with('tab', 'keamanan');
        }

        $admin->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.profil')->with('success', 'Kata sandi berhasil diperbarui.')->with('tab', 'keamanan');
    }
}
