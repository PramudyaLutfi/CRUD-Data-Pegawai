@extends('layout.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-center">DATA PEGAWAI</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <h1 class="text-center mb-5">DATA PEGAWAI</h1>
    <div class="container">
        <a href="/tambahpegawai" type="button" class="btn btn-success">Tambah +</a>
        <!-- {{ Session::get('halaman_url') }} -->
            <form class="form-inline mt-2" action="/pegawai" method="GET">
            
                <div class="form-group">
                    <input type="search" id="inputPassword6" name="search" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                </div>
                <div class="col-auto">
                     <a href="/exportpdf" class="btn btn-info">Export PDF</a>
                </div>
                <div class="col-auto">
                     <a href="/exportexcel" class="btn btn-success">Export Excel</a>
                </div>
                <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> 
                    Import Data 
                </button>
                </div>
            </form>        
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/importexcel" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                   <div class="form-group">
                        <input type="file" name="file" required>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </div>
                </form>
            </div>
            </div>
            <!-- <div class="col-auto">
                <a href="#" class="btn btn-info">Export PDF</a>
            </div> -->
            <div class="row mt-2">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No Telpon</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp   
                    @foreach ($data as $index => $row)
                        <tr>
                                <th scope="row">{{ $index + $data->firstItem() }}</th>
                                <td>{{$row->nama}}</td>
                                <td>
                                    <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px;">
                                </td>
                                <td>{{$row->jeniskelamin}}</td>
                                <td>0{{$row->notelepon}}</td>
                                <td>{{$row->created_at->format('D M Y')}}</td>
                                <td>
                                    <a href="/tampilkandata/{{ $row->id }}" class="btn btn-info">edit</a>
                                    <a href="#" class="btn btn-danger delete"data-id="{{$row->id}}" data-nama="{{$row->nama}}">Delete</a>
                                </td>
                            </tr>
                    @endforeach
                       
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
    </div>
    
</div>

 
@endsection

@push('scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> -->

  </body>
<script>
    $('.delete').click(function(){
        var pegawaiid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
        title: "Yakin?",
        text: "Kamu akan menghapus data pegawai dengan nama "+nama+" ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/delete/"+pegawaiid+""
            swal("Data berhasil di hapus", {
            icon: "success",
            });
        } else {
            swal("Data tidak jadi dihapus");
        }
        });
    });
     
</script>

@endpush