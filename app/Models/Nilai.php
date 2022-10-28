<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matapelajaran;
use App\Models\Guru;
use App\Models\Siswa;

class Nilai extends Model
{
    use HasFactory;
    protected $table = "nilai";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class);
    // }

    public function matapelajaran()
    {
        return $this->belongsTo(Matapelajaran::class);
    }
}
