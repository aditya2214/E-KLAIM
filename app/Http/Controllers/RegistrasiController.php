<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
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


        $data = $request->no_polis;
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://services.jp.co.id/api/dummy/index.php/verification?nopolis=".$data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json'
                ),
            ));
 
        $response = curl_exec($curl);
        $err = curl_error($curl);
 
        curl_close($curl);
 
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $sel = json_decode($response);
                    // dd($kota);
        }

        try {
            //code...
            $request->no_polis==$sel->nomorpolis;
            $registrasi_klaim->save();
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error','Maaf data tidak ditemukan');
            return redirect()->back();
        }


        $id = $registrasi_klaim->id;

        return redirect('upload_dokumen_pendukung/'.$id);
    }

    public function api(){
        $data = 7280014071219000003;
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://services.jp.co.id/api/dummy/index.php/verification?nopolis=".$data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json'
                ),
            ));
 
        $response = curl_exec($curl);
        $err = curl_error($curl);
 
        curl_close($curl);
 
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $sel = json_decode($response);
                    // dd($kota);
        }

        dd( $response);

        return redirect()->back();
    }

    public function check(){
        $data_klaim = \App\RegistrasiKlaim::all();
        return view('user_umum.success',compact('data_klaim'));
    }

    public function halaman_upload($id){
        $data = \App\RegistrasiKlaim::find($id);
        Session::flash('sukses','Veririfikasi Sukses : No Polis ='.$data->no_polis);
        return view('user_umum.upload',compact('data'));
    }

    public function upload(Request $request){
        $upload = new \App\UploadPendukung;
        $upload->reg_id = $request->id;
        try {
            //code...
            $upload->lokasi_file =   $request->image->store('images','public');
        } catch (\Throwable $th) {
            //throw $th;
            $upload->lokasi_file=null;
        }
        $upload->tgl_upload = date('Y-m-d');
        try {
            //code...
            $upload->name_file =   $request->image->store('images','public');
        } catch (\Throwable $th) {
            //throw $th;
            $upload->name_file=null;
        }        $upload->save();

        Session::flash('sukses','Data Berhasil Di Simpan: Silahkan cari no polis anda di table berikut');
        return redirect('success');
        
    }

    public function detail($id){
        $reg = DB::table('registrasi_klaims')
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

            return view('user_umum.detail',compact('reg'));

    }
}
