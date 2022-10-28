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

class GenerateController extends Controller
{
    public function generate_siswa()
    {
        $faker                  = Faker::create('id_ID');
        $kelas = Kelas::all()->toArray();

        for ($i=0; $i < 25; $i++) {
            $kelas_random = Arr::random($kelas);
            $siswa = new Siswa;
            $login = new Login;
            $array_gender = ["L", "P"];
            $foto = "default-user.png";
            $gender = Arr::random($array_gender);
            $nisn = $faker->randomNumber(8);
            $telepon = $faker->phoneNumber();
            $status = "AKTIF";
            $alamat = $faker->address();
            switch ($gender) {
                case "L":
                    $nama = $faker->firstNameMale() . " " . $faker->lastNameMale();
                    break;
                case "P":
                    $nama = $faker->firstNameFemale() . " " . $faker->lastNameFemale();
                    break;
            }

            // GENERATE DATA LOGIN
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
                'login_nama'        => $nama,
                'login_username'    => $username,
                'login_password'    => $hashPassword,
                'login_email'       => $faker->email(),
                'login_telepon'     => $telepon,
                'login_token'       => $hashToken,
                'login_level'       => $level,
                'login_status'      => "verified",
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
            $save_login->save();

            // GENERATE DATA SISWA
            $save_siswa = $siswa->create([
                'siswa_nama' => $nama,
                'siswa_nisn' => $nisn,
                'siswa_jeniskelamin' => $gender,
                'siswa_alamat' => $alamat,
                'siswa_telepon' => $telepon,
                'siswa_foto' => $foto,
                'siswa_status' => $status,
                'login_id' => $save_login->id,
                'kelas_id' => $kelas_random["id"],
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_siswa->save();
        }
        // return redirect()->route('daftar-siswa')->with('status', 'Berhasil melakukan Auto Generate Data Siswa.');
    }

    public function generate_guru()
    {
        $faker = Faker::create('id_ID');
        $kelas = Kelas::all()->toArray();
        $semester = Semester::all()->toArray();
        $mapel = Matapelajaran::all()->toArray();

        for ($i=0; $i < 12; $i++) {
            $kelas_random = Arr::random($kelas);
            $semester_random = Arr::random($semester);
            $mapel_random = Arr::random($mapel);
            $guru = new Guru;
            $login = new Login;
            $array_gender = ["L", "P"];
            $foto = "default-user.png";
            $gender = Arr::random($array_gender);
            $nip = $faker->randomNumber(8);
            $telepon = $faker->phoneNumber();
            $status = "AKTIF";
            $alamat = $faker->address();
            $kode = strtoupper(Str::random(10));
            switch ($gender) {
                case "L":
                    $nama = $faker->firstNameMale() . " " . $faker->lastNameMale();
                    break;
                case "P":
                    $nama = $faker->firstNameFemale() . " " . $faker->lastNameFemale();
                    break;
            }

            // GENERATE DATA LOGIN
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
                'login_nama'        => $nama,
                'login_username'    => $username,
                'login_password'    => $hashPassword,
                'login_email'       => $faker->email(),
                'login_telepon'     => $telepon,
                'login_token'       => $hashToken,
                'login_level'       => $level,
                'login_status'      => "verified",
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
            $save_login->save();

            // GENERATE DATA GURU
            $save_guru = $guru->create([
                'guru_nama' => $nama,
                'guru_nip' => $nip,
                'guru_jeniskelamin' => $gender,
                'guru_telepon' => $telepon,
                'guru_foto' => $foto,
                'guru_status' => $status,
                'guru_kode' => $kode,
                'login_id' => $save_login->id,
                'semester_id' => $semester_random["id"],
                'kelas_id' => $kelas_random["id"],
                'matapelajaran_id' => $mapel_random["id"],
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_guru->save();
        }
        // return redirect()->route('daftar-guru')->with('status', 'Berhasil Auto Generate Data Guru.');
    }

    public function generate_nilai()
    {
        $siswa = Siswa::all();
        $matapelajaran = Matapelajaran::all();
        $faker = Faker::create('id_ID');

        foreach ($siswa as $item) {
            $nilai_tugas = $faker->numberBetween(0, 100);
            $nilai_absensi = $faker->numberBetween(0, 100);
            $nilai_uts = $faker->numberBetween(0, 100);
            $nilai_uas = $faker->numberBetween(0, 100);
            $nilai_ratarata = $faker->numberBetween(0, 100);

            switch ($nilai_ratarata) {
                case $nilai_ratarata <= 50:
                    $nilai_keterangan = "Terampil memahami dan terampil dalam melakukan proses pembelajaran.";
                    break;
                case $nilai_ratarata >= 51 && $nilai_ratarata <= 70:
                    $nilai_keterangan = "Cukup memahami dan cukup terampil dalam melakukan proses pembelajaran.";
                    break;
                case $nilai_ratarata >= 71:
                    $nilai_keterangan = "Sangat memahami dan sangat terampil dalam melakukan proses pembelajaran.";
                    break;
            }
            foreach ($matapelajaran as $items) {
                $nilai = new Nilai;
                $save_nilai = $nilai->create([
                    "nilai_siswa_tugas" => $nilai_tugas,
                    "nilai_siswa_absensi" => $nilai_absensi,
                    "nilai_siswa_uts" => $nilai_uts,
                    "nilai_siswa_uas" => $nilai_uas,
                    "nilai_ratarata" => $nilai_ratarata,
                    "nilai_keterangan" => $nilai_keterangan,
                    "nilai_tanggal" => now(),
                    "matapelajaran_id" => $items->id,
                    "siswa_id" => $item->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
                $save_nilai->save();
                dump($save_nilai);
                die;
            }
        }
    }

    public function generate_all()
    {
        $this->generate_siswa();
        $this->generate_guru();
        return redirect()->route('dashboard')->with('status', 'Berhasil melakukan Auto Generate Data.');
    }
}
