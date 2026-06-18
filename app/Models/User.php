<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'nama_lengkap',
        'nip',
        'nidn',
        'kode_dosen',
        'role',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public $timestamps = true; // uses `created_at`

    /**
     * Role helpers
     */
    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }

    public function isKaprodi()
    {
        return strtolower($this->role) === 'kaprodi';
    }

    public function isDosenWali()
    {
        $r = strtolower($this->role);
        return in_array($r, ['dosen wali', 'dosen_wali', 'dosenwali', 'dosen-wali']);
    }
}

class DataAkademik extends Model
{
    protected $table = 'data_akademik';

    protected $fillable = [
        'kurikulum',
        'angkatan',
        'periode_akademik',
        'kode_dosen'
    ];
}
