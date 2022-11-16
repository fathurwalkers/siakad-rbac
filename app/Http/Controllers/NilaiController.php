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

class NilaiController extends Controller
{
    public function daftar_nilai()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        switch ($users->login_level) {
            case 'admin':
                $nilai = Nilai::all();
                $siswa = Siswa::all();
                $matapelajaran = Matapelajaran::all();
                return view('dashboard.daftar-nilai', [
                    'users' => $users,
                    'nilai' => $nilai,
                    'siswa' => $siswa,
                    'matapelajaran' => $matapelajaran,
                ]);
                break;
            case 'kepsek':
                $nilai = Nilai::all();
                $siswa = Siswa::all();
                $matapelajaran = Matapelajaran::all();
                return view('dashboard.daftar-nilai', [
                    'users' => $users,
                    'nilai' => $nilai,
                    'siswa' => $siswa,
                    'matapelajaran' => $matapelajaran,
                ]);
                break;
            case 'guru':
                $guru = Guru::where('login_id', $users->id)->first();
                $kelas = Kelas::find($guru->kelas_id);
                $siswa = Siswa::where('kelas_id', $kelas->id)->get();
                $nilai = Nilai::all();
                $matapelajaran = Matapelajaran::all();
                return view('dashboard.daftar-nilai', [
                    'users' => $users,
                    'nilai' => $nilai,
                    'siswa' => $siswa,
                    'matapelajaran' => $matapelajaran,
                ]);
                break;
            case 'user':
                $siswa = Siswa::where('login_id', $users->id)->first();
                $nilai = Nilai::all();
                $matapelajaran = Matapelajaran::all();
                return redirect()->route('lihat-nilai', $siswa->id);
                break;
        }
    }

    public function lihat_nilai($id)
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $siswa = Siswa::find($id);
        $nilai = Nilai::where('siswa_id', $siswa->id)->get();
        return view('dashboard.lihat-nilai', [
            'users' => $users,
            'siswa' => $siswa,
            'nilai' => $nilai,
        ]);
    }
}
