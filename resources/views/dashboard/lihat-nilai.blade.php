@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Lihat Nilai Siswa')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Lihat Nilai Siswa')

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
                        {{-- <div class="row">
                            <h4>
                                <b>
                                    Lihat Nilai Siswa - {{ $siswa->siswa_nama }}
                                </b>
                            </h4>
                        </div> --}}
                        <div class="row">
                            <table>
                                <tr>
                                    <td>Nama Siswa </td>
                                    <td> : <b> {{ $siswa->siswa_nama }} </b> </td>
                                </tr>
                                <tr>
                                    <td>Kelas </td>
                                    <td> : <b> {{ $siswa->kelas->kelas_nama }} </b> </td>
                                </tr>
                            </table>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="table-responsive">
                                <table id="example" class="display table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tugas</th>
                                            <th>Absensi</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Rata - Rata</th>
                                            <th>Keterangan</th>
                                            <th>Kelola</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>{{ $item->matapelajaran->matapelajaran_nama }}</td>
                                                <td>{{ $item->nilai_siswa_tugas }}</td>
                                                <td>{{ $item->nilai_siswa_absensi }}</td>
                                                <td>{{ $item->nilai_siswa_uts }}</td>
                                                <td>{{ $item->nilai_siswa_uas }}</td>
                                                <td>{{ $item->nilai_ratarata }}</td>
                                                <td>{{ $item->nilai_keterangan }}</td>

                                                <td>
                                                    <div class="row">
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                            <button
                                                                class="btn btn-sm btn-primary mr-1">Lihat Nilai</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
