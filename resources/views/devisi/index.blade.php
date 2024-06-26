@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pegawai</h1>
                </div>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Data Devisi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @can('update role')
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambah">
                            Tambah +
                        </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Devisi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/insertdata_devisi" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                                                <input type="text" name="nama_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Gaji Harian</label>
                                                <input type="text" name="gaji_harian" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Gaji Pokok</label>
                                                <input type="text" name="gaji_pokok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-dark" role="alert">
                            {{ $message }}
                        </div>
                        @endif

                        <div class="card-body table-responsive p-0">
                            <table class="table table-responsive-md table-hover" id="table-devisi">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Devisi</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Gaji Harian</th>
                                        <th class="text-center">Gaji Pokok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    $a = 1;
                                    $b = 1;
                                    @endphp
                                    @foreach($data as $row)
                                    <tr class="text-center">
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $row->nama_devisi }}</td>
                                        <td>{{ $row->jabatan }}</td>
                                        <td>{{ $row->gaji_harian }}</td>
                                        <td>{{ $row->gaji_pokok }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Lihat</a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    @can('delete role')
                                                        <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">Edit</a></li>
                                                    @endcan
                                                    <li><hr class="dropdown-divider"></li>
                                                    @can('delete role')
                                                        <li><a class="dropdown-item" href="/deletedata_devisi/{{ $row->id }}">Hapus</a></li>
                                                    @endcan
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $row->id }}">Detail</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                        <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Devisi</h5>
                                                        @can('edit role')
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        @endcan
                                                    </div>
                                                    <form action="/updatedata_devisi/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                                                                <input type="text" name="nama_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->nama_devisi }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Jabatan</label>
                                                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->jabatan }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Gaji Harian</label>
                                                                <input type="text" name="gaji_harian" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->gaji_harian }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Gaji Pokok</label>
                                                                <input type="text" name="gaji_pokok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->gaji_pokok }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <!-- Modal Detail -->
                                        <div class="modal fade" id="modalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Devisi</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama_devisi" class="form-label">Nama Devisi</label>
                                                            <input type="text" name="nama_devisi" class="form-control" id="nama_devisi" value="{{ $row->nama_devisi }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jabatan" class="form-label">Jabatan</label>
                                                            <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{ $row->jabatan }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="gaji_harian" class="form-label">Gaji Harian</label>
                                                            <input type="text" name="gaji_harian" class="form-control" id="gaji_harian" value="{{ $row->gaji_harian }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                                            <input type="text" name="gaji_pokok" class="form-control" id="gaji_pokok" value="{{ $row->gaji_pokok }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.delete').click(function(e) {
            e.preventDefault()
            let link = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    </script>

    <script>
        var table_devisi = $('#table-devisi').dataTable({
            ordering: false
        })
    </script>
</div>
@endsection
