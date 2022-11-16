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

class AbsenController extends Controller
{
    public function daftar_absen()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $kelas = Kelas::all();
        return view('dashboard.daftar-absen', [
            'users' => $users,
            'kelas' => $kelas,
        ]);
    }

    public function lihat_absen_kelas($id)
    {
        $kelas_id = $id;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $kelas = Kelas::find($kelas_id);
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
        return view('dashboard.lihat-absen-kelas', [
            'users' => $users,
            'kelas' => $kelas,
            'siswa' => $siswa,
        ]);
    }

    public function lihat_absen_siswa($id)
    {
        $siswa_id = $id;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $siswa = Siswa::find($siswa_id);
        $absen = Absensi::where('siswa_id', $siswa->id)->get();
        return view('dashboard.lihat-absen-siswa', [
            'users' => $users,
            'absen' => $absen,
        ]);
    }
}
