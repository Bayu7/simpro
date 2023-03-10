<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pegawai | SIMPRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
    <div class="container">

        <div class="row">
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="/pegawai" method="GET">
                        <input type="search" id="cari" name="cari" class="form-control"
                            aria-describedby="passwordHelpInline" placeholder="Ketik nama">
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/tambahpegawai" class="btn btn-outline-success">Tambah+</a>
                </div>
                <div class="col-auto">
                    <a href="/exportpdfpegawai" class="btn btn-outline-primary">Export PDF</a>
                </div>

            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Dibuat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $index => $datas)
                        <tr>
                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                            <td>{{ $datas->nama }}</td>
                            <td>
                                <img src="{{ asset('fotopegawai/' . $datas->foto) }}" alt=""
                                    style="width: 40px;">
                            </td>
                            <td>{{ $datas->jeniskelamin }}</td>
                            <td>{{ $datas->notelepon }}</td>
                            <td>{{ $datas->created_at->format('D M Y') }}</td>
                            {{-- <td>{{ $data->created_at->diffForHumans() }}</td> --}}
                            <td>
                                <a href="/editpegawai/{{ $datas->id }}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{ $datas->id }}"
                                    data-nama="{{ $datas->nama }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
<script>
    $('.delete').click(function() {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
                title: "Apakah kamu yakin?",
                text: "Data dengan nama " + nama + " akan dihapus!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                window.location = "/deletepegawai/" + id + ""
                if (willDelete) {
                    swal({
                        title: "Terhapus!",
                        text: "Data Berhasil Dihapus",
                        icon: "success",
                    });
                }
            });
    });
</script>

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
</script>

</html>
