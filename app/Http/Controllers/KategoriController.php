<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use DB;
use App\Kategori;


class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_kategori=\App\Kategori::where('Judul','Like','%'.$request->cari. '%')->paginate(10)->appends('cari',request('cari'));
        }else{
            $data_kategori=\App\Kategori::latest('id')->paginate(10);
        }

        $sumberdana=\App\Sumberdana::all();
        return view('kategori.index',['data_kategori'=> $data_kategori,'sumberdana'=>$sumberdana]);
    }
    public function create(Request $request)
    {
        $kategori=\App\Kategori::create($request->all());
        $kategori->save();  
        $kategori->sumberdana()->sync($request->input('sumberdana')); 
        
        return redirect('/kategori')->with('sukses','Berhasil Diinput');
    }
    public function hapus($id)
    {
        $kategori=DB::table('kategori')->where('id',$id)->delete();     
        return redirect('/kategori')->with('sukses','Sudah Dihapus');
    }
}