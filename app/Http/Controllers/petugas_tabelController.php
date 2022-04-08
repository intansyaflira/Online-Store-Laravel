<?php

namespace App\Http\Controllers;
use App\Models\petugas_tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class petugas_tabelController extends Controller
{
    public function show()
    {
        return petugas_tabel::all();
    }
    public function detail($id)
    {
        if(petugas_tabel::where('id_petugas', $id)->exists()){
            $data = DB::table('petugas_tabel')->where('petugas_tabel.id_petugas', '=', $id)->get();
            return Response()->json($data);
        } else{
            return Response() ->json(['message' => 'Tidak ditemukan']);
        }
    }
    public function store(Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'
            
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = petugas_tabel ::create([
        'nama_petugas' => $request->nama_petugas,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'level' => $request->level
        
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
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'  
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = petugas_tabel::where('id_petugas', $id)->update([             
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level     
        ]); 

        if($ubah) {             
            return Response()->json(['status' => 1]);         
        }         
        else {             
            return Response()->json(['status' => 0]);         
        }     
    }
    public function destroy($id_petugas)
    {
        $hapus = petugas_tabel::where('id_petugas', $id_petugas)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
    }

        else {
            return Response()->json(['status' => 0]);
    }
    }
}
