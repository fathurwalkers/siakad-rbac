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

    public function input_nilai_kelas()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $kelas = Kelas::all();
        return view('dashboard.input-nilai-kelas', [
            'users' => $users,
            'kelas' => $kelas,
        ]);
    }

    public function input_nilai_matapelajaran($id)
    {
        $kelas_id = $id;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $kelas = Kelas::find($kelas_id);
        $matapelajaran = Matapelajaran::all();
        return view('dashboard.input-nilai-matapelajaran', [
            'users' => $users,
            'kelas' => $kelas,
            'matapelajaran' => $matapelajaran,
        ]);
    }

    public function input_nilai($matapelajaran_id, $kelas_id)
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $kelas = Kelas::find($kelas_id);
        $nilai = Nilai::where('matapelajaran_id', $matapelajaran->id)->where('kelas_id', $kelas->id)->get();
        return view('dashboard.input-nilai', [
            'users' => $users,
            'nilai' => $nilai,
            'kelas' => $kelas,
            'matapelajaran' => $matapelajaran,
        ]);
    }

    public function post_input_nilai(Request $request, $matapelajaran_id, $kelas_id)
    {
        $session_users = session('data_login');

        $iter = $request->iter;
        $matapelajaran = Matapelajaran::find($matapelajaran_id);
        $kelas = Kelas::find($kelas_id);
        $nilai_iter = Nilai::where('matapelajaran_id', $matapelajaran->id)->get();

        $sis = 1;
        $mat = 1;
        $tugas = 1;
        $absensi = 1;
        $uts = 1;
        $uas = 1;
        $ratarata = 1;
        $keterangan = 1;

        // dump($request->nilai_siswa_tugas);
        // dump($request->nilai_siswa_absensi);
        // dump($request->nilai_siswa_uts);
        // dump($request->nilai_siswa_uas);
        // dump($request->nilai_siswa_ratarata);
        // dump($request->nilai_siswa_keterangan);
        // die;

        foreach ($request->increment as $items) {
            $siswa = Siswa::find($request->siswa_id[$sis]);
            $matapelajaran = Matapelajaran::find($request->matapelajaran_id[$mat]);
            // $siswa = Siswa::find($items->siswa_id);
            // $matapelajaran = Matapelajaran::find($items->matapelajaran_id);

            $nilai = Nilai::where('siswa_id', $siswa->id)->where('matapelajaran_id', $matapelajaran->id)->first();

            $cek_nilai_tugas = $request->nilai_siswa_tugas[$tugas];
            $cek_nilai_absensi = $request->nilai_siswa_absensi[$absensi];
            $cek_nilai_uts = $request->nilai_siswa_uts[$uts];
            $cek_nilai_uas = $request->nilai_siswa_uas[$uas];
            $cek_nilai_ratarata = $request->nilai_siswa_ratarata[$ratarata];
            $cek_nilai_keterangan = $request->nilai_siswa_keterangan[$keterangan];

            if ($cek_nilai_tugas == null) {
                $nilai_tugas = $nilai->nilai_siswa_tugas;
            } else {
                $nilai_tugas = $request->nilai_siswa_tugas[$tugas];
            }

            if ($cek_nilai_absensi == null) {
                $nilai_absensi = $nilai->nilai_siswa_absensi;
            } else {
                $nilai_absensi = $request->nilai_siswa_absensi[$absensi];
            }

            if ($cek_nilai_uts == null) {
                $nilai_uts = $nilai->nilai_siswa_uts;
            } else {
                $nilai_uts = $request->nilai_siswa_uts[$uts];
            }

            if ($cek_nilai_uas == null) {
                $nilai_uas = $nilai->nilai_siswa_uas;
            } else {
                $nilai_uas = $request->nilai_siswa_uas[$uas];
            }

            if ($cek_nilai_ratarata == null) {
                $nilai_ratarata = $nilai->nilai_siswa_ratarata;
            } else {
                $nilai_ratarata = $request->nilai_siswa_ratarata[$ratarata];
            }

            if ($cek_nilai_keterangan == null) {
                $nilai_keterangan = $nilai->nilai_siswa_keterangan;
            } else {
                $nilai_keterangan = $request->nilai_siswa_keterangan[$keterangan];
            }

            // dump($cek_nilai_tugas);
            // dump($cek_nilai_absensi);
            // dump($cek_nilai_uts);
            // dump($cek_nilai_uas);
            // dump($cek_nilai_ratarata);
            // dump($cek_nilai_keterangan);

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
            // dump($sis);
            // dump($mat);
            // dump($tugas);
            // dump($absensi);
            // dump($uts);
            // dump($uas);
            // dump($ratarata);
            // dump($keterangan);
            // $sis =+ 1;
            // $mat =+ 1;
            // $tugas =+ 1;
            // $absensi =+ 1;
            // $uts =+ 1;
            // $uas =+ 1;
            // $ratarata =+ 1;
            // $keterangan =+ 1;
        }
        return redirect()->route('input-nilai-matapelajaran', [$matapelajaran->id, $kelas->id])->with('status', 'Berhasil melakukan input nilai.');
    }
}
