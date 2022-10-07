<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;

class Semester extends Model
{
    use HasFactory;
    protected $table = "semester";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
}
