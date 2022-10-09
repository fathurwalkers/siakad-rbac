@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Daftar Mata Pelajaran')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Daftar Mata Pelajaran')

{{-- ------------------- main content ------------------- --}}
@section('main-content')

    <div class="row mt-1 mb-1">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if (session('status'))
                <div class="alert alert-info">
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
                                        Daftar Mata Pelajaran
                                    </b>
                                </h4>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-md btn-info" data-toggle="modal"
                                    data-target="#modaltambah">
                                    Tambah Mata Pelajaran
                                </button>
                            </div>

                            {{-- MODAL TAMBAH DATA MATA PELAJARAN --}}
                            <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                Tambah Mata Pelajaran
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('post-tambah-matapelajaran') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Mata Pelajaran</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                placeholder="contoh : BAHASA INDONESIA"
                                                                name="matapelajaran_nama">
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

                        </div>
                        <hr />
                        <div class="row">
                            <div class="table-responsive">
                                <table id="example" class="display table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kode Mata Pelajaran</th>
                                            <th>Kelola</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matapelajaran as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->matapelajaran_nama }}</td>
                                                <td>{{ $item->matapelajaran_kode }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                            {{-- <button href="#"
                                                                class="btn btn-sm btn-primary mr-1">Lihat</button> --}}
                                                            <button href="#"
                                                                class="btn btn-sm btn-success mr-1" data-toggle="modal" data-target="#modalubah{{ $item->id }}">Ubah</button>
                                                            <button href="#" class="btn btn-sm btn-danger"
                                                                data-toggle="modal" data-target="#modalhapus{{ $item->id }}">Hapus</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- MODAL HAPUS MATA PELAJARAN --}}
                                            <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Tambah Mata Pelajaran
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                                    Apakah anda Yakin ingin menghapus Mata Pelajaran ({{ $item->matapelajaran_nama }}) ?
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <form action="{{ route('post-hapus-matapelajaran',$item->id) }}" method="POST">
                                                                @csrf
                                                                <button type="button" class="btn btn-warning"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- MODAL UBAH MATA PELAJARAN --}}
                                            <div class="modal fade" id="modalubah{{ $item->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelLogout">
                                                                Tambah Mata Pelajaran
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('post-ubah-matapelajaran', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">
                                                                                Nama Mata Pelajaran</label>
                                                                            <input type="text" class="form-control"
                                                                                id="exampleInputEmail1"
                                                                                aria-describedby="emailHelp" name="matapelajaran_nama" value="{{ $item->matapelajaran_nama }}">
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
