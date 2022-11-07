<div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Keluar dari Halaman Dashboard?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin keluar dari halaman Dashboard?</p>
                </div>
                <div class="modal-footer">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="logoutrequest">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger">Keluar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="profilemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="row border-1">
                        <div
                            class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                            <img src="{{ asset('assets') }}/{{ $users->login_nama }}"
                                alt="" width="150px">
                        </div>
                    </div>
                    <br /> --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>
                                Nama : {{ $users->login_nama }} <br>
                                Username : {{ $users->login_username }} <br>
                                Email : {{ $users->login_email }} <br>
                                No. HP / Telepon : {{ $users->login_telepon }} <br>
                                Level Akses : {{ $users->login_level }} <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="logoutrequest">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger">Keluar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
