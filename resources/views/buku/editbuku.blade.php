@extends('tampilan.master')
@section('content')
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel">
                                <div class="panel-heading">
                                        <h3 class="panel-title">Ubah Data Buku</h3>
                                </div>
                                <div class="panel-body">
                                <form action="{{ url('buku/'.$buku->id.'/goeditbuku') }}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <!-- panelnya-->                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Judul</label>
                                        <input required="required"  name="Judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $buku->Judul }}">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Judul</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Penulis</label>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><button>Daftar Penulis<b class="caret"></b></button></a>
                                            <ul class="dropdown-menu">
                                            <div style="OVERFLOW-Y:scroll; WIDTH:300px; HEIGHT:300px"> 
                                            @foreach ($penulis as $p)
                                                <li>
                                                    <?php $checked = in_array($p->id, $checkeds) ? true : false; ?>
                                                        <label>
                                                        {{ Form::checkbox('penulis[]', $p->id, $checked) }}
                                                        <span>{{ $p->NamaDepan }}{{$p->NamaBelakang}}</span>
                                                        </label>
                                                </li>
                                            @endforeach
                                            </div>
                                            </ul>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Pilih Penulis</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Penerbit</label>
                                        <input name="Penerbit" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $buku->Penerbit }}">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Penerbit Buku</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tahun</label>
                                        <input name="Tahun" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $buku->Tahun }}">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Tahun Terbit</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ISBN</label>
                                        <input name="ISBN" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $buku->ISBN }}">
                                        <small id="emailHelp" class="form-text text-muted">Masukan ISBN Buku</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Banyak</label>
                                        <input name="Banyak" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $buku->Banyak }}">
                                        <small id="emailHelp" class="form-text text-muted">Masukan Banyaknya Buku</small>
                                    </div>

                                    <div class="form-group">
                                    <label for="penulis">Lokasi</label>
                                        <select class="form-control" id="lokasi" name="lokasi_id">
                                        @foreach($lokasi as $be)
                                            @if (old('lokasi_id') == $be->id)
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->NamaLokasi }}</option>
                                            @elseif ( old('lokasi_id') == null && isset($buku->lokasi->id) && ($buku->lokasi->id == $be->id))
                                                <option value="{{ $be->id }}" selected="selected">{{ $be->NamaLokasi }}</option>
                                            @else
                                                <option value="{{ $be->id }}">{{ $be->NamaLokasi }}</option>
                                            @endif
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
                                                    <?php $checkeda = in_array($j->id, $checkedsa) ? true : false; ?>
                                                    {{ Form::checkbox('bidang[]', $j->id, $checkeda) }}
                                                        <label>
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
                                                        <small id="emailHelp" class="form-text text-muted">Masukan Foto</small>
                                    </div>

                                <!--ini doang-->
                                    <div class="modal-footer">
                                    <input type="submit" value="Simpan" class="btn btn-dark">
                                </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection