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

        for ($i=0; $i < 10; $i++) {
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

            $save_siswa = $siswa->create([
                'siswa_nama' => $nama,
                'siswa_nisn' => $siswa_nisn,
                'siswa_jeniskelamin' => $gender,
                'siswa_alamat' => $alamat,
                'siswa_telepon' => $telepon,
                'siswa_foto' => $foto,
                'siswa_status' => $status,
                'login_id' => $status,
            ]);
            die;
        }
    }
}
