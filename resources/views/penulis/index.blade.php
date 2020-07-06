@extends('tampilan.master')
@section('content')
        <div class="main-content">
            <div class="container-fluid">
                            @if(session('sukses'))
                                <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                                </div>
                            @endif
                <div class="row">
                <div class="col-md-12">
			<!-- TABLE HOVER -->
			<div class="panel">
				    <div class="panel-heading">
                        <h3 class="panel-title">Data Penulis</h3>
                        @if(Auth::check() && Auth::user()->role =='admin')
                        <div class="right">
                        <button type="button" class="btn" data-toggle="modal" data-target="#penulisModal"><a class="btn btn-success">Tambah Penulis</a></button>
                        </div>
                        @endif  
                    </div> 
				<div class="panel-body">
                <form action="{{ url('penulis') }}" method="get">
                    <div class="input-group">
						<input class="form-control" name="cari" type="text" placeholder="Tulis Nama Penulisnya">
						<span  class="input-group-btn"><button class="btn btn-primary">Cari</button></span> 
                    </div>
                </form>
                <br>
					<table class="table table-hover">
						<thead>
							<tr>
                            <th>No</th>
                            <th>Nama Penulis</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Laman Penulis</th>
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_penulis as $pk)
                        <tr>
                        <td>{{$pk->id}}</td>
                        <td><a href="{{url('buku/penulis/'.$pk->id)}}">{{$pk->NamaDepan}} {{$pk->NamaBelakang}}</a></td>
                            <td>{{$pk->NamaDepan}}</td>
                            <td>{{$pk->NamaBelakang}}</td>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('penulis/'.$pk->id.'/editpenulis') }}" class="btn btn-warning btn-sm" >Ubah</a></td>
                            <td><a href="{{ url('penulis/'.$pk->id.'/hapus') }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                            <td><a href="{{ url($pk->Informasi) }}" class="btn btn-info btn-sm" >Kunjungi</a></td>
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                    <b>Halaman :</b>                   <span class="badge">{{ $data_penulis->currentPage() }}</span><br/>
                    <b> Jumlah Data :</b>              <span class="badge"> {{ $data_penulis->total() }} </span><br/>
                    <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_penulis->perPage() }}</span> <br/>
                
                
                    {{ $data_penulis->links() }}
				</div>
			</div>
			<!-- END TABLE HOVER -->

		</div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="penulisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inputkan Datanya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form action="{{ url('buku/penulisadd') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                    </div>
                </div>


@endsection

