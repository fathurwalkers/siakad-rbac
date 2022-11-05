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
                            <h4>
                                <b>
                                    Daftar Siswa
                                </b>
                            </h4>
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
                                            <th>Kelola</th>
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
                                                        @case("L")
                                                            Laki - Laki
                                                            @break
                                                        @case("P")
                                                            Perempuan
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->siswa_telepon }}</td>
                                                <td>{{ $item->siswa_status }}</td>
                                                <td>{{ $item->kelas->kelas_nama }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                            <button href="#"
                                                                class="btn btn-sm btn-primary mr-1">Lihat</button>
                                                            <button href="#" class="btn btn-sm btn-success mr-1">Ubah</button>
                                                            <button data-toggle="modal"
                                                            data-target="#modalhpus{{ $item->id }}"
                                                            class="btn btn-sm btn-danger">Hapus</button>
                                                        </div>
                                                    </div>
                                                </td>
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
