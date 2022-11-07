<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "absensi";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function matapelajaran()
    {
        return $this->belongsTo(Matapelajaran::class);
    }
}
