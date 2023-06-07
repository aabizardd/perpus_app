@extends('layouts_main.app')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kelola Profil</h4>
                            </div>
                            <div class="card-body">

                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif




                                <div class="col-md-12 mb-4">

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-sm-12 mt-3 mb-3">

                                            <img src="{{ asset('/') }}assets/images/avatar/{{ Auth::user()->avatar }}"
                                                alt="" class="rounded mx-auto d-block img-preview" width="100%"
                                                height="340" id="gambar">

                                        </div>

                                        <div class="col-lg-8 col-sm-12 mt-2">

                                            <form method="POST" action="{{ route('profile.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                                                <div class="form-group position-relative">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ Auth::user()->name }}"
                                                        required>



                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username</label>
                                                    <input type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        id="username" name="username" autocomplete="off"
                                                        value="{{ Auth::user()->username }}">

                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" autocomplete="off"
                                                        value="{{ Auth::user()->email }}">

                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>



                                                <div class="form-group">

                                                    <label for="exampleInputEmail1">Avatar</label>
                                                    <div class="mb-3">

                                                        <input type="file"
                                                            class="form-control @error('avatar') is-invalid @enderror"
                                                            name="avatar" id="sampul"
                                                            aria-describedby="inputGroupFileAddon01"
                                                            onchange="preview_img()" accept="image/*">

                                                        @error('avatar')
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i>
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <button class="btn btn-primary mt-2" type="submit" name="submit">Simpan
                                                    Perubahan</button>



                                            </form>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->role == 2)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kelola Data Warga</h4>
                                </div>
                                <div class="card-body">

                                    {{-- <?= $this->session->flashdata('message') ?> --}}

                                    <div class="col-md-12 mb-4">

                                        <div class="row mt-2">

                                            <div class="col-12 mt-2">

                                                <form method="POST" action="{{ route('profile.edit_inhabitant') }}">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Alamat</label>
                                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ getInhabitantData(Auth::user()->id)->address }}</textarea>

                                                        @error('address')
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i>
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nomor HP</label>
                                                        <input type="number"
                                                            class="form-control @error('phone_number') is-invalid @enderror"
                                                            id="phone_number" name="phone_number" autocomplete="off"
                                                            value="{{ getInhabitantData(Auth::user()->id)->phone_number }}"
                                                            required>

                                                        @error('phone_number')
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i>
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>


                                                    <button class="btn btn-primary mt-2" type="submit"
                                                        name="submit">Simpan
                                                        Perubahan</button>



                                                </form>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ubah Password</h4>
                            </div>
                            <div class="card-body">

                                {{-- <?= $this->session->flashdata('message') ?> --}}

                                <div class="col-md-12 mb-4">

                                    <div class="row mt-2">

                                        <div class="col-12 mt-2">

                                            <form method="POST" action="{{ route('profile.update_password') }}">
                                                @csrf

                                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" autocomplete="off">

                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" autocomplete="off">
                                                </div>

                                                <button class="btn btn-primary mt-2" type="submit" name="submit">Ubah
                                                    Password</button>



                                            </form>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>





            <script>
                function preview_img() {

                    const sampul = document.querySelector('#sampul');
                    const sampulLabel = document.querySelector('.custom-file-label');
                    const imgPreview = document.querySelector('.img-preview');

                    sampul.textContent = sampul.files[0].name;

                    const fileSampul = new FileReader();
                    fileSampul.readAsDataURL(sampul.files[0]);

                    fileSampul.onload = function(e) {
                        imgPreview.src = e.target.result;
                    }

                }
            </script>

        </section>
    </div>
@endsection
