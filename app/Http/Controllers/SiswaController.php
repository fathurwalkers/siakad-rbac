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

class SiswaController extends Controller
{
    public function daftar_siswa()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('dashboard.daftar-siswa', [
            'users' => $users,
            'siswa' => $siswa,
            'kelas' => $kelas,
        ]);
    }

    public function hapus_siswa(Request $request, $id)
    {
        $siswa_id = $id;
        $siswa = Siswa::find($siswa_id);
        $siswa_nama = $siswa->siswa_nama;
        $login = Login::find($siswa->login_id);
        $siswa_hapus = $siswa->forceDelete();
        $login_hapus = $login->forceDelete();
        if ($siswa_hapus == true) {
            $alert = "Data Siswa " . $siswa_nama . " telah berhasil dihapus.";
            return redirect()->route('daftar-siswa')->with('status', $alert);
        } else {
            $alert = "Data Siswa " . $siswa_nama . " gagal dihapus.";
            return redirect()->route('daftar-siswa')->with('status', $alert);
        }
    }

    public function post_ubah_siswa(Request $request, $id)
    {
        $siswa_id = $id;
        $siswa_nama = $request->siswa_nama;
        $siswa_telepon = $request->siswa_telepon;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $siswa = siswa::find($siswa_id);
        $siswa_login = Login::find($siswa->login_id);
        $siswa_login_update = $siswa_login->update([
            'login_nama' => $siswa_nama,
            'login_telepon' => $siswa_telepon,
            'updated_at' => now()
        ]);
        $siswa_update = $siswa->update([
            'siswa_nama' => $siswa_nama,
            'siswa_telepon' => $siswa_telepon,
            'updated_at' => now()
        ]);
        if ($siswa_update == true) {
            $alert = "Data Siswa " . $siswa_nama . " telah berhasil diubah.";
            return redirect()->route('daftar-siswa')->with('status', $alert);
        } else {
            $alert = "Data Siswa " . $siswa_nama . " gagal diubah.";
            return redirect()->route('daftar-siswa')->with('status', $alert);
        }
    }

    public function tambah_siswa(Request $request)
    {
        $faker                  = Faker::create('id_ID');
        $siswa = new Siswa;
        $gambar_cek = $request->file('foto');
        if (!$gambar_cek) {
            $gambar = "null;";
        } else {
            $randomNamaGambar = Str::random(10) . '.jpg';
            $gambar = $request->file('foto')->move(public_path('foto'), strtolower($randomNamaGambar));
        }

        $siswa_nama = $request->siswa_nama;
        $siswa_nisn = $request->siswa_nisn;
        $siswa_telepon = $request->siswa_telepon;
        $siswa_alamat = $request->siswa_alamat;
        $siswa_jeniskelamin = $request->siswa_jeniskelamin;
        $siswa_status = "AKTIF";

        // GENERATE DATA LOGIN
        $login = new Login;
        $token = Str::random(16);
        $level = "user";
        $hashPassword = Hash::make('12345', [
            'rounds' => 12,
        ]);
        $hashToken = Hash::make($token, [
            'rounds' => 12,
        ]);
        $username = strtolower(Str::random(10));
        $save_login = $login->create([
            'login_nama'        => $siswa_nama,
            'login_username'    => $username,
            'login_password'    => $hashPassword,
            'login_email'       => $faker->email(),
            'login_telepon'     => $siswa_telepon,
            'login_token'       => $hashToken,
            'login_level'       => $level,
            'login_status'      => "verified",
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $save_login->save();

        $login_id = $save_login->id;
        $kelas_id = $request->siswa_kelas;

        // GENERATE DATA SISWA
        $save_siswa = $siswa->create([
            'siswa_nama' => $siswa_nama,
            'siswa_nisn' => $siswa_nisn,
            'siswa_jeniskelamin' => $siswa_jeniskelamin,
            'siswa_alamat' => $siswa_alamat,
            'siswa_telepon' => $siswa_telepon,
            'siswa_foto' => $gambar->getFileName(),
            'siswa_status' => $siswa_status,
            'login_id' => $save_login->id,
            'kelas_id' => $kelas_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $save_siswa->save();
        return redirect()->route('daftar-siswa')->with('status', 'Berhasil Menambah Data Siswa.');
    }
}
