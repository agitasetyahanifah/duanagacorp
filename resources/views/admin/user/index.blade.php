@extends('layouts.admin.index')

@section('title', 'Data User')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>

            @if(Auth::user()->role == 'admin')
            <div class="card-tools">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                lengthChange: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: '{{ url()->current() }}',
                    data: function(d) {},
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                        width: '45px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center',
                        width: '90px',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        })
    </script>
@endpush
