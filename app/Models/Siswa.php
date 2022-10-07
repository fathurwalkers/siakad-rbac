<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Login;
use App\Models\Kelas;
use App\Models\Nilai;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function login()
    {
        return $this->belongsTo(Login::class);
    }
}
