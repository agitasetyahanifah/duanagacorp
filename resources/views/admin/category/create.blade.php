@extends('layouts.admin.index')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <!-- Default box -->
            <div class="card">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Kategori <span>*</span></label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama kategori"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('categories.index') }}">Kembali</a>
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
