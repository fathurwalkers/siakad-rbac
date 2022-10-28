<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function daftar_nilai()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $nilai = Nilai::all();
        return view('dashboard.daftar-nilai', [
            'users' => $users,
            'nilai' => $nilai,
        ]);
    }
}
