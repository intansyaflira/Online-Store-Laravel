<?php

namespace App\Http\Controllers;

use App\Models\customers2_tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

// header ('Access-Control-Allow-origin: *'); //agar bisa diakses front end dimana saja

class Customers2_TabelController extends Controller
{
    public function show()
    {
        return customers2_tabel::all();
    }
    public function detail($id)
    {
        if(customers2_tabel::where('id_pelanggan', $id)->exists()){
            $data = DB::table('customers2_tabel')->where('customers2_tabel.id_pelanggan', '=', $id)->get();
            return Response()->json($data);
        } else{
            return Response() ->json(['message' => 'Tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
    $validator=Validator::make($request->all(),
        [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = customers2_tabel ::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'telp' => $request->telp,
        'username' => $request->username,
        'password' => Hash::make($request->password)
        
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
            'nama' => 'required',                                  
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'             
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = Customers2_tabel::where('id_pelanggan', $id)->update([             
            'nama' => $request->nama,             
            'alamat' => $request->alamat,             
            'telp' => $request->telp,             
            'username' => $request->username,             
            'password' => $request->password       
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
        $hapus = Customers2_tabel::where('id_pelanggan', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    //untuk front end
    
    public function index()
    {
        $dt=customers2_tabel::get();
        return response()->json($dt); 
    }
    // public function cari_data($data_kunci)
    // {
    //     $dt=customers2_tabel::where('nama','like', '%'.$kata_kunci.'%')->get();
    //     return response()->json($dt);
    // }
    public function simpan(Request $req)
    {
        $validator=Validator::make($req->all(),         
        [                 
            'nama' => 'required',                                  
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'             
        ]); 

        if($validator->fails()) {             
            $data['status']=false;
            $data['message']=$validator->errors();   
            return Response()->json($data);     
        } 
        $simpan = customers2_tabel ::create([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'telp' => $req->telp,
            'username' => $req->username,
            'password' => Hash::make($req->password)
            
        ]);
        if($simpan){
            $data['status']=true;
            $data['message']="Sukses menambahkan pelanggan";
        } else {
            $data['status']=false;
            $data['message']="Gagal menambahkan pelanggan";
        }
        return Response()->json($data); 
    }
    public function getdetailpelanggan($id)
    {
        $detail = Customers2_tabel::where('id_pelanggan', $id)->first();
        return Response()->json($detail);
    }
    public function editpelanggan($id, Request $req)
    {
        $validator=Validator::make($req->all(),         
        [                 
            'nama' => 'required',                                  
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'           
        ]); 
        if($validator->fails()) {             
            $data['status']=false;
            $data['message']=$validator->errors();   
            return Response()->json($data);     
        } 
        $simpan = customers2_tabel ::where('id_pelanggan', $id)->update([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'telp' => $req->telp,
            'username' => $req->username,
            'password' => Hash::make($req->password)
            
        ]);
        if($simpan){
            $data['status']=true;
            $data['message']="Sukses update pelanggan";
        } else {
            $data['status']=false;
            $data['message']="Gagal update pelanggan";
        }
        return Response()->json($data);
    }
    public function hapuspelanggan($id)
    {
        $hapus = Customers2_tabel::where('id_pelanggan', $id)->delete();
        if($hapus){
            $data['status']=true;
            $data['message']="Sukses hapus pelanggan";
        } else {
            $data['status']=false;
            $data['message']="Gagal hapus pelanggan";
        }
        return Response()->json($data);
    }
}


