<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    /**
     * POST /api/auth/register
     * Registrasi user baru
     */
    public function register(Request $request)
    {
        // Deteksi apakah payload adalah array multiple data: [{...}, {...}] atau single object {...}
        $payloads = $request->json()->all();
        $isBulk = isset($payloads[0]) && is_array($payloads[0]);
        
        $dataList = $isBulk ? $payloads : [$request->all()];
        $registeredUsers = [];
        $validationErrors = [];

        foreach ($dataList as $index => $data) {
            $validator = Validator::make($data, [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                $validationErrors[$isBulk ? "index_$index" : "errors"] = $validator->errors();
                continue; // Lanjut ke data berikutnya jika bulk, jika single ya lanjut dan akan kena block di bawah
            }

            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'user',
            ]);

            $token = $user->createToken('api-token')->plainTextToken;

            $registeredUsers[] = [
                'user'  => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ];
        }

        // Jika semua data gagal divalidasi
        if (count($registeredUsers) === 0 && count($validationErrors) > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validationErrors,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => $isBulk ? count($registeredUsers) . ' registrasi berhasil' : 'Registrasi berhasil',
            'data'    => $isBulk ? $registeredUsers : $registeredUsers[0],
            'errors'  => count($validationErrors) > 0 ? $validationErrors : null,
        ], 201);
    }

    /**
     * POST /api/auth/login
     * Login user dan dapatkan token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'user'       => $user,
                'token'      => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }

    /**
     * POST /api/auth/logout
     * Logout user (hapus token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ], 200);
    }

    /**
     * GET /api/auth/me
     * Ambil data user yang sedang login
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data'    => $request->user(),
        ], 200);
    }
}
