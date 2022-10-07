<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Matapelajaran;
use App\Models\Login;
use App\Models\Nilai;

class Guru extends Model
{
    use HasFactory;
    protected $table = "guru";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matapelajaran()
    {
        return $this->belongsTo(Matapelajaran::class);
    }

    public function login()
    {
        return $this->belongsTo(Login::class);
    }
}
