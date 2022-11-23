@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Daftar Nilai')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Daftar Nilai')

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
                                    Daftar Nilai - {{ $matapelajaran->matapelajaran_nama }}
                                </b>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="example" class="display table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tugas</th>
                                            <th>Absensi</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Rata - Rata</th>
                                            <th>Keterangan</th>
                                            {{-- <th>Kelola</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>{{ $item->siswa->siswa_nama }}</td>
                                                <td>{{ $item->matapelajaran->matapelajaran_nama }}</td>

                                                @if ($item->nilai_siswa_tugas == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_siswa_tugas }}</td>
                                                @endif

                                                @if ($item->nilai_siswa_absensi == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_siswa_absensi }}</td>
                                                @endif

                                                @if ($item->nilai_siswa_uts == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_siswa_uts }}</td>
                                                @endif

                                                @if ($item->nilai_siswa_uas == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_siswa_uas }}</td>
                                                @endif

                                                @if ($item->nilai_ratarata == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_ratarata }}</td>
                                                @endif

                                                @if ($item->nilai_keterangan == NULL)
                                                    <td>Kosong</td>
                                                @else
                                                <td>{{ $item->nilai_keterangan }}</td>
                                                @endif

                                                {{-- <td>
                                                    <div class="row">
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                                                            <button
                                                                class="btn btn-sm btn-primary mr-1">Lihat Nilai</button>
                                                        </div>
                                                    </div>
                                                </td> --}}
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
