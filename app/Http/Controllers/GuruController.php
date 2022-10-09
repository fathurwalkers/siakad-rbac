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

class GuruController extends Controller
{
    public function daftar_guru()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $guru = Guru::all();
        return view('dashboard.daftar-guru', [
            'users' => $users,
            'guru' => $guru
        ]);
    }
}
