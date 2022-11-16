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
        switch ($users->login_level) {
            case 'admin':
                $kelas = Kelas::all();
                $siswa = Siswa::all();
                return view('dashboard.daftar-kelas', [
                    'users' => $users,
                    'kelas' => $kelas,
                ]);
                break;
            case 'kepsek':
                $kelas = Kelas::all();
                $siswa = Siswa::all();
                return view('dashboard.daftar-kelas', [
                    'users' => $users,
                    'kelas' => $kelas,
                ]);
                break;
            case 'guru':
                $kelas = Kelas::all();
                $siswa = Siswa::all();
                return view('dashboard.daftar-kelas', [
                    'users' => $users,
                    'kelas' => $kelas,
                ]);
                break;
            case 'user':
                $siswa = Siswa::where('login_id', $users->id)->first();
                $kelas = Kelas::find($siswa->kelas_id);
                // dd($siswa);
                return redirect()->route('lihat-kelas', $kelas->id);
                break;
        }
    }

    public function lihat_kelas($id)
    {
        $kelas_id = $id;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $kelas = Kelas::find($kelas_id);
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
        return view('dashboard.lihat-kelas', [
            'users' => $users,
            'kelas' => $kelas,
            'siswa' => $siswa,
        ]);
    }
}
