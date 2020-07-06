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
                        <h2 class="panel-title"><b> Data Buku</b></h2>
                        <div class="right">
                        @if(Auth::check() && Auth::user()->role =='admin')
                        <button type="button" class="btn btn-warning btn-sm" ><a class="btn btn-warning" href="{{ url('buku/createbuku') }}">Tambah Buku</a></button>
                        @endif
                        <div class="btn-group">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b class="btn btn-danger">Penulis
												<span class="caret"></b></span>
											</button>
											<ul class="dropdown-menu" role="menu">
                                            <div style="OVERFLOW-Y:scroll; WIDTH:200px; HEIGHT:200px"> 
                                                @foreach($penulis as $ci)
                                                    <li><a href="{{route('penulisbuku',$ci->id)}}">{{$ci->NamaDepan}} {{$ci->NamaBelakang}}</a>
                                                    </li>
                                                @endforeach
                                            </div>
											</ul>
						</div>
                        <div class="btn-group">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b class="btn btn-default">Bidang
												<span class="caret"></b></span>
											</button>
											<ul class="dropdown-menu" role="menu">
                                            @foreach($bidang as $bi)
												<li><a href="{{route('bidangbuku',$bi->id)}}">{{$bi->Nama}}</a>
                                                </li>
                                            @endforeach
											</ul>
						</div>
                        </div>  
                    </div> 
				<div class="panel-body">
                <form action="{{ url('buku') }}" method="get">
                    <div class="input-group">
                                                <input class="form-control" id="search" name="search" type="text" placeholder="Tulis Judulnya">
                                                <span  class="input-group-btn"><button class="btn btn-primary">Cari</button></span> 
                    </div>
                </form>

                <br>
					<table class="table table-hover">
						<thead>
							<tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>
								<center>Info Buku</center>
                            </th>
                            <th>E-book</th>
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <th><div class="center">Opsi</div></th>
                            @endif 
                            </tr>
						</thead>
						<tbody>
                        
                        @foreach($data_buku as $buku)
                        <tr>
                        <td>{{$buku->id}}</td>
                        <td><img src="{{$buku->getFoto()}}" class="img-square" alt="Avatar" width="100px" height="100px"></td>
                            <td>
                            <div class="profile-detail">
								        <ul class="list-unstyled">
                                        <li><span class="col-md-2">Penulis </span><ul class="col-md-10">: @foreach($buku->penulis as $p)
                                        <a href="{{route('penulisbuku',$p->id)}}"> {{$p->NamaBelakang}},
                                         {{$p->NamaDepan}}</a> | @endforeach</ul>
                                        </li><hr>
                                            <li><span class="col-md-2">Judul </span><span class="col-md-10">: <a href="{{url('buku/'.$buku->id.'/detail')}}">{{$buku->Judul}}</a></span></li><hr>  
											<li><span class="col-md-2">Penerbit</span><span class="col-md-10">: {{$buku->Penerbit}}</span></li><hr>
											<li><span class="col-md-2">Tahun</span><span class="col-md-10">: {{$buku->Tahun}}</span></li><hr>
											<li><span class="col-md-2">Lokasi</span><span class="col-md-10">: {{$buku->lokasi['NamaLokasi']}}</span></li><hr>
											<li><span class="col-md-2">Bidang </span><ul class="col-md-10">: @foreach($buku->bidang as $h)<a href="{{route('bidangbuku',$h->id)}}">{{$h->Nama}}</a> | @endforeach</ul></li>
                                        </li>
										</ul>
                            </div>
                            </td>   
                            @if(Auth::check() && Auth::user()->role =='admin')
                            <td><a href="{{ url('buku/'.$buku->id.'/editbuku') }}" class="btn btn-warning btn-sm" >Ubah</a>
                            </p>
                            <a href="{{ url('buku/'.$buku->id.'/hapus') }}" class="btn btn-danger btn-sm" enctype="multipart/form-data" onclick="return confirm('Hapus nih ?')">Hapus</a></td>
                            @endif
                            <td><a href="{{ url($buku->ebook) }}" class="btn btn-info btn-sm" >Lihat Buku</a></td>
                        </tr>
                        @endforeach
                        </tbody>
					</table>
                            <b>Halaman :</b>                   <span class="badge">{{ $data_buku->currentPage() }}</span><br/>
                            <b> Jumlah Data :</b>              <span class="badge"> {{ $data_buku->total() }} </span><br/>
                            <b> Data Per Halaman : </b>         <span class="badge">  {{ $data_buku->perPage() }}</span> <br/>
                                
                            
                    <p align="right">
                        {{ $data_buku->links() }}
                    </p>
                    <div class="input-group mb-3">
				</div>
			</div>
			<!-- END TABLE HOVER -->
		        </div>
            <!--Sidebar-->
            <!--ooo-->
                </div>
            </div>
        </div>

    @section('auto')
    <script src="{{asset('public/js/1124.js')}}"></script>
    <script src="{{asset('public/js/ui1121.js')}}"></script>
    <script>
    $(document).ready(function() {
        $( "#search" ).autocomplete({

            source: function(request, response) {
                $.ajax({
                url: "{{url('autocompletebuku')}}",
                data: {
                        term : request.term
                },
                dataType: "json",
                success: function(data){
                var resp = $.map(data,function(obj){
                        //console.log(obj.city_name);
                        return obj.Judul;
                }); 

                response(resp);
                }
            });
        },
        minLength: 1
        });
    });
    </script>
    @endsection

@endsection

