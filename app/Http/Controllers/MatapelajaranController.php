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

class MatapelajaranController extends Controller
{
    public function daftar_matapelajaran()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $matapelajaran = Matapelajaran::all();
        return view('dashboard.daftar-matapelajaran', [
            'users' => $users,
            'matapelajaran' => $matapelajaran
        ]);
    }

    public function post_tambah_matapelajaran(Request $request)
    {
        $matapelajaran_nama = $request->matapelajaran_nama;
        $matapelajaran_kode = "MAPEL-" . strtoupper(Str::random(5));
        $matapelajaran = new Matapelajaran;
        $save_matapelajaran = $matapelajaran->create([
            'matapelajaran_nama'    => $matapelajaran_nama,
            'matapelajaran_kode'    => $matapelajaran_kode,
            'created_at'            => now(),
            'updated_at'            => now()
        ]);
        $save_matapelajaran->save();
        $alert = "Mata Pelajaran (" . $save_matapelajaran->matapelajaran_nama . ") Berhasil di tambahkan.";
        return redirect()->route('daftar-matapelajaran')->with('status', $alert);
    }

    public function post_ubah_matapelajaran(Request $request, $id)
    {
        $matapelajaran_nama = $request->matapelajaran_nama;
        $matapelajaran_id = $id;
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $matapelajaran_before = $matapelajaran->matapelajaran_nama;
        $save_matapelajaran = $matapelajaran->update([
            'matapelajaran_nama'    => $matapelajaran_nama,
            'updated_at'            => now()
        ]);
        $matapelajaran_after = $matapelajaran->matapelajaran_nama;
        $alert = "Mata Pelajaran (" . $matapelajaran_before . ") Berhasil di ubah menjadi (" . $matapelajaran_after . ").";
        return redirect()->route('daftar-matapelajaran')->with('status', $alert);
    }
}
