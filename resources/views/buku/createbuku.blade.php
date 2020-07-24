@extends('tampilan.master')
@section('content')
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel">
                                <div class="panel-heading">
                                        <h3 class="panel-title">Buat Data Buku</h3>
                                        <div class="right">
                                        </div>
                                </div>
                                <div class="panel-body">
                                <!--Form-->
                                <form action="{{ url('buku/createbuku') }}" method="post" name="penulis" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div id="contentpenulis" class="form-group">
                            <label for="exampleInputEmail1">Penulis</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Daftar Penulis<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                             <div style="OVERFLOW-Y:scroll; WIDTH:300px; HEIGHT:300px">    
                                                @foreach ($penulis as $p)
                                                    <li id="penulis">
                                                        <input type="checkbox" name="penulis[]" id="penulis" value="{{$p->id}}">
                                                            <label>
                                                                <span>{{ $p->NamaDepan }}
                                                                {{$p->NamaBelakang}}</span>
                                                            </label>
                                                    </li>
                                                @endforeach
                                             </div>
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Penulis</small><br>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#penulisModal">
                                        Tambah penulis
                                </button>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input name="Judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul">
                                <small id="emailHelp" class="form-text text-muted">Masukan Judul</small>
                            </div>
       
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penerbit</label>
                                <input name="Penerbit" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Penerbit">
                                <small id="emailHelp" class="form-text text-muted">Masukan Penerbit Buku</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input name="Tahun" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tahun">
                                <small id="emailHelp" class="form-text text-muted">Masukan Tahun Terbit</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputISBN">ISBN</label>
                                <input name="ISBN" type="text" class="form-control" id="exampleInputISBN" aria-describedby="emailHelp" placeholder="ISBN">
                                <small id="emailHelp" class="form-text text-muted">Masukan ISBN Buku</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Banyak</label>
                                <input name="Banyak" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Misal 1, 2, atau 3">
                                <small id="emailHelp" class="form-text text-muted">Masukan Banyaknya Buku</small>
                            </div>

                            <div class="form-group">
							<label for="lokasi">Lokasi</label>
								<select class="form-control" id="lokasi" name="lokasi_id">
								@foreach($lokasi as $ce)
								<option value="{{$ce->id}}">{{$ce->NamaLokasi}}</option>
                                @endforeach
								</select>
                            </div>

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Bidang</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Daftar Bidang<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                            @foreach ($bidang as $j)
                                                <li>
                                                <input type="checkbox" name="bidang[]" id="bidang" value="{{$j->id}}">  
                                                        <label value="{{$j->id}}">
                                                        <span>{{ $j->Nama }}</span>
                                                        </label>
                                                   
                                                </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Bidang</small>
                                        
                            </div>

                            <div class="form-group">
                                                        <label for="exampleInputEmail1">Foto</label>
                                                        <input name="foto" type="file" class="form-control">
                                                        <small id="emailHelp" class="form-text text-muted">Masukan Fotonya</small>
                            </div>

                            
                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Simpan</a></button>
                        </form>
                    </div>
                                <!--Form-->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Modal -->
<div class="modal fade" id="penulisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penulisModal">Tambah Penulis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addpenulis">
        <div class="modal-body">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode Penulis</label>
                                <input name="id" type="int" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Penulis">
                                <small id="emailHelp" class="form-text text-muted">Masukan Kode Penulis</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Depan</label>
                                <input name="NamaDepan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
                                <small id="emailHelp" class="form-text text-muted">Masukan Namanya</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Belakang</label>
                                <input name="NamaBelakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang">
                                <small id="emailHelp" class="form-text text-muted">Masukan Nama Belakangnya</small>
                            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>



@section('auto')
<script>
$(document).ready(function(){
    $('#addpenulis').submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: '/buku/penulisadd',
            type: 'post',
            data: $('#addpenulis').serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function(success){
                console.log(success)
                $('#penulisModal').modal('hide'),
                alert("Data Dah Di Save");             
            },
            error: function(error){
                console.log(error)
                alert("Data Tidak Ke Save");
            }
            })
            .done(function(res) {
            // make new option based on ajax response
            var input = '<li><input type="checkbox" name="penulis[]" id="penulis" value="'+ res.id +'"><label><span>' + res.NamaDepan +' '+ res.NamaBelakang +'</span></label></li>';
            // append option to catogory select
            $('#penulis').append(input);
            });
    });
    $('#submit').click
});
</script>
@endsection
@endsection