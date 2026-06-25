<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_new_user()
    {
        // 1. Buat user admin
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // 2. Kirim request store user baru
        $response = $this->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => 'user',
                'telepon' => '081234567890',
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Mawar No. 12',
            ]);

        // 3. Pastikan redirect ke halaman manajemen user dan status sukses
        $response->assertRedirect(route('admin.users'));
        $response->assertSessionHas('success');

        // 4. Pastikan data tersimpan di database
        $this->assertDatabaseHas('users', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'role' => 'user',
            'telepon' => '081234567890',
            'nik' => '1234567890123456',
            'alamat' => 'Jl. Mawar No. 12',
            'is_active' => true,
        ]);
    }

    public function test_non_admin_cannot_store_new_user()
    {
        // 1. Buat user biasa (pelapor)
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        // 2. Kirim request store user baru (harusnya diblok oleh middleware role:admin)
        $response = $this->actingAs($user)
            ->post(route('admin.users.store'), [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => 'user',
            ]);

        // 3. Pastikan dialihkan ke halaman utama dengan error
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
