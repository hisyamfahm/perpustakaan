<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Mahasiswa;
use App\Penelitian;
use App\Dosen;
use App\Bidang;
use App\Kategori;

class PenelitianController extends Controller


{
    public function index(Request $request)
    {
        if($request->has('cari')){
            //$data_penelitian=\App\Penelitian::where('Judul','Like','%'.$request->cari. '%')->paginate(10)->appends('cari',request('cari'));
			$data_penelitian=\App\Penelitian::join('dosen','dosen.id','=','dosene_id')->where('Judul','Like','%'.$request->cari. '%')->orWhere('dosen.Nama','Like','%'.$request->cari. '%')->orWhere('Tahun','=',$request->cari)->paginate(10)->appends('cari',request('cari'));
        }else{
            $data_penelitian=\App\Penelitian::latest('Tahun')->paginate(10);
		}
        $dosen=\App\Dosen::orderBy('Nama')->get();
        $dosene=\App\Dosen::orderBy('Nama')->get();
        $mahasiswa=\App\Mahasiswa::orderBy('Nama')->get();       
        $bidang=\App\Bidang::orderBy('Nama')->get();
        $kategori=\App\Kategori::orderBy('Nama')->get();
        return view('penelitian.index',['data_penelitian'=> $data_penelitian,'dosen'=>$dosen,'dosene'=>$dosene,'mahasiswa'=>$mahasiswa,'kategori'=>$kategori,'bidang'=>$bidang]);
    }

    public function bidang($id)
    {
        $data_penelitian=Penelitian::where('bidang_id',$id)->paginate(10);
        $dosen=\App\Dosen::all();
        $dosene=\App\Dosen::all();
        $mahasiswa=\App\Mahasiswa::all();       
        $bidang=\App\Bidang::all();
        $kategori=\App\Kategori::all();
        return view('penelitian.index',['data_penelitian'=> $data_penelitian,'dosen'=>$dosen,'dosene'=>$dosene,'mahasiswa'=>$mahasiswa,'kategori'=>$kategori,'bidang'=>$bidang]);
    }



    public function create(Request $request)
    {
        $penelitian=\App\Penelitian::create([
            'id'=>$request->id,
            'Judul'=>$request->Judul,
            'Tahun'=>$request->Tahun,
            'Laporan'=>$request->Laporan,
            'Proposal'=>$request->Proposal,
            'bidang_id'=>$request->bidang_id,
            'dosene_id'=>$request->dosene_id,
            'kategori_id'=>$request->kategori_id,
        ]);
		$penelitian->save();
		if($request->hasFile('Laporan')){
            $request->file('Laporan')->move('public/files/penelitian/'.$penelitian->id.'/',$request->file('Laporan')->getClientOriginalName());
            $penelitian->laporan = $request->file('Laporan')->getClientOriginalName();
			$penelitian->save();
        }
        $penelitian->dosen()->attach(Input::get('dosen'));
        $penelitian->mahasiswa()->attach(Input::get('mahasiswa'));
        return redirect('/penelitian')->with('sukses','Berhasil... Penelitian di Input');
    }

    public function createpenelitian(Request $request)
    {
        $data_penelitian=Penelitian::all();
        $dosen=\App\Dosen::orderBy('Nama')->get();
        $dosene=\App\Dosen::orderBy('Nama')->get();
        $mahasiswa=\App\Mahasiswa::orderBy('Nama')->get();       
        $bidang=\App\Bidang::orderBy('Nama')->get();
        $kategori=\App\Kategori::orderBy('Nama')->get();
		return view('penelitian.createpenelitian',['data_penelitian'=> $data_penelitian,'dosen'=>$dosen,'dosene'=>$dosene,'mahasiswa'=>$mahasiswa,'kategori'=>$kategori,'bidang'=>$bidang]);
    }

    public function mahasiswaadd(Request $request)
    {
        $mahasiswa=\App\Mahasiswa::create($request->all());
        $mahasiswa->save();

        return $mahasiswa;
    }

    public function editpenelitian($id)
    {
        $penelitian=$data['penelitian'] = Penelitian::find($id);
        $dosen=$data['dosen'] = Dosen::all();
        $dosene=\App\Dosen::all();
        $mahasiswa=$data['mahasiswa']=Mahasiswa::all();
        $bidang=\App\Bidang::all();
        $kategori=\App\Kategori::all();
        $checkeds=Penelitian::find($id)->dosen()->pluck('dosen.id')->toArray();
        $checkedsa=Penelitian::find($id)->mahasiswa()->pluck('mahasiswa.id')->toArray();
        return view('penelitian.editpenelitian',['penelitian'=>$penelitian,'dosen'=>$dosen,'dosene'=>$dosene,'mahasiswa'=>$mahasiswa,'kategori'=>$kategori,'bidang'=>$bidang,'checkeds'=>$checkeds,'checkedsa'=>$checkedsa]);

    }
    public function goeditpenelitian(Request $request,$id)
    {
        $penelitian=DB::table('penelitian')->where('id',$request->id)->update([
            'id'=>$request->id,
            'Judul'=>$request->Judul,
            'Tahun'=>$request->Tahun,
            'dana'=>$request->Dana,
            'Laporan'=>$request->Laporan,
            'Proposal'=>$request->Proposal,
            'bidang_id'=>$request->bidang_id,
            'dosene_id'=>$request->dosene_id,
            'kategori_id'=>$request->kategori_id,
        ]);
        $penelitian = \App\Penelitian::findOrFail($id);
        $penelitian->dosen()->sync(Input::get('dosen'));
        $penelitian->mahasiswa()->sync(Input::get('mahasiswa'));
        return redirect('penelitian')->with('sukses','Penelitian Diubah');
    }

    public function hapus($id)
    {
        DB::table('penelitian')->where('id',$id)->delete();     
        return redirect('/penelitian')->with('sukses','Sudah Dihapus');
    }
    public function detail($id)
    {
        $penelitian=\App\Penelitian::find($id);
        return view('penelitian.detail',['penelitian'=>$penelitian]);
    }

}
