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
                        <h3 class="panel-title">Data Publikasi</h3>
                        <div class="right">
                        @if(Auth::check() && Auth::user()->role =='admin')
                        <a href="{{ url('publikasi/createpublikasi') }}" class="btn btn-info btn-sm"><i  class="glyphicon glyphicon-plus-sign"></i> Tambah Data Publikasi</a>
                        @endif
                        </div>  
                    </div> 
				<div class="panel-body">
                <form action="{{ url('publikasi') }}" method="get">
                    <div class="input-group">
                                                <input class="form-control" name="cari" type="text" placeholder="Tulis Judulnya">
                                                <span  class="input-group-btn"><button class="btn btn-primary">Cari</button></span> 
                    </div>
                </form>
                <br>
					<table class="table table-hover">
						<thead>
							<tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Deskripsi</th>
                            <th>Jenis Publikasi</th>
                            @if(Auth::check() && Auth::user())
                            <th><div class="center">Link Download</div></th>
                            @endif
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_publikasi as $pe)
                        <tr>
                            <td>{{$pe->id}}</td>
                            <td><a href="{{ url('publikasi/'.$pe->id.'/detail') }}">{{$pe->Judul}}</a></td>
                            <td>
                            @foreach($pe->penulis as $ce)
                            <ul><li>{{$ce->NamaBelakang}},{{$ce->NamaDepan}}</li></ul>
                            @endforeach
                            </td>
                            <td>{{$pe->Tahun_Terbit}}</td>
                            <td>{{$pe->Deskripsi}}</td>
                            
                            <td>{{$pe->jenispublikasi['Nama_Jenis']}}</td>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('publikasi/'.$pe->id.'/editpublikasi') }}" class="btn btn-warning btn-sm" >Ubah</a></td>
                            <td><a href="{{ url('publikasi/hapus/'.$pe->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                            @if(Auth::check() && Auth::user())
                            <td><a href="{{ url($pe->link_download) }}" class="btn btn-info btn-sm" >Download</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                    <b>Halaman :</b>                   <span class="badge">{{ $data_publikasi->currentPage() }}</span><br/>
                    <b> Jumlah Data :</b>              <span class="badge"> {{ $data_publikasi->total() }} </span><br/>
                    <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_publikasi->perPage() }}</span> <br/>
                
                
                    {{ $data_publikasi->links() }}
				</div>
			</div>
			<!-- END TABLE HOVER -->

		</div>

                </div>
            </div>
        </div>
    </div>

@endsection

