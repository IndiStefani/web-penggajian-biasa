@extends('layout.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pegawai</h1>
                    </div><!-- /.col -->
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-dark" role="alert">
                      {{$message}}
                    </div>
                @endif --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">


                            <!-- Button trigger modal -->
                            @can('update role')
                                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                                    data-bs-target="#tambah">
                                    Tambah +
                                </button>
                            @endcan

                            <!-- Modal -->
                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/insertdata_pegawai" method="POST" enctype="multipart/form-data">
                                                {{-- <form action="{{ url('tambahpegawai') }}" method="POST" enctype="multipart/form-data"> --}}
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama_pegawai" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" name="jenis_kelamin"
                                                        aria-label="Default select example">
                                                        <option selected>--pilih jenis kelamin--</option>
                                                        <option value="laki-laki">laki-laki</option>
                                                        <option value="perempuan">perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_devisi" class="form-label">Devisi</label>
                                                    <select class="form-control" name="id_devisi"
                                                        aria-label="Default select example">
                                                        <option selected>--pilih devisi--</option>
                                                        @foreach($devisi as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nama_devisi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">No.Telp</label>
                                                    <input type="number" name="no_telp" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
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

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-responsive-md table-hover" id="table-pegawai">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Devisi</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">NoTelp</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $a = 1;
                                            $b = 1;
                                        @endphp
                                        @foreach ($pegawai as $row)
                                            <tr class="text-center">
                                                <td scope="row">{{ $no++ }}</td>
                                                <td>{{ $row->nama_pegawai }}</td>
                                                <td>{{ $row->jenis_kelamin }}</td>
                                                <td>{{ $row->devisis->nama_devisi }}</td>
                                                <td>{{ $row->alamat }}</td>
                                                <td>{{ date('d-m-Y', strtotime($row->tanggal_bayar)) }}</td>
                                                <td>0{{ $row->no_telp }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink"
                                                            data-bs-toggle="dropdown" aria-expanded="false">Lihat</a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @can('delete role')
                                                                <li><a class="dropdown-item" href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal{{ $a++ }}">Edit</a>
                                                                </li>
                                                            @endcan
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            @can('delete role')
                                                                <li><a class="dropdown-item"
                                                                        href="/deletedata_pegawai">Hapus</a></li>
                                                            @endcan
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalDetail{{ $row->id }}">Detail</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    {{-- @can('delete role')
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $a++ }}"><i class="far fa-edit"></i></button>
                                                    @endcan
                                                    @can('delete role')
                                                        <a href="/deletedata_pegawai/{{ $row->id }}" class="btn btn-danger mt-2 delete"><i class="fas fa-trash-alt"></i></a>
                                                    @endcan
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $row->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button> --}}

                                                </td>
                                            </tr>

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="/updatedata_pegawai/{{ $row->id }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Nama Lengkap</label>
                                                                        <input type="text" name="nama_pegawai"
                                                                            class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            value="{{ $row->nama_pegawai }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Jenis Kelamin</label>
                                                                        <select class="form-select"
                                                                            name="jenis_kelamin"
                                                                            aria-label="Default select example">
                                                                            <option selected>--pilih jenis kelamin--
                                                                            </option>
                                                                            <option value="laki-laki">laki-laki
                                                                            </option>
                                                                            <option value="perempuan">perempuan
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Id Devisi</label>
                                                                        <input type="text" name="id_devisi"
                                                                            class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            value="{{ $row->id_devisi }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Alamat</label>
                                                                        <input type="text" name="alamat"
                                                                            class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            value="{{ $row->alamat }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">No.Telp</label>
                                                                        <input type="number" name="no_telp"
                                                                            class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            value="{{ $row->notelp }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Keluar</button>
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
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Data Pegawai</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                                <div class="mb-3">
                                                                    <label for="nama_pegawai" class="form-label">Nama Lengkap</label>
                                                                    <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai"
                                                                        value="{{ $row->nama_pegawai }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                                    <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin"
                                                                        value="{{ $row->jenis_kelamin }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="devisi" class="form-label">Id Devisi</label>
                                                                    <input type="text" name="id_devisi" class="form-control" id="id_devisi"
                                                                        value="{{ $row->devisis->nama_devisi }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="alamat" class="form-label">Alamat</label>
                                                                    <input type="text" name="alamat" class="form-control" id="alamat"
                                                                        value="{{ $row->alamat }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_telp" class="form-label">No. Telp</label>
                                                                    <input type="number" name="no_telp" class="form-control" id="no_telp"
                                                                        value="0{{ $row->no_telp }}" disabled>
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
    </div>


    <!-- Modal Edit -->
    <div class="modal fade" id="exampleModal{{ $b++ }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit
                        Data Pegawai</h5>
                    @can('edit role')
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    @endcan
                </div>
                <form action="/updatedata_pegawai/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{-- CODE UNTUK TAMPILAN POP UP --}}
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_pegawai" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $row->nama_pegawai }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                <option selected>--pilih jenis kelamin--
                                </option>
                                <option value="laki-laki">laki-laki
                                </option>
                                <option value="perempuan">perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Id Devisi</label>
                            <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $row->id_devisi }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $row->alamat }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">No.Telp</label>
                            <input type="number" name="no_telp" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $row->notelp }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail
                        Data Pegawai</h5>
                </div>
                <div class="modal-body">
                    {{-- CODE UNTUK TAMPILAN POP UP --}}
                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">Nama
                            Lengkap</label>
                        <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai"
                            value="{{ $row->nama_pegawai }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin"
                            value="{{ $row->jenis_kelamin }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="devisi" class="form-label">Id Devisi</label>
                        <input type="text" name="id_devisi" class="form-control" id="id_devisi"
                            value="{{ $row->devisis->nama_devisi }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            value="{{ $row->alamat }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="number" name="no_telp" class="form-control" id="no_telp"
                            value="0{{ $row->no_telp }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"</script>
            <script>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"</script> --}}
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/sweetaalert/dist/sweetalert.min.js"></script>
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

    {{-- MEMBUAT PENCARIANNYA --}}
    <script>
        var table_pegawai = $('#table-pegawai').dataTable({
            ordering: false
        })
    </script>
@endsection
