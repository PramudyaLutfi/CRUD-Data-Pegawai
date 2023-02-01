@extends('layout.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pegawai</h1>
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


    <div class="container">
            <a href="/tambahpegawai" type="button" class="btn btn-success">Tambah +</a>
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