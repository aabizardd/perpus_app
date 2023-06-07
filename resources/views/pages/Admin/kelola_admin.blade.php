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
                                <h4 class="flex-grow-1">Kelola Admin</h4>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMobil">Tambah
                                    Admin</a>
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
                                            <th>Nama Admin</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($admin as $item)
                                            <tr>

                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    {{ $item->email }}
                                                </td>

                                                <td>
                                                    {{ $item->username }}
                                                </td>

                                                <td>

                                                    <a class="btn btn-danger mb-2"
                                                        href="{{ route('admin.hapus', $item->id) }}">Hapus</a>

                                                    <button class="btn btn-warning mb-2 edit-modal" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditMobil" data-id="{{ $item->id }}"
                                                        data-username="{{ $item->username }}"
                                                        data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                                        data-password="{{ $item->password }}">Edit</button>

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
                            Tambah Admin
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('admin.store') }}" method="POST" id="tambahMobil">
                            @csrf


                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Admin</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nama Admin" required />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" required pattern="^[^\s]+$"
                                    title="Tidak diperbolehkan menggunakan spasi" />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Password</label>
                                <input type="password" name="color" id="color" class="form-control"
                                    placeholder="Password" required />

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
                            Edit Admin
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('admin.update') }}" method="POST" id="updateMobil">
                            @csrf

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_password" id="old_password">
                            <input type="hidden" name="old_username" id="old_username">
                            <input type="hidden" name="old_email" id="old_email">


                            <div class="form-group position-relative mb-2">
                                <label for="">Nama Admin</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nama Admin" required />

                            </div>


                            <div class="form-group position-relative mb-2">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" required pattern="^[^\s]+$"
                                    title="Tidak diperbolehkan menggunakan spasi" />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Email" required />

                            </div>

                            <div class="form-group position-relative mb-2">
                                <label for="">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="Password Baru" />

                                <small class="text-danger">*Isi jika ingin mengubah password admin</small>
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

            var username = $(this).data('username');
            $(".modal-body #username").val(username);
            $(".modal-body #old_username").val(username);

            var email = $(this).data('email');
            $(".modal-body #email").val(email);
            $(".modal-body #old_email").val(email);

            var name = $(this).data('name');
            $(".modal-body #name").val(name);

            var password = $(this).data('password');
            $(".modal-body #old_password").val(password);



            // alert(zone)
            // As pointed out in comments, 
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
@endsection
