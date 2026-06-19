<?php

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\AssessmentTool;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);
beforeEach(function () {
    $this->withoutVite();
});

function dosenWaliUser(): User
{
    return User::where('username', 'alifiansyahh')->firstOrFail();
}

function mahasiswaPerwalian(User $user): Mahasiswa
{
    return Mahasiswa::where('kode_dosen', $user->kode_dosen)->firstOrFail();
}

test('halaman login bisa diakses oleh guest', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('COMPASS');
});

test('login gagal jika password salah', function () {
    $response = $this->from('/login')->post('/login', [
        'username' => 'alifiansyahh',
        'password' => 'password_salah',
    ]);

    $response->assertRedirect('/login');
    $this->assertGuest();
});

test('dosen wali dapat login dan diarahkan ke dashboard', function () {
    $response = $this->post('/login', [
        'username' => 'alifiansyahh',
        'password' => 'dosenmejadua',
    ]);

    $response->assertRedirect('/dosen-wali/dashboard');
    $this->assertAuthenticated();
});

test('guest tidak dapat mengakses dashboard dosen wali', function () {
    $response = $this->get('/dosen-wali/dashboard');

    $response->assertRedirect('/login');
});

test('dosen wali dapat membuka form input nilai mahasiswa perwalian', function () {
    $user = dosenWaliUser();
    $mahasiswa = mahasiswaPerwalian($user);

    $response = $this->actingAs($user)
        ->get(route('dosen-wali.input-nilai.show', $mahasiswa->id_mahasiswa));

    $response->assertStatus(200);
    $response->assertSee('Form Input Nilai');
    $response->assertSee('Simpan Semua Nilai');
    $response->assertSee('Nilai berada dalam rentang 0 - 100');
});

test('dosen wali dapat menyimpan nilai valid mahasiswa', function () {
    $user = dosenWaliUser();
    $mahasiswa = mahasiswaPerwalian($user);
    $assessmentTool = AssessmentTool::firstOrFail();

    $response = $this->actingAs($user)
        ->post(route('dosen-wali.input-nilai.store', $mahasiswa->id_mahasiswa), [
            'nilai' => [
                $assessmentTool->id_at => 85,
            ],
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('nilai_mahasiswa', [
        'id_mahasiswa' => $mahasiswa->id_mahasiswa,
        'id_at' => $assessmentTool->id_at,
        'score' => 85,
    ]);
});
