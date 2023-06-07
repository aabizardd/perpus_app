@extends('layouts_main.app')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/simple-datatables/style.css" />
@endsection

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="flex-grow-1">Kelola Buku</h4>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMobil">Tambah
                                    Buku</a>
                            </div>


                            <div class="card-body">

                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (Session::has('danger'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ Session::get('danger') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif


                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama Buku</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($book as $item)
                                            <tr>

                                                <td>
                                                    <img src="{{ asset('assets/images/book_cover/' . $item->gambar_buku) }}"
                                                        alt="" width="120">

                                                </td>
                                                <td>
                                                    {{ $item->nama_buku }}
                                                </td>

                                                <td>
                                                    {{ $item->stok }} pcs
                                                </td>

                                                <td>

                                                    <a class="btn btn-danger mb-2"
                                                        href="{{ route('buku.hapus', $item->id) }}">Hapus</a>

                                                    <button class="btn btn-warning mb-2 edit-modal" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditMobil" data-id="{{ $item->id }}"
                                                        data-namabuku="{{ $item->nama_buku }}"
                                                        data-stok="{{ $item->stok }}"
                                                        data-gambarbuku="{{ $item->gambar_buku }}">Edit</button>

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


        </section>

        <div class="modal fade" id="modalTambahMobil" tabindex="-1" role="dialog" aria-labelledby="modalTambahMobilTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahMobilTitle">
                            Tambah Buku
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('buku.store') }}" method="POST" id="tambahMobil"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group position-relative mb-2">
                                <label for="">Gambar Buku</label>
                                <input type="file" name="gambar_buku" id="gambar_buku" class="form-control"
                                    placeholder="Gambar Buku" required accept="image/*" />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Buku</label>
                                <input type="text" name="nama_buku" id="nama_buku" class="form-control"
                                    placeholder="Nama Buku" required />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" placeholder="Stok"
                                    required />

                            </div>




                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" form="tambahMobil">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditMobil" tabindex="-1" role="dialog" aria-labelledby="modalEditMobilTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditMobilTitle">
                            Edit Buku
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('buku.update') }}" method="POST" id="updateMobil"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_gambar" id="old_gambar">

                            <div class="form-group position-relative mb-2">
                                <label for="">Gambar Buku</label>
                                <input type="file" name="gambar_buku" id="gambar_buku" class="form-control"
                                    placeholder="Gambar Buku" accept="image/*" />


                                <small class="text-danger">*Isi field ini jika ingin mengubah cover buku</small>

                            </div>



                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Buku</label>
                                <input type="text" name="nama_buku" id="nama_buku" class="form-control"
                                    placeholder="Nama Buku" required />

                            </div>



                            <div class="form-group position-relative mb-2">
                                <label for="">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control"
                                    placeholder="Stok" />

                            </div>



                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" form="updateMobil">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Ubah</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection

@section('addScript')
    <script src="{{ asset('/') }}assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector("#table1");
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on("click", ".edit-modal", function() {
            // alert('asdsa')
            var id = $(this).data('id');
            $(".modal-body #id").val(id);

            var gambar_buku = $(this).data('gambarbuku');
            // $(".modal-body #gambar_buku").val(gambar_buku);
            $(".modal-body #old_gambar").val(gambar_buku);

            var stok = $(this).data('stok');
            $(".modal-body #stok").val(stok);

            var nama_buku = $(this).data('namabuku');
            $(".modal-body #nama_buku").val(nama_buku);





            // alert(zone)
            // As pointed out in comments, 
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
@endsection
