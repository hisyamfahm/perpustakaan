<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use DB;
use App\Penulis;

class PenulisController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_penulis=\App\Penulis::where('NamaDepan','Like','%'.$request->cari. '%')->paginate(10)->appends('cari',request('cari'));
        }else{
            $data_penulis=\App\Penulis::orderBy('id')->paginate(10);
        }
    
        return view('penulis.index',['data_penulis'=> $data_penulis]);
    }

    public function create(Request $request)
    {
        $penulis=\App\Penulis::create($request->all());
        return redirect('/penulis')->with('sukses','Berhasil');
    }

    public function editpenulis($id)
    {
        $penulis=$data['penulis'] = Penulis::find($id);
        return view('penulis.editpenulis',['penulis'=>$penulis]);

    }

    public function goeditpenulis(Request $request,$id)
    {
        $penulis=DB::table('penulis')->where('id',$request->id)->update([
            'id'=>$request->id,
            'NamaDepan'=>$request->NamaDepan,
            'NamaBelakang'=>$request->NamaBelakang,
        ]);
        return redirect('/penulis')->with('sukses','Data Diubah');
    }

    public function hapus($id)
    {
        $mahasiswa=DB::table('penulis')->where('id',$id)->delete();     
        return redirect('/penulis')->with('sukses','Sudah Dihapus');
    }
}
