<div>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assets/ruangadmin') }}/img/logo/logo2.png">
            </div>
            <div class="sidebar-brand-text mx-3">SIAKAD SMP</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- ----------------------- MENU KELOLA ----------------------- -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Menu Kelola
        </div>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Absensi</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Absensi</h6>
                    <a class="collapse-item" href="alerts.html">Daftar Absensi</a>
                    <a class="collapse-item" href="alerts.html">Kelola Absensi</a>
                </div>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm1"
                aria-expanded="true" aria-controls="collapseForm1">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Kelas</span>
            </a>
            <div id="collapseForm1" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Kelas</h6>
                    <a class="collapse-item" href="{{ route('daftar-kelas') }}">Daftar Kelas</a>
                    {{-- <a class="collapse-item" href="#">Tambah Mata Pelajaran</a> --}}
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                aria-expanded="true" aria-controls="collapseForm">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Mata Pelajaran</span>
            </a>
            <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Mata Pelajaran</h6>
                    <a class="collapse-item" href="{{ route('daftar-matapelajaran') }}">Daftar Mata Pelajaran</a>
                    {{-- <a class="collapse-item" href="#">Tambah Mata Pelajaran</a> --}}
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm2"
                aria-expanded="true" aria-controls="collapseForm2">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Kelola Nilai</span>
            </a>
            <div id="collapseForm2" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Nilai</h6>
                    <a class="collapse-item" href="{{ route('daftar-nilai') }}">Daftar Nilai</a>
                    {{-- <a class="collapse-item" href="#">Kelola Nilai</a> --}}
                </div>
            </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="ui-colors.html">
                <i class="fas fa-fw fa-palette"></i>
                <span>Laporan</span>
            </a>
        </li> --}}
        <!-- ----------------------- END MENU KELOLA ----------------------- -->

        <!-- ----------------------- KELOLA LAINNYA ----------------------- -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Menu Lainnya
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                aria-expanded="true" aria-controls="collapsePage">
                <i class="fas fa-fw fa-columns"></i>
                <span>Kelola Pengguna</span>
            </a>
            <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Pengguna</h6>
                    <a class="collapse-item" href="{{ route('daftar-siswa') }}">Daftar Siswa</a>
                    <a class="collapse-item" href="{{ route('daftar-guru') }}">Daftar Guru</a>
                </div>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pengaturan</span>
            </a>
        </li> --}}
        <!-- ----------------------- END KELOLA LAINNYA ----------------------- -->


        <hr class="sidebar-divider">
        <div class="version" id="version-ruangadmin"></div>
    </ul>
</div>
