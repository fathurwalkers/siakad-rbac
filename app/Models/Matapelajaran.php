<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nilai;
use App\Models\Guru;

class Matapelajaran extends Model
{
    use HasFactory;
    protected $table = "matapelajaran";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
}
