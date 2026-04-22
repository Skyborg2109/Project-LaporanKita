<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Support;

class DashboardUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalLaporan = Laporan::where('user_id', $user->id)->count();
        $laporanDiproses = Laporan::where('user_id', $user->id)->where('status', 'diproses')->count();
        $laporanSelesai = Laporan::where('user_id', $user->id)->where('status', 'selesai')->count();

        $laporans = Laporan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Notifikasi belum dibaca
        $unreadNotifications = $user->unreadNotifications;
        $unreadCount = $unreadNotifications->count();

        return view('dashboarduser.dashboarduser', compact(
            'totalLaporan',
            'laporanDiproses',
            'laporanSelesai',
            'laporans',
            'unreadNotifications',
            'unreadCount'
        ));
    }

    public function create()
    {
        return view('dashboarduser.buatlaporan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'lokasi'  => 'nullable|string|max:255',
            'foto'    => 'required|array|min:1',
            'foto.*'  => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('laporans');
            }
        }

        Laporan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'lokasi'    => $request->lokasi,
            'foto'      => $fotoPaths,
            'status'    => 'baru',
        ]);

        return redirect()->route('dashboarduser.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show($id)
    {
        // Allow viewing any report if user is logged in
        $laporan = Laporan::with(['user', 'supports'])->findOrFail($id);
        
        // Check if user has supported this report
        $hasSupported = $laporan->supports()->where('user_id', Auth::id())->exists();
        $supportCount = $laporan->supports()->count();

        return view('dashboarduser.detaillaporan', compact('laporan', 'hasSupported', 'supportCount'));
    }

    public function laporansaya()
    {
        $user = Auth::user();
        $laporans = Laporan::where('user_id', $user->id)->get();
        return view('dashboarduser.laporansaya', compact('laporans'));
    }

    // ========================
    // NOTIFIKASI
    // ========================
    public function notifikasi()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(15);

        // Tandai semua sebagai sudah dibaca
        $user->unreadNotifications->markAsRead();

        return view('dashboarduser.notifikasi', compact('notifications'));
    }

    public function markNotifRead(Request $request)
    {
        $user = Auth::user();
        if ($request->id) {
            $notif = $user->notifications()->find($request->id);
            if ($notif) $notif->markAsRead();
        } else {
            $user->unreadNotifications->markAsRead();
        }
        return response()->json(['success' => true]);
    }

    // ========================
    // PROFIL USER
    // ========================
    public function profil()
    {
        $user = Auth::user();
        $totalLaporan = Laporan::where('user_id', $user->id)->count();
        $unreadCount = $user->unreadNotifications()->count();
        return view('dashboarduser.profiluser', compact('user', 'totalLaporan', 'unreadCount'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'telepon'     => 'nullable|string|max:20',
            'alamat'      => 'nullable|string|max:500',
            'nik'         => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
            'nik'     => $request->nik,
        ];

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profil');
        }

        // Automatic verification logic
        if (!empty($data['nik']) && !empty($data['telepon']) && !empty($data['alamat']) && !empty($data['name'])) {
            $data['is_verified'] = true;
        } else {
            $data['is_verified'] = false;
        }

        $user->update($data);

        return redirect()->route('dashboarduser.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.'])->with('tab', 'keamanan');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('dashboarduser.profil')->with('success', 'Kata sandi berhasil diperbarui.')->with('tab', 'keamanan');
    }

    // ========================
    // DUKUNGAN LAPORAN
    // ========================
    public function toggleSupport($id)
    {
        $user_id = Auth::id();
        $support = Support::where('user_id', $user_id)->where('laporan_id', $id)->first();

        if ($support) {
            $support->delete();
            $status = 'unsupported';
        } else {
            Support::create([
                'user_id' => $user_id,
                'laporan_id' => $id
            ]);
            $status = 'supported';
        }

        $count = Support::where('laporan_id', $id)->count();

        return response()->json([
            'success' => true,
            'status' => $status,
            'count' => $count
        ]);
    }
}
