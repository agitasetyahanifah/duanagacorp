@extends('layouts.admin.index')

@section('title', 'Tambah User')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <!-- Default box -->
            <div class="card">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama <span>*</span></label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span>*</span></label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email"
                                value="{{ old('email') }}" required />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span>*</span></label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                                required />
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('users.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('css')
    <style>
        label span {
            color: red;
        }
    </style>
@endpush