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
                                <h4 class="flex-grow-1">Kelola Peminjaman Buku</h4>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMobil">Tambah
                                    Peminjaman</a>
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
                                            <th>Nama Peminjam</th>
                                            <th>Kontak Peminjam</th>
                                            <th>Asal Instansi</th>
                                            <th>Nama Buku</th>
                                            <th>Jumlah Pinjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status Pengembalian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pinjaman as $item)
                                            <tr>

                                                <td>
                                                    {{ $item->nama_peminjam }}
                                                </td>

                                                <td>
                                                    {{ $item->nomor_peminjam }}
                                                </td>

                                                <td>
                                                    {{ $item->asal_instansi }}
                                                </td>

                                                <td>
                                                    {{ $item->nama_buku }}
                                                </td>

                                                <td>
                                                    {{ $item->jumlah }} pcs
                                                </td>

                                                <td>
                                                    {{ $item->created_at }}
                                                </td>

                                                <td>
                                                    {{ $item->tanggal_pengembalian }}
                                                </td>

                                                <td>

                                                    @if ($item->status == 0)
                                                        <span class="badge bg-danger">Belum</span>
                                                    @else
                                                        <span class="badge bg-success">Sudah</span>
                                                    @endif

                                                </td>


                                                <td>

                                                    @if ($item->status == 0)
                                                        <a class="btn btn-success mb-2"
                                                            href="{{ route('peminjaman.pengembalian', $item->p_id) }}">Kembalikan</a>
                                                        <br>
                                                    @endif



                                                    <a class="btn btn-danger mb-2"
                                                        href="{{ route('peminjaman.hapus', $item->p_id) }}">Hapus</a>



                                                    <button class="btn btn-warning mb-2 edit-modal" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditMobil" data-id="{{ $item->p_id }}"
                                                        data-namapeminjam="{{ $item->nama_peminjam }}"
                                                        data-nomorpeminjam="{{ $item->nomor_peminjam }}"
                                                        data-asalinstansi="{{ $item->asal_instansi }}"
                                                        data-idbuku="{{ $item->b_id }}"
                                                        data-jumlah="{{ $item->jumlah }}"
                                                        data-status="{{ $item->status }}"
                                                        data-tanggalpinjam="{{ $item->created_at }}"
                                                        data-tanggalpengembalian="{{ $item->tanggal_pengembalian }}">Edit</button>

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
                            Tambah Peminjaman Buku
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('peminjaman.store') }}" method="POST" id="tambahMobil"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Peminjam</label>
                                <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control"
                                    placeholder="Nama Peminjam" required />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Kontak Peminjam</label>
                                <input type="number" name="nomor_peminjam" id="nomor_peminjam" class="form-control"
                                    placeholder="Kontak Peminjam" required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Asal Instansi</label>
                                <input type="text" name="asal_instansi" id="asal_instansi" class="form-control"
                                    placeholder="Asal Instansi" required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Buku</label>
                                <select name="id_buku" id="id_buku" class="form-select" required>
                                    <option value="" selected disabled>--- Pilih Buku ---</option>

                                    @foreach ($books as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_buku }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Jumlah Peminjaman</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Jumlah Peminjaman" required min="1" />

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
                            Edit Peminjaman Buku
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('peminjaman.update') }}" method="POST" id="updateMobil"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" id="id">

                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Peminjam</label>
                                <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control"
                                    placeholder="Nama Peminjam" required />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Kontak Peminjam</label>
                                <input type="number" name="nomor_peminjam" id="nomor_peminjam" class="form-control"
                                    placeholder="Kontak Peminjam" required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Asal Instansi</label>
                                <input type="text" name="asal_instansi" id="asal_instansi" class="form-control"
                                    placeholder="Asal Instansi" required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Buku</label>
                                <select name="id_buku" id="id_buku" class="form-select" required>
                                    {{-- <option value="" disabled>--- Pilih Buku ---</option> --}}

                                    @foreach ($books as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_buku }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Jumlah Peminjaman</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Jumlah Peminjaman" required min="1" />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    {{-- <option value="" selected disabled>--- Pilih Status ---</option> --}}


                                    <option value="0">Belum Dikembalikan</option>
                                    <option value="1">Sudah Dikembalikan</option>

                                </select>

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Tanggal Peminjaman</label>
                                <input type="datetime-local" name="created_at" id="created_at" class="form-control"
                                    placeholder="Tanggal Peminjaman" required step="any" />

                            </div>


                            <div class="form-group
                                    position-relative mb-2">
                                <label for="">Tanggal Pengembalian</label>
                                <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian"
                                    class="form-control" placeholder="Tanggal Pengembalian" step="any" />

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

            var id = $(this).data('id');
            $(".modal-body #id").val(id);

            var nama_peminjam = $(this).data('namapeminjam');
            $(".modal-body #nama_peminjam").val(nama_peminjam);

            var nomor_peminjam = $(this).data('nomorpeminjam');
            $(".modal-body #nomor_peminjam").val(nomor_peminjam);

            var asal_instansi = $(this).data('asalinstansi');
            $(".modal-body #asal_instansi").val(asal_instansi);


            var id_buku = $(this).data('idbuku');
            $(".modal-body #id_buku").val(id_buku);


            var jumlah = $(this).data('jumlah');
            $(".modal-body #jumlah").val(jumlah);

            // alert('asdsa')

            var status = $(this).data('status');
            $(".modal-body #status").val(status);


            var tanggal_pinjam = $(this).data('tanggalpinjam');
            $(".modal-body #created_at").val(tanggal_pinjam);

            var tanggal_pengembalian = $(this).data('tanggalpengembalian');
            $(".modal-body #tanggal_pengembalian").val(tanggal_pengembalian);


            // alert(zone)
            // As pointed out in comments, 
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
@endsection
