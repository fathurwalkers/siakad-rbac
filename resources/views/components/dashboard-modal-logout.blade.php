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

</div>
