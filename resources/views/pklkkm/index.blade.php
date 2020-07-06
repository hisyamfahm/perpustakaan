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
                        <h3 class="panel-title">Data PKL dan KKM</h3>
                        <div class="right">
                        @if(Auth::check() && Auth::user())
                        <button type="button" class="btn"><a href="{{ url('pklkkm/createpklkkm')}}" class="btn btn-success">Tambah Data PKL atau KKm</a></button>
                        @endif
                        </div>  
                    </div> 
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tahun</th>
                            <th>File</th>
                            <th>Pembimbing</th>
                            <th>Mahasiswa</th>
                            <th>Mitra</th>
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_pklkkm as $pklkkm)
                        <tr>
                        <td>{{$pklkkm->id}}</td>
                            <td>{{$pklkkm->Judul}}</td>
                            <td>{{$pklkkm->Tahun}}</td>
                            <td>{{$pklkkm->File}}</td>
                            <td>{{$pklkkm->Dosen['Nama']}}</td>
                            <td>@foreach($pklkkm->mahasiswa as $per)
                            <ul><li>{{$per->Nama}}</li></ul>
                            @endforeach</td>
                            <td>{{$pklkkm->Mitra['Nama']}}</td>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('pklkkm/'.$pklkkm->id.'/editpklkkm') }}" class="btn btn-warning btn-sm" >Ubah</a></td>
                            <td><a href="{{ url('pklkkm/'.$pklkkm->id.'/hapus') }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                    </table>
                    <b>Halaman :</b>                   <span class="badge">{{ $data_pklkkm->currentPage() }}</span><br/>
                    <b> Jumlah Data :</b>              <span class="badge"> {{ $data_pklkkm->total() }} </span><br/>
                    <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_pklkkm->perPage() }}</span> <br/>
                
                
                    {{ $data_pklkkm->links() }}
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
                            <form action="{{ url('pklkkm/create') }}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode PKL dan KKM</label>
                                <input name="id" type="int" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Silahkan jika ingin dikosongi">
                                <small id="emailHelp" class="form-text text-muted">Masukan Kode Pkl dan KKM</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input name="Judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul">
                                <small id="emailHelp" class="form-text text-muted">Masukan Judulnya</small>
                            </div>

                            <div class="form-group">
							<label for="pklkkm">Pembimbing</label>
								<select class="form-control" id="pklkkm" name="KodeDosen">
								@foreach($dosen as $ce)
								<option value="{{$ce->id}}">{{$ce->Nama}}</option>
                                @endforeach
								</select>
                            </div>

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Anggota Mahasiswa</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Pilih Anggotanya<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                            <div style="OVERFLOW-Y:scroll; WIDTH:300px; HEIGHT:300px">
                                            @foreach ($mahasiswa as $j)
                                                <li>
                                                    {{ Form::checkbox('mahasiswa[]', $j->id) }}
                                                        <label value="{{$j->id}}">
                                                        <span>{{ $j->Nama }}</span>
                                                        </label>
                                                </li>
                                            @endforeach
                                            </div>
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Anggota</small><br>
                                        <a class="btn btn-sm" href="/mahasiswa">Input Mahasiswa</a>
                            </div>
       
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input name="Tahun" type="int" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tahun">
                                <small id="emailHelp" class="form-text text-muted">Masukan Tahun</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Laporan</label>
                                <input name="Laporan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Laporan">
                                <small id="emailHelp" class="form-text text-muted">Masukan Laporan</small>
                            </div>

                            <div class="form-group">
							<label for="pklkkm">Mitra</label>
								<select class="form-control" id="pklkkm" name="IDMitra">
								@foreach($mitra as $cer)
								<option value="{{$cer->id}}">{{$cer->Nama}}</option>
                                @endforeach
								</select>
                                <small id="emailHelp" class="form-text text-muted">Pilih Mitra</small>
                                <br><a class="btn btn-sm" href="/mitra">Input Mitra</a>
                            </div>
                            
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Sikat</button>
                        </form>
                    </div>
                    </div>
                </div>


@endsection

