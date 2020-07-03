<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'penelitian';
    protected $fillable=['id','Tahun','Judul','dana','Laporan','Proposal','bidang_id','dosene_id','kategori_id'];
    protected $primarykey='id';
   


    public function dosene()
    {
        return $this->belongsTo('App\Dosen');
    }

    public function dosen()
    {
      return $this->belongsToMany('App\Dosen','dsnmeneliti','IDPenelitian','KodeDosen');
    }

    public function mahasiswa()
    {
      return $this->belongsToMany('App\Mahasiswa','mhsmeneliti','IDPenelitian','NIM');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Bidang');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
    public function publikasi()
    {
      return $this->hasMany('App\Publikasi','IDPenelitian');
    }
	
	public function getLaporan()
    {
      if($this->Laporan){
		return asset('public/files/penelitian/'.$this->id.'/'.$this->Laporan);
      }
	  else{
		return null;
	  }
    }

}
