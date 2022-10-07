<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    use HasFactory;
    protected $table = "matapelajaran";
    protected $guarded = [];
    protected $primaryKey = "id";
}
