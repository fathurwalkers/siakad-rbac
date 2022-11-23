@extends('layouts.dashboard-layout')

@section('title', 'Dashboard - Daftar Nilai ')

@push('css')
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('content-title', 'Dashboard - Daftar Nilai ')

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
                                        Daftar Nilai
                                    </b>
                                </h4>
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
                                                                <button onclick="location.href = '{{ route('lihat-nilai-matapelajaran', $item->id) }}';"
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
