<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Matapelajaran;
use App\Models\Nilai;
use App\Models\Semester;
use Illuminate\Support\Facades\Redis;

class KelasController extends Controller
{
    public function daftar_kelas()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        return view('dashboard.daftar-kelas', [
            'users' => $users
        ]);
    }
}
