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
                $matapelajaran = Matapelajaran::all();
                $siswa = Siswa::where('kelas_id', $kelas->id)->get();
                $nilai = Nilai::all();
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

    public function lihat_nilai_matapelajaran($id)
    {
        $matapelajaran_id = $id;
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $nilai = Nilai::where('matapelajaran_id', $matapelajaran->id)->get();
        return view('dashboard.lihat-nilai-matapelajaran', [
            'users' => $users,
            'nilai' => $nilai,
            'matapelajaran' => $matapelajaran,
        ]);
    }

    public function input_nilai_matapelajaran()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $matapelajaran = Matapelajaran::all();
        return view('dashboard.input-nilai-matapelajaran', [
            'users' => $users,
            'matapelajaran' => $matapelajaran,
        ]);
    }

    public function input_nilai($id)
    {
        $matapelajaran_id = $id;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $nilai = Nilai::where('matapelajaran_id', $matapelajaran->id)->get();
        return view('dashboard.input-nilai', [
            'users' => $users,
            'nilai' => $nilai,
            'matapelajaran' => $matapelajaran,
        ]);
    }

    public function post_input_nilai(Request $request, $id)
    {
        $matapelajaran_id = $id;
        $session_users = session('data_login');

        $iter = $request->iter;
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $nilai_iter = Nilai::where('matapelajaran_id', $matapelajaran->id)->get();

        $sis = 1;
        $mat = 1;
        $tugas = 1;
        $absensi = 1;
        $uts = 1;
        $uas = 1;
        $ratarata = 1;
        $keterangan = 1;

        foreach ($request->increment as $items) {
            $siswa = Siswa::find($request->siswa_id[$sis++]);
            $matapelajaran = Matapelajaran::find($request->matapelajaran_id[$mat++]);
            // $siswa = Siswa::find($items->siswa_id);
            // $matapelajaran = Matapelajaran::find($items->matapelajaran_id);

            $nilai = Nilai::where('siswa_id', $siswa->id)->where('matapelajaran_id', $matapelajaran->id)->first();

            $nilai_tugas = $request->nilai_siswa_tugas[$tugas++];
            $nilai_absensi = $request->nilai_siswa_absensi[$absensi++];
            $nilai_uts = $request->nilai_siswa_uts[$uts++];
            $nilai_uas = $request->nilai_siswa_uas[$uas++];
            $nilai_ratarata = $request->nilai_siswa_ratarata[$ratarata++];
            $nilai_keterangan = $request->nilai_siswa_keterangan[$keterangan++];

            $update_nilai = $nilai->update([
                "nilai_siswa_tugas" => $nilai_tugas,
                "nilai_siswa_absensi" => $nilai_absensi,
                "nilai_siswa_uts" => $nilai_uts,
                "nilai_siswa_uas" => $nilai_uas,
                "nilai_ratarata" => $nilai_ratarata,
                "nilai_keterangan" => $nilai_keterangan,
                "nilai_tanggal" => now(),
                "updated_at" => now(),
            ]);

        }
        return redirect()->route('input-nilai-matapelajaran')->with('status', 'Berhasil melakukan input nilai.');
    }
}
