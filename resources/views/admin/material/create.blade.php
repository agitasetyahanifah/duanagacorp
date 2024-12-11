@extends('layouts.admin.index')

@section('title', 'Tambah Barang')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <!-- Default box -->
            <div class="card">
                <form method="POST" action="{{ route('materials.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date_input">Tanggal Input <span>*</span></label>
                            <input type="date" id="date_input" name="date_input"
                                class="form-control @error('date_input') is-invalid @enderror" 
                                value="{{ old('date_input') }}" required />
                            @error('date_input')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Barang <span>*</span></label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama barang"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id">Kategori <span>*</span></label>
                            <select id="category_id" name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Harga <span>*</span></label>
                            <input type="text" id="price" name="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Masukan harga"
                                value="{{ old('price') }}" required oninput="formatNumber(this)" />
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>                        

                        <div class="form-group">
                            <label for="stock">Stok <span>*</span></label>
                            <input type="number" id="stock" name="stock"
                                class="form-control @error('stock') is-invalid @enderror" placeholder="Masukan stok"
                                value="{{ old('stock') }}" required />
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('materials.index') }}">Kembali</a>
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

@push('js')
    <script>
        $(document).ready(function() {
            $('#category_id').select2({
                placeholder: "Pilih Kategori",
                allowClear: true
            });
        });
    </script>

    <script>
        function formatNumber(input) {
            let value = input.value.replace(/\D/g, '');
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>
@endpush