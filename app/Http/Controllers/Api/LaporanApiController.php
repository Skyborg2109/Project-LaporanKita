<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanApiController extends Controller
{
    /**
     * GET /api/laporan
     * Ambil semua laporan (public)
     */
    public function index(Request $request)
    {
        $query = Laporan::with('user:id,name,email');

        // Filter by status (opsional)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori (opsional)
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search by judul (opsional)
        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $laporans = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data laporan berhasil diambil',
            'data'    => $laporans,
        ], 200);
    }

    /**
     * GET /api/laporan/{id}
     * Ambil detail satu laporan
     */
    public function show($id)
    {
        $laporan = Laporan::with('user:id,name,email')->find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail laporan berhasil diambil',
            'data'    => $laporan,
        ], 200);
    }

    /**
     * POST /api/laporan
     * Buat laporan baru (perlu auth token)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'lokasi'    => 'nullable|string|max:255',
            'foto'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $laporan = Laporan::create([
            'user_id'   => $request->user()->id,
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'lokasi'    => $request->lokasi,
            'foto'      => $request->foto,
            'status'    => 'baru',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data'    => $laporan->load('user:id,name,email'),
        ], 201);
    }

    /**
     * PUT /api/laporan/{id}
     * Update laporan (perlu auth token, hanya pemilik)
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        // Cek apakah user adalah pemilik laporan
        if ($laporan->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak berhak mengubah laporan ini',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'judul'     => 'sometimes|required|string|max:255',
            'kategori'  => 'sometimes|required|string|max:100',
            'deskripsi' => 'sometimes|required|string',
            'lokasi'    => 'nullable|string|max:255',
            'foto'      => 'nullable|string',
            'status'    => 'sometimes|in:baru,diproses,selesai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $laporan->update($request->only(['judul', 'kategori', 'deskripsi', 'lokasi', 'foto', 'status']));

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui',
            'data'    => $laporan->load('user:id,name,email'),
        ], 200);
    }

    /**
     * DELETE /api/laporan/{id}
     * Hapus laporan (perlu auth token, hanya pemilik)
     */
    public function destroy(Request $request, $id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        // Cek apakah user adalah pemilik laporan
        if ($laporan->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak berhak menghapus laporan ini',
            ], 403);
        }

        $laporan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus',
        ], 200);
    }

    /**
     * GET /api/laporan/saya
     * Ambil laporan milik user yang sedang login
     */
    public function myLaporan(Request $request)
    {
        $laporans = Laporan::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data laporan saya berhasil diambil',
            'data'    => $laporans,
        ], 200);
    }
}
