<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
                <a href="{{ url('beranda') }}"><img src="{{ asset('public/admin/assets/img/logoperpusmtk4.png') }}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li class="navbar-btn"><button type="button"><a href="{{ url('login') }}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-log-in"></i> Login</a></button>
					@endif
						</li>
					@if(auth()->user())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('public/images/default.jpg')}}" class="img-circle" alt="Avatar"> <span>{{auth()->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('logout') }}"><i class="lnr lnr-exit"></i> <span>Keluar</span></a></li>
							</ul>
						</li>
					@endif
					@if(Auth::check() && Auth::user()->role =='admin')
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span><i class="glyphicon glyphicon-collapse-down"></i> Lainnya</span></a>
							<ul class="dropdown-menu">
										<li><a href="{{ url('dosen') }}">Dosen</a></li>
										<li><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
										<li><a href="{{ url('kategori') }}">Kategori</a></li>
										<li><a href="{{ url('sumberdana') }}">Sumber Dana</a></li>
							</ul>
						</li>
					@endif
					</ul>
				</div>
				<div class="navbar-btn navbar-btn-left">
					<div class="btn-toolbar">
						<button><a class="btn btn-success btn-sm" href="{{ url('beranda') }}" title="Beranda"><i class="fa fa-home"></i> <span>Beranda</span></a></button>
						<button><a class="btn btn-info btn-sm" href="{{ url('buku') }}" title="buku"><i class="fa fa-book"></i> <span>Buku</span></a></button>
						<button><a class="btn btn-warning btn-sm" href="{{ url('penelitian') }}" title="penelitian"><i class="fa fa-file"></i> <span>Penelitian</span></a></button>
						<button><a class="btn btn-danger btn-sm" href="{{ url('skripsi') }}" title="Skripsi"><i class="fa fa-paperclip"></i> <span>Skripsi</span></a></button>
						<button type="button" class="dropdown">
						<small class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b class="btn btn-deffault btn-sm"><i class="glyphicon glyphicon-chevron-down"></i> Berkas</b></small>
								<ul class="dropdown-menu">
											<li><a href="{{ url('publikasi') }}">Publikasi</a></li>
											<li><a href="{{ url('pklkkm') }}">PKL dan KKM</a></li>
											<li><a href="{{ url('pengabdian') }}">Pengabdian</a></li>
											<li><a href="{{ url('penulis') }}">Penulis</a></li>
											<li><a href="{{ url('mitra') }}">Mitra</a></li>
								</ul>
						</button>
						<button><a  class="glyphicon glyphicon-menu-left" href="{{ url()->previous() }}"></a></button>
					</div>
				</div>
			</div>
		</nav>


		