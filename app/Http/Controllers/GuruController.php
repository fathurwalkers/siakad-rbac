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

    public function hapus_guru(Request $request, $id)
    {
        $guru_id = $id;
        $guru = Guru::find($guru_id);
        $guru_nama = $guru->guru_nama;
        $login = Login::find($guru->login_id);
        $guru_hapus = $guru->forceDelete();
        $login_hapus = $login->forceDelete();
        if ($guru_hapus == true) {
            $alert = "Data Guru " . $guru_nama . " telah berhasil dihapus.";
            return redirect()->route('daftar-guru')->with('status', $alert);
        } else {
            $alert = "Data Guru " . $guru_nama . " gagal dihapus.";
            return redirect()->route('daftar-guru')->with('status', $alert);
        }
    }

    public function post_ubah_guru(Request $request, $id)
    {
        $guru_id = $id;
        $guru_nama = $request->guru_nama;
        $guru_telepon = $request->guru_telepon;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $guru = Guru::find($guru_id);
        $guru_login = Login::find($guru->login_id);
        $guru_login_update = $guru_login->update([
            'login_nama' => $guru_nama,
            'login_telepon' => $guru_telepon,
            'updated_at' => now()
        ]);
        $guru_update = $guru->update([
            'guru_nama' => $guru_nama,
            'guru_telepon' => $guru_telepon,
            'updated_at' => now()
        ]);
        if ($guru_update == true) {
            $alert = "Data Guru " . $guru_nama . " telah berhasil diubah.";
            return redirect()->route('daftar-guru')->with('status', $alert);
        } else {
            $alert = "Data Guru " . $guru_nama . " gagal diubah.";
            return redirect()->route('daftar-guru')->with('status', $alert);
        }
    }
}
