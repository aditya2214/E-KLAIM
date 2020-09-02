<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use PDF;
class AdminController extends Controller
{
    //
    public function index(){
        $reg = DB::table('registrasi_klaims')
            ->leftjoin('upload_pendukungs', 'registrasi_klaims.id', '=', 'upload_pendukungs.reg_id')
            ->leftjoin('detail_pembayarans', 'registrasi_klaims.id', '=', 'detail_pembayarans.reg_id')
            ->select('registrasi_klaims.id',
            'registrasi_klaims.no_polis', 
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
            'upload_pendukungs.name_file',
            'detail_pembayarans.bukti_pembayaran')
            ->orderBy('registrasi_klaims.created_at','DESC')
            ->get();

            return view('admin.content.data_reg',compact('reg'));
    }

    public function approved($id){
        $approved = DB::table('registrasi_klaims')
        ->leftjoin('upload_pendukungs', 'registrasi_klaims.id', '=', 'upload_pendukungs.reg_id')
        ->leftjoin('detail_pembayarans', 'registrasi_klaims.id', '=', 'detail_pembayarans.reg_id')
        ->select('registrasi_klaims.id',
        'registrasi_klaims.no_polis', 
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
        'upload_pendukungs.name_file',
        'detail_pembayarans.bukti_pembayaran')
        ->where('registrasi_klaims.id',$id)
        ->get();

        
        foreach ($approved as $key => $value) {
            # code...
            $id = $value->id;
            if ($value->status==1) {
                # code...
                Session::flash('error','Data sudah pernah di approved');
                return redirect()->back();
            }
            if ($value->name_file==null) {
                # code...
                Session::flash('error','Data Pendukung Tidak Ada : Tidak Bisa Di Approved');
                return redirect()->back();
            }
        }

        // return $approved;
        $data = \App\RegistrasiKlaim::find($id);
        $data->status= 1;
        $data->save();

        return redirect('nilai/'.$id);
        
    }

    public function nilai($id){
        $data = \App\RegistrasiKlaim::find($id);

        return view('admin.content.masukan_nilai',compact('data'));
    }

    public function storevalue(Request $request){
// return $request->all();
        $save_to_approval = new \App\Approval;
        $save_to_approval->reg_id = $request->id;
        $save_to_approval->tanggal_persetujuan = date('Y-m-d');
        $save_to_approval->nilai_yang_disetujui = $request->value;
        $save_to_approval->nama_user = Auth::user()->name;
        $save_to_approval->save();

        $upload = new \App\DetailPembayaran;
        $upload->reg_id = $request->id;
        $upload->tanggal_bayar =  date('Y-m-d');
        $upload->bukti_pembayaran = $request->image->store('bukti_pembayaran','public');
        $upload->nama_user = Auth::user()->name;
        $upload->save();


        Session::flash('sukses','Data Berhasil Di Setujui');
        return redirect('/data_reg_claim');
    }

    public function detailno($id){
        $data_no = DB::table('registrasi_klaims')
            ->leftjoin('upload_pendukungs', 'registrasi_klaims.id', '=', 'upload_pendukungs.reg_id')
            ->leftjoin('detail_pembayarans', 'registrasi_klaims.id', '=', 'detail_pembayarans.reg_id')
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
            'upload_pendukungs.name_file',
            'detail_pembayarans.bukti_pembayaran')
            ->where('no_polis', $id)
            ->first();
        return view('admin.content.detail',compact('data_no'));
    }

    public function cetak($id){
        try {
            $curl = curl_init();
 
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://services.jp.co.id/api/dummy/index.php/verification?nopolis=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json',
                ),
            ));
 
        $response = curl_exec($curl);
        $err = curl_error($curl);
 
        curl_close($curl);
 
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $sel = json_decode($response);
            
        }
         
            $pdf = PDF::loadview('admin.content.pdf',compact('sel'))->setPaper('a4', 'landscape');
            return $pdf->stream();
 
        } catch (\Exception $e) {
            Session::flash('error','Gagal Membuka PDF'.$e);
        }
 
        return redirect()->back();
    }

    
}
