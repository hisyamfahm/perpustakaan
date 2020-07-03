@extends('tampilan.master')
@section('content')
        <div class="main-content">
            <div class="container-fluid">
							@if(session('sukses'))
                            <div class="alert alert-succes" role="alert">
                             {{session('sukses')}}
                            </div>
                            @endif

							@if(session('error'))
                            <div class="alert alert-danger" role="alert">
                             {{session('error')}}
                            </div>
                            @endif
                <div class="row">

                        <div class="col-md-12">

                            <div class="panel">
                                <div class="panel-heading">
                                        <h3 class="panel-title">Ubah Data Penelitian</h3>
                                </div>
                                <div class="panel-body">
                                <form action="{{ url('penelitian/create') }}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <!--<div class="form-group">
                                        <label for="exampleInputEmail1">No</label>
                                        <input name="id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Terserah,Bisa Dikosongi">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Nomornya</small>
                                    </div>-->
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Judul</label>
                                        <input name="Judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Judulnya</small>
                                    </div>

                                    <div class="form-group">
                                    <label for="penelitian">Ketua</label>
                                        <select class="form-control" id="dosenk" name="dosene_id">
                                        @foreach($dosene as $ce)
                                        <option value="{{$ce->id}}">{{$ce->Nama}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                                <label for="exampleInputEmail1">Anggota</label>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Pilih Anggota Dosen<b class="caret"></b></button></a>
                                                    <ul class="dropdown-menu">
                                                    <div style="OVERFLOW-Y:scroll; WIDTH:600px; HEIGHT:300px">
                                                    @foreach ($dosen as $p)
                                                        <li id="dosen">
                                                        <input type="checkbox" name="dosen[]" id="dosen" value="{{$p->id}}">
                                                                <label>
                                                                <span>{{ $p->Nama }}</span>
                                                                </label>
                                                        </li>
                                                    @endforeach
                                                    </div>
                                                    </ul>
                                                </div>
                                                <small id="emailHelp" class="form-text text-muted">Pilih dosen yang menjadi anggota (jika ada)</small>
                                                <br>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dosenModal">
                                                        Tambah Dosen
                                                </button>
                                                <small id="emailHelp" class="form-text text-muted">jika nama dosen tidak tercantum dalam list</small>
                                                <br><hr>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Pilih Anggota Mahasiswa<b class="caret"></b></button></a>
                                                    <ul class="dropdown-menu">
                                                    <div style="OVERFLOW-Y:scroll; WIDTH:600px; HEIGHT:300px">
                                                    @foreach ($mahasiswa as $yu)
                                                        <li id="mahasiswa">
                                                        <input type="checkbox" name="mahasiswa[]" id="mahasiswa" value="{{$yu->id}}">
                                                                <label value="{{$yu->id}}">
                                                                <span>{{ $yu->Nama }}</span>
                                                                </label>
                                                        </li>
                                                    @endforeach
                                                    </div>
                                                    </ul>
                                                </div>
                                                <small id="emailHelp" class="form-text text-muted">Pilih mahasiswa yang menjadi anggota (jika ada)</small>
                                                <br>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mahasiswaModal">
                                                        Tambah Mahasiswa
                                                </button>
                                                <small id="emailHelp" class="form-text text-muted">jika nama mahasiswa tidak tercantum dalam list</small>
                                                
                                                
                                    </div>
            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tahun</label>
                                        <input name="Tahun" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tahun">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Tahun</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Laporan</label>
                                        <input name="Laporan" type="file" class="form-control">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Laporan</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Proposal</label>
                                        <input name="Proposal" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Proposal">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Proposal</small>
                                    </div>  
                                    
                                    <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                        <select class="form-control" id="bidang" name="bidang_id">
                                            <option value="7">Pilih Bidang ...</option>
                                        @foreach($bidang as $ce)
                                        <option value="{{$ce->id}}">{{$ce->Nama}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori_id">
                                            <option value="19">Pilih Kategori ...</option>
                                        @foreach($kategori as $ke)
                                        <option value="{{$ke->id}}">{{$ke->Nama}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                            </div>


                                </div>        

                            </div>

                        </div>
                </div>
            </div>
        </div>
@include('campuran.dosen')
@include('campuran.mahasiswa')

@section('auto')
<script>
$(document).ready(function(){
    $('#addmahasiswa').submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: '/mahasiswa/create',
            type: 'post',
            data: $('#addmahasiswa').serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function(success){
                console.log(success)
                $('#mahasiswaModal').modal('hide'),
                alert("Data Dah Di Save");             
            },
            error: function(error){
                console.log(error)
                alert("Data Tidak Ke Save");
            }
            })
            .done(function(res) {
            // make new option based on ajax response
            var input = '<li><input type="checkbox" name="mahasiswa[]" id="mahasiswa" value="'+ res.id +'"><label><span>' + res.Nama +'</span></label></li>';
            // append option to catogory select
            $('#mahasiswa').append(input);
            });
    });
    $('#submit').click,
    $('#adddosen').submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: '/dosen/create',
            type: 'post',
            data: $('#adddosen').serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function(success){
                console.log(success)
                $('#dosenModal').modal('hide'),
                alert("Data Dah Di Save");             
            },
            error: function(error){
                console.log(error)
                alert("Data Tidak Ke Save");
            }
            })
            .done(function(res) {
            // make new option based on ajax response
            var input = '<li><input type="checkbox" name="dosen[]" id="dosen" value="'+ res.id +'"><label><span>' + res.Nama +'</span></label></li>';
            var inputk='<option value="'+ res.id +'">'+ res.Nama +'</option>';
            // append option to catogory select
            $('#dosen').append(input);
            $('#dosenk').append(inputk);
            });
    });
    $('#submit').click
});
</script>
@endsection
@endsection