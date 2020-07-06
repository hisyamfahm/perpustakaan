<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Pklkkm;
use App\Mahasiswa;

class PklkkmController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_pklkkm=\App\Pklkkm::join('mitra','mitra.id','=','IDMitra')->join('dosen','dosen.id','=','KodeDosen')->where('Judul','Like','%'.$request->cari. '%')->orWhere('mitra.Nama','Like','%' .$request->cari. '%')->orWhere('dosen.Nama','Like','%' .$request->cari. '%')->orWhere('Tahun','=',$request->cari)->paginate(10)->appends('cari',request('cari'));
        }else{
            $data_pklkkm=\App\Pklkkm::latest('id')->paginate(10);
        }
        
        $mahasiswa=\App\Mahasiswa::all();
        $mitra=\App\Mitra::all();
        $dosen=\App\Dosen::all();
        return view('pklkkm.index',['data_pklkkm'=> $data_pklkkm,'mahasiswa'=>$mahasiswa,'mitra'=>$mitra,'dosen'=>$dosen]);
    }

    public function create(Request $request)
    {
        $pklkkm=\App\Pklkkm::create($request->all());
        $pklkkm->save();
        $pklkkm->mahasiswa()->attach(Input::get('mahasiswa'));
        $pklkkm->save();
        if($request->hasFile('File')){
            $request->file('File')->move('file/',$request->file('File')->getClientOriginalName());
            $pklkkm->File = $request->file('File')->getClientOriginalName();
            $pklkkm->save();
        }
        
        return redirect('/pklkkm')->with('sukses','Berhasil Ditambahkan');
    }

    public function createpklkkm(Request $request)
    {
        $pklkkm=$data['pklkkm']=Pklkkm::latest('id')->get();
        $mahasiswa=$data['mahasiswa']=Mahasiswa::orderBy('Nama')->get();
        $mitra=\App\Mitra::all();
        $dosen=\App\Dosen::orderBy('Nama')->get();
        return view('pklkkm.createpklkkm',['pklkkm'=>$pklkkm,'mahasiswa'=>$mahasiswa,'dosen'=>$dosen,'mitra'=>$mitra]);
    }

    public function mitracreate(Request $request)
    {
        $mitra=\App\Mitra::create($request->all());
        $mitra->save();
        return $mitra;
    }

    public function editpklkkm($id)
    {
        $pklkkm=$data['pklkkm']=Pklkkm::find($id);
        $mahasiswa=$data['mahasiswa']=Mahasiswa::all();
        $mitra=\App\Mitra::all();
        $dosen=\App\Dosen::all();
        $checkeds=Pklkkm::find($id)->mahasiswa()->pluck('mahasiswa.id')->toArray();
        return view('pklkkm.editpklkkm',['pklkkm'=>$pklkkm,'mahasiswa'=>$mahasiswa,'checkeds'=>$checkeds,'dosen'=>$dosen,'mitra'=>$mitra]);
    }

    public function goeditpklkkm(Request $request,$id)
    {
        $pklkkm=DB::table('pklkkm')->where('id',$request->id)->update([
            'id'=>$request->id,
            'Judul'=>$request->Judul,
            'Tahun'=>$request->Tahun,
            'KodeDosen'=>$request->KodeDosen,
            'IDMitra'=>$request->IDMitra,
        ]);
        $pklkkm = \App\Pklkkm::findOrFail($id);
        $pklkkm->mahasiswa()->sync(Input::get('mahasiswa'));
        return redirect('pklkkm')->with('sukses','Data Diubah');
    }

    public function hapus($id)
    {
        $buku=DB::table('pklkkm')->where('id',$id)->delete();     
        return redirect('/pklkkm')->with('sukses','Sudah Dihapus');
    }

}
