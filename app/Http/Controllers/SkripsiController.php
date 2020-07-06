<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use App\Skripsi;

class SkripsiController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_skripsi=\App\Skripsi::join('mahasiswa','mahasiswa.id','=','mahasiswa_id')->join('bidang','bidang.id','=','bidang_id')->where('Judul','Like','%'.$request->cari. '%')->orWhere('mahasiswa.Nama','Like','%' .$request->cari. '%')->orWhere('Bidang.Nama','Like','%' .$request->cari. '%')->orWhere('Tahun','=',$request->cari)->paginate(10)->appends('cari',request('cari'));
        }else{
            $data_skripsi=\App\Skripsi::latest('id')->paginate(10);
        }
        $mahasiswa=\App\Mahasiswa::all();
        $pembimbing1=\App\Dosen::all();
        $pembimbing2=\App\Dosen::all();
        $bidang=\App\Bidang::all();
        return view('skripsi.index',['data_skripsi'=> $data_skripsi,'mahasiswa'=>$mahasiswa,'pembimbing1'=>$pembimbing1,'pembimbing2'=>$pembimbing2,'bidang'=>$bidang]);
    }

    public function bidang($id)
    {
        $data_skripsi=Skripsi::where('bidang_id',$id)->paginate(10);
        $mahasiswa=\App\Mahasiswa::all();
        $pembimbing1=\App\Dosen::all();
        $pembimbing2=\App\Dosen::all();
        $bidang=\App\Bidang::with('skripsi')->orderBy('Nama')->paginate(10);
        $bidang=\App\Bidang::all();
        return view('skripsi.index',['data_skripsi'=> $data_skripsi,'mahasiswa'=>$mahasiswa,'pembimbing1'=>$pembimbing1,'pembimbing2'=>$pembimbing2,'bidang'=>$bidang]);
    }

    public function create(Request $request)
    {
        $skripsi=\App\Skripsi::create($request->all());
        $skripsi->save();
        $skripsi->verifikasi_id='4';
        $skripsi->save();
        if($request->hasFile('File')){
            $request->file('File')->move('public/files/skripsi/',$request->file('File')->getClientOriginalName());
            $skripsi->File = $request->file('File')->getClientOriginalName();
            $skripsi->save();
        }
        return redirect('/skripsi')->with('sukses','Berhasil... Skripsi di Input');
    }

    public function createskripsi(Request $request)
    {
        $data_skripsi=Skripsi::all();
        $mahasiswa=\App\Mahasiswa::orderBy('id')->get();
        $pembimbing1=\App\Dosen::orderBy('Nama')->whereRaw("Jurusan like '%Matematika%'")->get();
        $pembimbing2=\App\Dosen::orderBy('Nama')->whereRaw("Jurusan like '%Matematika%'")->get();
        $bidang=\App\Bidang::with('skripsi')->orderBy('Nama')->paginate(10);
        $bidang=\App\Bidang::all();
        return view('skripsi.createskripsi',['data_skripsi'=> $data_skripsi,'mahasiswa'=>$mahasiswa,'pembimbing1'=>$pembimbing1,'pembimbing2'=>$pembimbing2,'bidang'=>$bidang]);
    }

    public function hapus($id)
    {
        DB::table('skripsi')->where('id',$id)->delete();     
        return redirect('/skripsi')->with('sukses','Sudah Dihapus');
    }
    
    public function editskripsi($id)
    {
        $skripsi=\App\Skripsi::find($id);
        $mahasiswa=\App\Mahasiswa::all();
        $pembimbing1=\App\Dosen::all();
        $pembimbing2=\App\Dosen::all();
        $bidang=\App\Bidang::all();
        $verifikasi=\App\Verifikasi::all();
        return view('skripsi.editskripsi',['verifikasi'=>$verifikasi,'skripsi'=>$skripsi,'mahasiswa'=>$mahasiswa,'pembimbing1'=>$pembimbing1,'pembimbing2'=>$pembimbing2,'bidang'=>$bidang]);
    }

    public function goeditskripsi(Request $request,$id)
    {
        $skripsi=DB::table('skripsi')->where('id',$request->id)->update([
            'id'=>$request->id,
            'Judul'=>$request->Judul,
            'Tahun'=>$request->Tahun,
            'mahasiswa_id'=>$request->mahasiswa_id,
            'pembimbing1_id'=>$request->pembimbing1_id,
            'pembimbing2_id'=>$request->pembimbing2_id,
            'bidang_id'=>$request->bidang_id,
            'File'=>$request->File,
            'verifikasi_id'=>'4',
        ]);
        $skripsi=\App\Skripsi::find($id);
        $skripsi->save();
        if($request->hasFile('File')){
            $request->file('File')->move('file/',$request->file('File')->getClientOriginalName());
            $skripsi->File = $request->file('File')->getClientOriginalName();
            $skripsi->save();
        }
        return redirect('skripsi')->with('success','Sudah Diubah');
    }

    public function goverifikasi(Request $request,$id)
    {
        $skripsi=DB::table('skripsi')->where('id',$request->id)->update([
            'verifikasi_id'=>$request->verifikasi_id,
        ]);
        return redirect('skripsi/'.$id.'/detail')->with('sukses','Sudah Diubah');
    }
    public function detail($id)
    {
        $skripsi=\App\Skripsi::find($id);
        $verifikasi=\App\Verifikasi::all();
        return view('skripsi.detail',['verifikasi'=>$verifikasi,'skripsi'=>$skripsi]);
    }
}
