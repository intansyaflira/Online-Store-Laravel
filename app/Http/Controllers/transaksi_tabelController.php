<?php

namespace App\Http\Controllers;
use App\Models\transaksi_tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class transaksi_tabelController extends Controller
{
    public function show(){
        $data = DB::table('transaksi_tabel')
        ->join('customers2_tabel','transaksi_tabel.id_pelanggan','=','customers2_tabel.id_pelanggan')
        ->join('petugas_tabel','transaksi_tabel.id_petugas','=','petugas_tabel.id_petugas')
        ->select('transaksi_tabel.id_transaksi','transaksi_tabel.tgl_transaksi','customers2_tabel.id_pelanggan','petugas_tabel.id_petugas')
        ->get();
        return Response()->json($data);
    }
    public function detail($id){
        if(transaksi_tabel::where('id_transaksi', $id)->exists()){
            $data_orders = DB::table('transaksi_tabel')
            ->join('customers2_tabel','transaksi_tabel.id_pelanggan','=','customers2_tabel.id_pelanggan')
            ->join('petugas_tabel','transaksi_tabel.id_petugas','=','petugas_tabel.id_petugas')
            ->select('transaksi_tabel.id_transaksi','transaksi_tabel.tgl_transaksi','customers2_tabel.id_pelanggan','petugas_tabel.id_petugas')
            ->where('transaksi_tabel.id_transaksi','=',$id)
            ->get();
            return Response()->json($data_orders);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }

        public function show2()
    {
        $data_orders = transaksi_tabel::join('customers2_tabel', 'customers2_tabel.id_pelanggan', 'transaksi_tabel.id_pelanggan')->get();
        return Response()->json($data_orders);
    }

        public function detail2($id_pelanggan)
    {
        if(transaksi_tabel::where('id_pelanggan', $id_pelanggan)->exists()) {
        $data_orders = transaksi_tabel::join('customers2_tabel', 'customers2_tabel.id_pelanggan', 'transaksi_tabel.id_pelanggan')
        ->where('transaksi_tabel.id_pelanggan', '=', $id_pelanggan)
        ->get();
 
            return Response()->json($data_orders);
    }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }
    public function store(Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'id_pelanggan' => 'required',
            'id_petugas' => 'required',
            'tgl_transaksi' => 'required'
            
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = transaksi_tabel ::create([
        'id_pelanggan' => $request->id_pelanggan,
        'id_petugas' => $request->id_petugas,
        'tgl_transaksi' => date("Y-m-d")
        
        
    ]);
 if($simpan)
 {
 return Response()->json(['status' => 1]);
 }
 else
 {
 return Response()->json(['status' => 0]);
 }
 }
 public function update($id, Request $request) {         
    $validator=Validator::make($request->all(),         
    [                 
        'id_pelanggan' => 'required',                                  
        'id_petugas' => 'required',
        'tgl_transaksi' => 'required'
    ]); 

    if($validator->fails()) {             
        return Response()->json($validator->errors());         
    } 

    $ubah = transaksi_tabel::where('id_transaksi', $id)->update([             
        'id_pelanggan' => $request->id_pelanggan,                          
        'id_petugas' => $request->id_petugas,             
        'tgl_transaksi' => $request->tgl_transaksi
    ]); 

    if($ubah) {             
        return Response()->json(['status' => 1]);         
    }         
    else {             
        return Response()->json(['status' => 0]);         
    }     
}

    public function destroy($id)
    {
        $hapus = transaksi_tabel::where('id_transaksi', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
    }

        else {
            return Response()->json(['status' => 0]);
    }
    }
}
