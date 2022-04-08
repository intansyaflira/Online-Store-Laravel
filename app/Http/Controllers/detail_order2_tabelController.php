<?php

namespace App\Http\Controllers;

use App\Models\detail_order2_tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class detail_order2_tabelController extends Controller
{
    public function show(){
        $data = DB::table('detail_order2_tabel')
        ->join('transaksi_tabel', 'detail_order2_tabel.id_transaksi', '=', 'transaksi_tabel.id_transaksi')
        ->join('product_tabel', 'detail_order2_tabel.id_produk', '=', 'product_tabel.id_produk') 
        ->select('transaksi_tabel.id_transaksi', 'transaksi_tabel.tgl_transaksi', 'product_tabel.nama_produk', 'detail_order2_tabel.qty','detail_order2_tabel.subtotal')
        ->get();
        return Response()->json($data);
    }

    public function detail($id){
        if(detail_order2_tabel::where('id_detail_transaksi', $id)->exists()){
            $data_detail = DB::table('detail_order2_tabel')
            ->join('transaksi_tabel', 'detail_order2_tabel.id_transaksi', '=', 'transaksi_tabel.id_transaksi')
            ->join('product_tabel', 'detail_order2_tabel.id_produk', '=', 'product_tabel.id_produk') 
            ->select('transaksi_tabel.id_transaksi', 'transaksi_tabel.tgl_transaksi', 'product_tabel.nama_produk', 'detail_order2_tabel.qty','detail_order2_tabel.subtotal')
            ->where('detail_order2_tabel.id_detail_transaksi', '=', $id)
            ->get();
            return Response()->json($data_detail);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }

    public function store(Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'id_transaksi' => 'required',
            'id_produk' => 'required',
            'qty' => 'required'
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }

    $id_produk = $request->id_produk;
    $qty = $request->qty;
    $harga = DB::table('product_tabel')->where('id_produk',$id_produk)->value('harga');
    $subtotal = $harga * $qty;

    $simpan = detail_order2_tabel ::create([
        'id_transaksi' => $request->id_transaksi,
        'id_produk' => $id_produk,
        'qty' => $qty,
        'subtotal' => $subtotal
        
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
        'id_transaksi' => 'required',                                  
        'id_produk' => 'required',
        'qty' => 'required',
        'subtotal' => 'required'
    ]); 

    if($validator->fails()) {             
        return Response()->json($validator->errors());         
    } 

    $ubah = detail_order2_tabel::where('id_detail_transaksi', $id)->update([             
        'id_transaksi' => $request->id_transaksi,                          
        'id_produk' => $request->id_produk,  
        'qty' => $request->qty,              
        'subtotal' => $request->subtotal
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
    $hapus = detail_order2_tabel::where('id_detail_transaksi', $id)->delete();

    if($hapus) {
        return Response()->json(['status' => 1]);
}

    else {
        return Response()->json(['status' => 0]);
}
}
}
