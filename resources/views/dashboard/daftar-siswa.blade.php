@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Daftar Siswa')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Daftar Siswa')

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
                                        Daftar Siswa
                                    </b>
                                </h4>
                            </div>

                            @if ($users->login_level == 'admin')
                            <div class="col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-md btn-info" data-toggle="modal"
                                    data-target="#modaltambah">
                                    Tambah Siswa
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
                                            Tambah Siswa
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('tambah-siswa') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="siswa_nama">Nama Siswa</label>
                                                        <input type="text" class="form-control" id="siswa_nama"
                                                            aria-describedby="emailHelp" placeholder="" name="siswa_nama">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="siswa_nisn">NISN</label>
                                                        <input type="text" class="form-control" id="siswa_nisn"
                                                            aria-describedby="emailHelp" placeholder="" name="siswa_nisn">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="siswa_telepon">No. HP / Telepon</label>
                                                        <input type="text" class="form-control" id="siswa_telepon"
                                                            aria-describedby="emailHelp" placeholder=""
                                                            name="siswa_telepon">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="input-group-text" for="siswa_kelas">Kelas</label>
                                                        <select class="form-control" id="siswa_kelas" name="siswa_kelas">
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
                                                        <label class="input-group-text" for="siswa_jeniskelamin">Jenis
                                                            Kelamin</label>
                                                        <select class="form-control" id="siswa_jeniskelamin"
                                                            name="siswa_jeniskelamin">
                                                            <option value="L">Laki-Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="siswa_alamat">Alamat</label>
                                                        <input type="text" class="form-control" id="siswa_alamat"
                                                            aria-describedby="emailHelp"
                                                            placeholder="contoh : Jl. Bakti Abri" name="siswa_alamat">
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
                                            <th>NISN</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Telepon</th>
                                            <th>Status</th>
                                            <th>Kelas</th>
                                            @if ($users->login_level == 'admin')
                                            <th>Kelola</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->siswa_nama }}</td>
                                                <td>{{ $item->siswa_nisn }}</td>
                                                <td>
                                                    @switch($item->siswa_jeniskelamin)
                                                        @case('L')
                                                            Laki - Laki
                                                        @break

                                                        @case('P')
                                                            Perempuan
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->siswa_telepon }}</td>
                                                <td>{{ $item->siswa_status }}</td>
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
                                            <div class="modal fade" id="modalhpus{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabelLogout"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Konfirmasi
                                                                Tindakan Penghapusan!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus Data Siswa
                                                                {{ $item->siswa_nama }} ?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <form action="{{ route('hapus-siswa', $item->id) }}"
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
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Ubah Data Siswa
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('post-ubah-siswa', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="siswa_nama">Nama</label>
                                                                            <input type="text" class="form-control"
                                                                                id="siswa_nama"
                                                                                aria-describedby="emailHelp"
                                                                                name="siswa_nama"
                                                                                value="{{ $item->siswa_nama }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="siswa_telepon">No.
                                                                                Telepon</label>
                                                                            <input type="text" class="form-control"
                                                                                id="siswa_telepon"
                                                                                aria-describedby="emailHelp"
                                                                                name="siswa_telepon"
                                                                                value="{{ $item->siswa_telepon }}">
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
                                            <div class="modal fade" id="modallihat{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabelLogout"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Data Siswa - {{ $item->siswa_nama }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row border-1">
                                                                <div
                                                                    class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                                    <img src="{{ asset('assets') }}/{{ $item->siswa_foto }}"
                                                                        alt="" width="150px">
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <p>
                                                                        Nama : {{ $item->siswa_nama }} <br>
                                                                        NISN : {{ $item->siswa_nisn }} <br>
                                                                        Kelas : {{ $item->kelas->kelas_nama }} <br>
                                                                        Jenis Kelamin :
                                                                        @switch($item->siswa_jeniskelamin)
                                                                            @case('L')
                                                                                Laki - Laki
                                                                            @break

                                                                            @case('P')
                                                                                Perempuan
                                                                            @break
                                                                        @endswitch <br>
                                                                        No. HP / Telepon : {{ $item->siswa_telepon }} <br>
                                                                        Alamat : {{ $item->siswa_alamat }} <br>
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
