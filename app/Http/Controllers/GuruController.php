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
        $kelas = Kelas::all();
        $semester = Semester::all();
        $matapelajaran = Matapelajaran::all();
        return view('dashboard.daftar-guru', [
            'users' => $users,
            'guru' => $guru,
            'kelas' => $kelas,
            'semester' => $semester,
            'matapelajaran' => $matapelajaran,
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

    public function tambah_guru(Request $request)
    {
        $faker                  = Faker::create('id_ID');
        $guru = new Guru;
        $gambar_cek = $request->file('foto');
        if (!$gambar_cek) {
            $gambar = "null;";
        } else {
            $randomNamaGambar = Str::random(10) . '.jpg';
            $gambar = $request->file('foto')->move(public_path('foto'), strtolower($randomNamaGambar));
        }

        $guru_nama = $request->guru_nama;
        $guru_nip = $request->guru_nip;
        $guru_telepon = $request->guru_telepon;
        $guru_alamat = $request->guru_alamat;
        $guru_jeniskelamin = $request->guru_jeniskelamin;
        $guru_status = "AKTIF";
        $guru_kode = strtoupper(Str::random(10));

        $kelas_id = $request->kelas_id;
        $matapelajaran_id = $request->matapelajaran_id;
        $semester_id = $request->semester_id;

        $kelas = Kelas::find($kelas_id);
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $semester = Semester::find($semester_id);

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
            'login_nama'        => $guru_nama,
            'login_username'    => $username,
            'login_password'    => $hashPassword,
            'login_email'       => $faker->email(),
            'login_telepon'     => $guru_telepon,
            'login_token'       => $hashToken,
            'login_level'       => $level,
            'login_status'      => "verified",
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $save_login->save();

        $login_id = $save_login->id;

        // GENERATE DATA guru
        $save_guru = $guru->create([
            'guru_nama' => $guru_nama,
            'guru_nip' => $guru_nip,
            'guru_jeniskelamin' => $guru_jeniskelamin,
            'guru_alamat' => $guru_alamat,
            'guru_telepon' => $guru_telepon,
            'guru_foto' => $gambar->getFileName(),
            'guru_status' => $guru_status,
            'guru_kode' => $guru_kode,
            'login_id' => $save_login->id,
            'semester_id' => $semester->id,
            'kelas_id' => $kelas->id,
            'matapelajaran_id' => $matapelajaran->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $save_guru->save();
        return redirect()->route('daftar-guru')->with('status', 'Berhasil Menambah Data Guru.');
    }
}
