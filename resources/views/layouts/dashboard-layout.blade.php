<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/ruangadmin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/ruangadmin') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/ruangadmin') }}/css/ruang-admin.min.css" rel="stylesheet">
    @stack('css')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <x-dashboard-sidebar />
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <x-dashboard-topbar />
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('content-title')</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </div>

                    @yield('main-content')

                    <!-- Modal Logout -->
                    <x-dashboard-modal-logout />

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            {{-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">Techno Buton Raya</a></b>
            </span>
          </div>
        </div>
      </footer> --}}
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assets/ruangadmin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/ruangadmin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/ruangadmin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('assets/ruangadmin') }}/js/ruang-admin.min.js"></script>

    @stack('js')

</body>

</html>
