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

                                <form action="{{ url('penelitian/'.$penelitian->id.'/goeditpenelitian') }}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input name="Judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$penelitian->Judul}}">
                                <small id="emailHelp" class="form-text text-muted">Masukan Judulnya</small>
                            </div>

                            <div class="form-group">
							<label for="penelitian">Ketua</label>
								<select class="form-control" id="penelitian" name="dosene_id">
								@foreach($dosene as $be)
								@if (old('dosene_id') == $be->id)
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @elseif ( old('dosene_id') == null && isset($penelitian->dosene->id) && ($penelitian->dosene->id == $be->id))
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @else
                                                <option value="{{ $be->id }}">{{ $be->Nama }}</option>
                                            @endif
                                @endforeach
								</select>
                            </div>

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Anggota</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Daftar Anggota<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                            <div style="OVERFLOW-Y:scroll; WIDTH:600px; HEIGHT:300px">
                                            @foreach ($dosen as $p)
                                                <li>
                                                <?php $checked = in_array($p->id, $checkeds) ? true : false; ?>
                                                    {{ Form::checkbox('dosen[]', $p->id, $checked) }}
                                                        <span>{{ $p->Nama }}</span>
                                                        </label>
                                                </li>
                                            @endforeach
                                            @foreach ($mahasiswa as $yu)
                                                <li>
                                                <?php $checkeda = in_array($yu->id, $checkedsa) ? true : false; ?>
                                                    {{ Form::checkbox('mahasiswa[]', $yu->id, $checkeda) }}
                                                        <span>{{ $yu->Nama }}</span>
                                                        </label>
                                                </li>
                                            @endforeach
                                            </div>
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Anggota</small><br>
                            </div>
       
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input name="Tahun" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$penelitian->Tahun}}">
                                <small id="emailHelp" class="form-text text-muted">Masukan Tahun</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Realisasi Dana</label>
                                <input name="Dana" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$penelitian->dana}}">
                                <small id="emailHelp" class="form-text text-muted">Masukan Realisasi Dana Hibah</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Laporan</label>
                                <input name="Laporan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$penelitian->Laporan}}">
                                <small id="emailHelp" class="form-text text-muted">Masukan Laporan</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Proposal</label>
                                <input name="Proposal" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{$penelitian->Proposal}}">
                                <small id="emailHelp" class="form-text text-muted">Masukan Proposal</small>
                            </div>  
                            
                            <div class="form-group">
							<label for="bidang">Bidang</label>
								<select class="form-control" id="bidang" name="bidang_id">
								@foreach($bidang as $be)
								            @if (old('bidang_id') == $be->id)
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @elseif ( old('bidang_id') == null && isset($penelitian->bidang->id) && ($penelitian->bidang->id == $be->id))
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @else
                                                <option value="{{ $be->id }}">{{ $be->Nama }}</option>
                                            @endif
                                @endforeach
								</select>
                            </div>

                            <div class="form-group">
							<label for="kategori">Kategori</label>
								<select class="form-control" id="kategori" name="kategori_id">
								@foreach($kategori as $be)
								            @if (old('kategori_id') == $be->id)
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @elseif ( old('kategori_id') == null && isset($penelitian->kategori->id) && ($penelitian->kategori->id == $be->id))
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->Nama }}</option>
                                            @else
                                                <option value="{{ $be->id }}">{{ $be->Nama }}</option>
                                            @endif
                                @endforeach
								</select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                                </div>
                            </div>        

                        </div>
                
                </div>
            </div>
        </div>
</div>
@endsection
