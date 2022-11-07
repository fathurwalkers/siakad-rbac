<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;

class Login extends Model
{
    use HasFactory;
    protected $table = "login";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function absen()
    {
        return $this->hasMany(Absensi::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
