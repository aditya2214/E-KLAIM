<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RegistrasiController extends Controller
{
    //

    public function store(Request $request){
        $registrasi_klaim = new \App\RegistrasiKlaim;
        $registrasi_klaim->no_polis = $request->no_polis;
        $registrasi_klaim->tgl_kejadian = $request->tgl_kejadian;
        $registrasi_klaim->waktu_kejadian = $request->waktu_kejadian;
        $registrasi_klaim->penyebab = $request->penyebab;
        $registrasi_klaim->deskripsi_kejadian = $request->deskripsi_kejadian;
        $registrasi_klaim->estimasi_kerugian = $request->estimasi_kerugian;
        $registrasi_klaim->no_rek = $request->no_rek;
        $registrasi_klaim->nm_bank = $request->nm_bank;
        $tahun = date('y');
        $bulan = date('m');
        $data = \App\RegistrasiKlaim::whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->count();
        $invID = str_pad(  $data + 1, 3, "0", STR_PAD_LEFT );
        $nomor_claim = $tahun.$bulan.$invID;
        $registrasi_klaim->no_klaim = $nomor_claim ;
        $registrasi_klaim->status = 0;
        $registrasi_klaim->save();

        $id = $registrasi_klaim->id;

        return redirect('upload_dokumen_pendukung/'.$id);
    }

    public function check(){
        $data_klaim = \App\RegistrasiKlaim::orderBy('created_at','desc')->get();
        return view('user_umum.success',compact('data_klaim'));
    }

    public function halaman_upload($id){
        $data = \App\RegistrasiKlaim::find($id);
        return view('user_umum.upload',compact('data'));
    }

    public function upload(Request $request){
        $upload = new \App\UploadPendukung;
        $upload->reg_id = $request->id;
        $upload->lokasi_file =   $request->image->store('images','public');
        $upload->tgl_upload = date('Y-m-d');
        $upload->name_file = $request->image->store('images','public');
        $upload->save();

        return redirect('success');
        
    }

    public function detail($id){
        $reg = DB::table('registrasi_klaims')
            ->leftjoin('upload_pendukungs', 'registrasi_klaims.id', '=', 'upload_pendukungs.reg_id')
            ->select('registrasi_klaims.no_polis', 
            'registrasi_klaims.tgl_kejadian',
            'registrasi_klaims.waktu_kejadian',
            'registrasi_klaims.penyebab',
            'registrasi_klaims.deskripsi_kejadian',
            'registrasi_klaims.estimasi_kerugian',
            'registrasi_klaims.no_rek',
            'registrasi_klaims.nm_bank',
            'registrasi_klaims.no_klaim',
            'registrasi_klaims.status',
            'registrasi_klaims.created_at',
            'upload_pendukungs.name_file')
            ->where('no_polis', $id)
            ->first();

            return view('user_umum.detail',compact('reg'));

    }
}
