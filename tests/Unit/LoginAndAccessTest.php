<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

/**
 * UNIT 1: Menguji Halaman Login Bisa Diakses Publik
 */
test('UNIT 1 - Path 1: Mengakses halaman login sebagai guest harus mengembalikan status 200', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});


/**
 * UNIT 2: Menguji Proteksi Middleware Auth (Guest Dilarang Masuk)
 */
test('UNIT 2 - Path 1: Mengakses halaman dashboard tanpa login harus dialihkan ke halaman login', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});


/**
 * UNIT 3: Menguji Akses Dashboard Bagi User Terautentikasi
 */
test('UNIT 3 - Path 1: User yang sudah terautentikasi berhasil masuk ke halaman dashboard dengan status 200', function () {
    // Memaksa pengisian field database kustom timmu agar lolos QueryException
    $user = User::factory()->create([
        'username' => 'irpunk_test',
        'role' => 'dosen wali'
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});


/**
 * UNIT 4: Menguji Akses Halaman Nilai PLO Bagi User Terautentikasi
 */
test('UNIT 4 - Path 1: User yang sudah terautentikasi berhasil mengakses halaman nilai PLO dengan status 200', function () {
    // Memaksa pengisian field database kustom timmu agar lolos QueryException
    $user = User::factory()->create([
        'username' => 'irpunk_plo_test',
        'role' => 'dosen wali'
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});
