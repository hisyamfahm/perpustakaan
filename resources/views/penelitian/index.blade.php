@extends('tampilan.master')
@section('content')
        <div class="main-content">
            <div class="container-fluid">
                        @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
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

			<!-- TABLE HOVER -->
			<div class="panel">
				    <div class="panel-heading">
                        <h3 class="panel-title">Data Penelitian</h3>
                        <div class="right">
                        @if(Auth::check() && Auth::user()->role =='admin')
                        <button type="button"><a href="{{ url('penelitian/createpenelitian') }}" class="btn btn-success">Tambah Data Penelitian</a></button>
                        @endif
                        <div class="btn-group">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><a class="btn btn-default">Bidang
												<span class="caret"></span></a>
											</button>
											<ul class="dropdown-menu" role="menu">
                                            @foreach($bidang as $bi)
												<li><a href="{{route('bidangpenelitian',$bi->id)}}">{{$bi->Nama}}
												<span class="badge badge-pull-left">{{$bi->penelitian->count()}}</span></a></li>
                                            @endforeach
											</ul>
						</div>
                        </div>
                    </div> 
				<div class="panel-body">
                <form action="{{ url('penelitian') }}" method="get">
                    <div class="input-group">
                                                <input class="form-control" name="cari" type="text" placeholder="Tulis Judul">
                                                <span  class="input-group-btn"><button class="btn btn-primary">Cari</button></span> 
                    </div>
                </form>
                <br>
					<table class="table table-hover">
						<thead>
							<tr>
                            <th width="3%">No</th>
                            <th width="25%">Judul</th>
                            <th width="5%">Tahun</th>
                            <th width="15%">Ketua</th>
                            <th width="17%">Anggota</th>
                            <th>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><a>Bidang
										<span class="caret"></span></a>
									</button>
									<ul class="dropdown-menu" role="menu">
									@foreach($bidang as $bi)
										<li><a href="{{route('bidangpenelitian',$bi->id)}}">{{$bi->Nama}}
										<span class="badge badge-pull-left">{{$bi->penelitian->count()}}</span></a></li>
									@endforeach
									</ul>
								</div>
							</th>
                            <!--<th>Sumber Dana</th>-->
                            <th>Dana Hibah</th>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <th>Pilihan</th>
                            @endif
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_penelitian as $pe)
                        <tr>
                            <td>{{$pe->id}}</td>
                            <td><a href="{{ url('penelitian/'.$pe->id.'/detail') }}">{{$pe->Judul}}</a></td>
                            
                            <td>{{$pe->Tahun}}</td>
                            <td><a href="{{ url('dosen/'.$pe->dosene['id'].'/detail') }}">{{$pe->dosene['Nama']}}</a>
                            </td>
                            <td>@foreach($pe->dosen as $ce)
                            <ul><li><a href="{{ url('dosen/'.$ce->id.'/detail') }}">{{$ce->Nama}}</a></li></ul>
                            @endforeach
                            @foreach($pe->mahasiswa as $be)
                            <ul><li>{{$be->Nama}}</li></ul>
                            @endforeach
                            </td>
                            <td>{{$pe->bidang['Nama']}}</td>
                            <!--<td>{{$pe->kategori->sumberdana[0]['Nama']}}</td>-->
                            <td>Rp {{number_format($pe->dana,2,",",".")}}</td>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('penelitian/'.$pe->id.'/editpenelitian') }}" class="btn btn-warning btn-sm" >Ubah</a></td>
                            <td><a href="{{ url('penelitian/hapus/'.$pe->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                    <b>Halaman :</b>                   <span class="badge">{{ $data_penelitian->currentPage() }}</span><br/>
                    <b> Jumlah Data :</b>              <span class="badge"> {{ $data_penelitian->total() }} </span><br/>
                    <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_penelitian->perPage() }}</span> <br/>
                
                
                    {{ $data_penelitian->links() }}
				</div>
			</div>
			<!-- END TABLE HOVER -->

		</div>

                </div>
            </div>
        </div>
    </div>
@endsection

