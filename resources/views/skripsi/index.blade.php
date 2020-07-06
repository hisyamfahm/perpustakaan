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
                        <h3 class="panel-title">Data Skripsi</h3>
                        
                        <div class="right">
                        @if(Auth::check() && Auth::user())
                        <button type="button" class="btn"><a href="{{ url('skripsi/createskripsi') }}" class="btn btn-success">Tambah Skripsi</a></button>
                        @endif
                        <div class="btn-group">
							<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b class="btn btn-default">Bidang
								</b><span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
                            @foreach($bidang as $bi)
								<li><a href="{{route('bidangskripsi',$bi->id)}}">{{$bi->Nama}}
								<span class="badge badge-left">{{$bi->skripsi->count()}}</span></a></li>
                            @endforeach
							</ul>
						</div>
                       
                        </div>  
                    </div> 
    				<div class="panel-body">
                        <form action="skripsi" method="get">
                            <div class="input-group">
                                <input class="form-control" name="cari" type="text" placeholder="Tulis Judul">
                                <span  class="input-group-btn">
                                    <button class="btn btn-primary">Cari</button>
                                </span> 
                            </div>
                        </form>
                        <br>
    					<table class="table table-hover">
    						<thead>
    							<tr>
                                    <th>Validasi</th>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Mahasiswa</th>
                                    <th>Pembimbing I</th>
                                    <th>Pembimbing II</th>
                                    <th>Bidang</th>
                                </tr>
    						</thead>
    						<tbody>
                                @foreach($data_skripsi as $pe)
                                <tr><td>{{$pe->verifikasi['Nama']}}</td>
                                    <td>{{$pe->id}}</td>
                                    <td><a href="{{ url('skripsi/'.$pe->id.'/detail') }}">{{$pe->Judul}}</a></td>
                                    <td>{{$pe->Tahun}}</td>
                                    <td>{{$pe->mahasiswa['Nama']}}</td>
                                    <td>{{$pe->pembimbing1['Nama']}}</td>
                                    <td>{{$pe->pembimbing2['Nama']}}</td>
                                    <td>{{$pe->bidang['Nama']}}</td>
                                    @if(Auth::check() && Auth::user())
                                    <td>@if(!empty($pe->File))<a href="{{ url('public/files/skripsi/'.$pe->File) }}" class="btn btn-info btn-sm" download="{{$pe->File}}" ><i class="glyphicon glyphicon-download"></i>Unduh</a>@endif</td>
                                    @endif
                                    @if(Auth::check() && Auth::user()->role =='admin')
                                        <td><a href="{{ url('skripsi/'.$pe->id.'/editskripsi') }}" class="btn btn-warning btn-sm" >Ubah</a></td>
                                        <td><a href="{{ url('skripsi/hapus/'.$pe->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
    					</table>
                        <b>Halaman :</b><span class="badge">{{ $data_skripsi->currentPage() }}</span><br/>
                        <b> Jumlah Data :</b><span class="badge"> {{ $data_skripsi->total() }} </span><br/>
                        <b> Data Per Halaman : </b><span class="badge">  {{ $data_skripsi->perPage() }}</span> <br/>
                        {{ $data_skripsi->links() }}
    				</div>
    			</div>
    			<!-- END TABLE HOVER -->
            </div>
        </div>
    </div>
</div>
</div>
@endsection

