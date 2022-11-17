@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Daftar Guru')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Daftar Guru')

{{-- ------------------- main content ------------------- --}}
@section('main-content')

    <div class="row mt-1 mb-1">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <h4>
                                    <b>
                                        Daftar Guru
                                    </b>
                                </h4>
                            </div>

                            @if ($users->login_level == 'admin')
                            <div class="col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-md btn-info" data-toggle="modal"
                                    data-target="#modaltambah">
                                    Tambah Guru
                                </button>
                            </div>
                            @endif

                        </div>

                        {{-- MODAL TAMBAH DATA SISWA --}}
                        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">
                                            Tambah Guru
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('tambah-guru') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="guru_nama">Nama Guru</label>
                                                        <input type="text" class="form-control" id="guru_nama"
                                                            aria-describedby="emailHelp" placeholder="" name="guru_nama">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="guru_nip">NIP</label>
                                                        <input type="text" class="form-control" id="guru_nip"
                                                            aria-describedby="emailHelp" placeholder="" name="guru_nip">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="input-group-text" for="matapelajaran_id">Mata Pelajaran</label>
                                                        <select class="form-control" id="matapelajaran_id" name="matapelajaran_id">
                                                            @foreach ($matapelajaran as $mat)
                                                                <option value="{{ $mat->id }}">{{ $mat->matapelajaran_nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="input-group-text" for="semester_id">Semester</label>
                                                        <select class="form-control" id="semester_id" name="semester_id">
                                                            @foreach ($semester as $sem)
                                                                <option value="{{ $sem->id }}">{{ $sem->semester_tahunajaran }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="guru_telepon">No. HP / Telepon</label>
                                                        <input type="text" class="form-control" id="guru_telepon"
                                                            aria-describedby="emailHelp" placeholder=""
                                                            name="guru_telepon">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="input-group-text" for="kelas_id">Kelas</label>
                                                        <select class="form-control" id="kelas_id" name="kelas_id">
                                                            @foreach ($kelas as $kel)
                                                                <option value="{{ $kel->id }}">{{ $kel->kelas_nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <img id="output_image" class="border border-1" />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Foto : </label>
                                                        <input type="file" class="form-control-file"
                                                            onchange="preview_image(event)" name="foto">
                                                        <small class="form-text text-muted">Upload Pas Foto ekstensi
                                                            .jpg</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="input-group-text" for="guru_jeniskelamin">Jenis
                                                            Kelamin</label>
                                                        <select class="form-control" id="guru_jeniskelamin"
                                                            name="guru_jeniskelamin">
                                                            <option value="L">Laki-Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="guru_alamat">Alamat</label>
                                                        <input type="text" class="form-control" id="guru_alamat"
                                                            aria-describedby="emailHelp"
                                                            placeholder="contoh : Jl. Bakti Abri" name="guru_alamat">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info"
                                                data-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-success">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="row">
                            <div class="table-responsive">
                                <table id="example" class="display table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Telepon</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>

                                            @if ($users->login_level == 'admin')
                                            <th>Kelola</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guru as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->guru_nama }}</td>
                                                <td>{{ $item->guru_nip }}</td>
                                                <td>
                                                    @switch($item->guru_jeniskelamin)
                                                        @case("L")
                                                            Laki - Laki
                                                            @break
                                                        @case("P")
                                                            Perempuan
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->guru_telepon }}</td>
                                                <td>{{ $item->matapelajaran->matapelajaran_nama }}</td>
                                                <td>{{ $item->kelas->kelas_nama }}</td>

                                                @if ($users->login_level == 'admin')
                                                <td>
                                                    <div class="row">
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                            <button data-toggle="modal"
                                                            data-target="#modallihat{{ $item->id }}"
                                                            class="btn btn-sm btn-primary mr-1">Lihat</button>
                                                            <button data-toggle="modal"
                                                            data-target="#modaltambahsiswa{{ $item->id }}"
                                                            class="btn btn-sm btn-success mr-1">Ubah</button>
                                                            <button data-toggle="modal"
                                                            data-target="#modalhpus{{ $item->id }}"
                                                            class="btn btn-sm btn-danger">Hapus</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endif

                                            </tr>


                                            {{-- MODAL HAPUS --}}
                                            <div class="modal fade" id="modalhpus{{ $item->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Konfirmasi
                                                                Tindakan Penghapusan!</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus Data Siswa
                                                                {{ $item->guru_nama }} ?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <form action="{{ route('hapus-guru', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="logoutrequest">
                                                                <button type="button" class="btn btn-warning"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END MODAL HAPUS --}}

                                            {{-- MODAL UBAH --}}
                                            <div class="modal fade" id="modaltambahsiswa{{ $item->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Ubah Data Siswa
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('post-ubah-guru', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="guru_nama">Nama</label>
                                                                            <input type="text"
                                                                                class="form-control"
                                                                                id="guru_nama"
                                                                                aria-describedby="emailHelp"
                                                                                name="guru_nama"
                                                                                value="{{ $item->guru_nama }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="guru_telepon">No.
                                                                                Telepon</label>
                                                                            <input type="text"
                                                                                class="form-control"
                                                                                id="guru_telepon"
                                                                                aria-describedby="emailHelp"
                                                                                name="guru_telepon"
                                                                                value="{{ $item->guru_telepon }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END MODAL UBAH --}}

                                            {{-- MODAL LIHAT --}}
                                            <div class="modal fade" id="modallihat{{ $item->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Data Siswa - {{ $item->guru_nama }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row border-1">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                                    <img src="{{ asset('assets') }}/{{ $item->guru_foto }}" alt="" width="150px">
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <p>
                                                                        Nama : {{ $item->guru_nama }} <br>
                                                                        NIP : {{ $item->guru_nip }} <br>
                                                                        Kelas : {{ $item->kelas->kelas_nama }} <br>
                                                                        Jenis Kelamin :
                                                                        @switch($item->guru_jeniskelamin)
                                                                            @case("L")
                                                                                Laki - Laki
                                                                                @break
                                                                            @case("P")
                                                                                Perempuan
                                                                                @break
                                                                        @endswitch <br>
                                                                        No. HP / Telepon : {{ $item->guru_telepon }} <br>
                                                                        Alamat : {{ $item->guru_alamat }} <br>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning"
                                                                data-dismiss="modal">Batalkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END MODAL LIHAT --}}


                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- ------------------- end main content ------------------- --}}

@push('js')
    <script src="{{ asset('datatables') }}/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
