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
                        <div class="row">
                            <h4>
                                <b>
                                    Input Nilai - {{ $matapelajaran->matapelajaran_nama }}
                                </b>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                            <form action="{{ route('post-input-nilai', $matapelajaran->id) }}" method="POST">
                                @csrf
                            <div class="table-responsive">

                                <table id="" class="table table-bordered table-fixed" style="">

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
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($nilai as $item)
                                            <tr>
                                                <input type="hidden" name="iter[{{$item->id}}]" value="{{ $item->id }}">
                                                <input type="hidden" name="siswa_id[{{$item->id}}]" value="{{ $item->siswa->id }}">
                                                <input type="hidden" name="matapelajaran_id[{{$item->id}}]" value="{{ $item->matapelajaran->id }}">

                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>{{ $item->siswa->siswa_nama }}</td>
                                                <td>{{ $item->matapelajaran->matapelajaran_nama }}</td>

                                                <td>
                                                    <input type="number" min="0" max="100" name="nilai_siswa_tugas[{{ $item->id }}]" placeholder="Nilai Tugas...">
                                                </td>

                                                <td>
                                                    <input type="number" min="0" max="100" name="nilai_siswa_absensi[{{ $item->id }}]" placeholder="Nilai Absensi...">
                                                </td>

                                                <td>
                                                    <input type="number" min="0" max="100" name="nilai_siswa_uts[{{ $item->id }}]" placeholder="Nilai UTS...">
                                                </td>

                                                <td>
                                                    <input type="number" min="0" max="100" name="nilai_siswa_uas[{{ $item->id }}]" placeholder="Nilai UAS...">
                                                </td>

                                                <td>
                                                    <input type="number" min="0" max="100" name="nilai_siswa_ratarata[{{ $item->id }}]" placeholder="Nilai Rata - Rata...">
                                                </td>

                                                <td>
                                                    <input type="text" name="nilai_siswa_keterangan[{{ $item->id }}]" placeholder="Keterangan Nilai...">
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>

                            <div class="row my-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <button type="submit" class="btn btn-md btn-info">PROSES</button>
                                </div>
                            </div>

                            </form>

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
    {{-- <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script> --}}
@endpush
