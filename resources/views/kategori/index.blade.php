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
                        <h3 class="panel-title">Data Kategori</h3>
                        <div class="right">
                        @if(Auth::check() && Auth::user()->role =='admin')
                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><a class="btn btn-success">Tambah Kategori</a></button>
                        @endif
                        </div>  
                    </div> 
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Jumlah Dana</th>
                            <th>Sumber Dana</th>
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_kategori as $pk)
                        <tr>
                        <td>{{$pk->id}}</td>
                            <td><a href="{{ url('kategori/'.$pk->id.'/detail') }}">{{$pk->Nama}}</a></td>
                            <td>Rp. {{number_format($pk->JumlahDana,2,",",".")}}</td>
                            <td>@foreach($pk->sumberdana as $a)
                            <ul><li>{{$a->Nama}}</li></ul>
                            @endforeach</td>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('kategori/'.$pk->id.'/hapus') }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                    <b>Halaman :</b>                   <span class="badge">{{ $data_kategori->currentPage() }}</span><br/>
                    <b> Jumlah Data :</b>              <span class="badge"> {{ $data_kategori->total() }} </span><br/>
                    <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_kategori->perPage() }}</span> <br/>
                
                
                    {{ $data_kategori->links() }}
				</div>
			</div>
			<!-- END TABLE HOVER -->

		</div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inputkan Datanya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form action="{{url('kategori/create') }}" method="POST">
                            {{csrf_field()}}
                            <!--<div class="form-group">
                                <label for="exampleInputEmail1">Kode Kategori</label>
                                <input name="id" type="int" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Kategori">
                                <small id="emailHelp" class="form-text text-muted">Masukan Kode Sumber Dana</small>
                            </div>-->
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <input name="Nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama">
                                <small id="emailHelp" class="form-text text-muted">Masukan Namanya</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Dana</label>
                                <input name="JumlahDana" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Jumlah Dana">
                                <small id="emailHelp" class="form-text text-muted">Masukan Jumlah Dana</small>
                            </div>

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Sumber Dana</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Daftar Sumber Dana<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                            @foreach ($sumberdana as $pe)
                                                <li>
                                                    {{ Form::checkbox('sumberdana[]', $pe->id) }}
                                                        <label value="{{$pe->id}}">
                                                        <span>{{ $pe->Nama }}</span>
                                                        </label>
                                                </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Sumber Dana</small><br>
                                        <a class="btn btn-sm" href="{{ url('sumberdana') }}">Input Sumber Dana</a>
                            </div>

                           
                                                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                    </div>
                </div>


@endsection