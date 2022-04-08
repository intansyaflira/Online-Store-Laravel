<?php

namespace App\Http\Controllers;

use App\Models\product_tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class product_tabelController extends Controller
{
    public function show()
    {
        return product_tabel::all();
    }
    public function detail($id)
    {
        if(product_tabel::where('id_produk', $id)->exists()){
            $data = DB::table('product_tabel')->where('product_tabel.id_produk', '=', $id)->get();
            return Response()->json($data);
        } else{
            return Response() ->json(['message' => 'Tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama_produk' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required',
                'foto_produk' => 'required'
                
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = product_tabel ::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto_produk' => $request->foto_produk
            
        ]);
        if($simpan)
        {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [                 
            'nama_produk' => 'required',                                  
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto_produk' => 'required'          
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = product_tabel::where('id_produk', $id)->update([             
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto_produk' => $request->foto_produk      
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
        $hapus = product_tabel::where('id_produk', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }

    //FOR CLI

    public function index()
    {
        $dt=product_tabel::get();
        return response()->json($dt); 
    }
    public function simpan(Request $req)
    {
        $validator=Validator::make($req->all(),         
        [                 
            'nama_produk' => 'required',                                  
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto_produk' => 'required'        
        ]); 

        if($validator->fails()) {             
            $data['status']=false;
            $data['message']=$validator->errors();   
            return Response()->json($data);     
        } 
        $simpan = product_tabel ::create([
            'nama_produk' => $req->nama_produk,
            'deskripsi' => $req->deskripsi,
            'harga' => $req->harga,
            'foto_produk' => $req->foto_produk
            
        ]);
        if($simpan){
            $data['status']=true;
            $data['message']="Sukses menambahkan produk";
        } else {
            $data['status']=false;
            $data['message']="Gagal menambahkan produk";
        }
        return Response()->json($data); 
    }
    public function getdetailproduct($id)
    {
        $detail = product_tabel::where('id_produk', $id)->first();
        return Response()->json($detail);
    }
    public function editproduct($id, Request $req)
    {
        $validator=Validator::make($req->all(),         
        [                 
            'nama_produk' => 'required',                                  
            'deskripsi' => 'required',
            'harga' => 'required'           
        ]); 
        if($validator->fails()) {             
            $data['status']=false;
            $data['message']=$validator->errors();   
            return Response()->json($data);     
        } 
        $simpan = product_tabel ::where('id_produk', $id)->update([
            'nama_produk' => $req->nama_produk,
            'deskripsi' => $req->deskripsi,
            'harga' => $req->harga
            
        ]);
        if($simpan){
            $data['status']=true;
            $data['message']="Sukses update produk";
        } else {
            $data['status']=false;
            $data['message']="Gagal update produk";
        }
        return Response()->json($data);
    }
    public function hapusproduct($id)
    {
        $hapus = product_tabel::where('id_produk', $id)->delete();
        if($hapus){
            $data['status']=true;
            $data['message']="Sukses hapus produk";
        } else {
            $data['status']=false;
            $data['message']="Gagal hapus produk";
        }
        return Response()->json($data);
    }
}
