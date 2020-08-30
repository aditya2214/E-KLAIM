<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class AdminController extends Controller
{
    //
    public function index(){
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
            ->get();

            return view('admin.content.data_reg',compact('reg'));
    }

    public function approved($id){
        $approved = \App\RegistrasiKlaim::where('no_polis',$id)->first();
        if($approved->status==1){
            Session::flash('error','Data Sudah Di Approved');
        return redirect()->back();
        }
        $approved->status = 1;
        $approved->save();
        
        $id = $approved->id;
        return redirect('nilai/'.$id);
        
    }

    public function nilai($id){
        $data = \App\RegistrasiKlaim::find($id);

        return view('admin.content.masukan_nilai',compact('data'));
    }

    public function storevalue(Request $request){
        $save_to_approval = new \App\Approval;
        $save_to_approval->reg_id = $request->id;
        $save_to_approval->tanggal_persetujuan = date('Y-m-d');
        $save_to_approval->nilai_yang_disetujui = $request->value;
        $save_to_approval->nama_user = Auth::user()->name;
        $save_to_approval->save();

        Session::flash('sukses','Data Berhasil Di Setujui');
        return redirect('/data_reg_claim');
    }

    
}
