<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class produkController extends Controller
{
    public function show()
{
 return produk::all();
}
    
public function detail($id)
 {
 if(produk::where('id_produk', $id)->exists()) {
 $data = DB::table('produk')->where('produk.id_produk', '=', $id)->get();return Response()->json($data);
 }
 else {
 return Response()->json(['message' => 'Tidak ditemukan' ]);
 }
 }

    public function store(Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_produk' => 'required',
 'deskripsi' => 'required',
 'harga' => 'required'
 
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = produk::create([
 'nama_produk' => $request->nama_produk,
 'deskripsi' => $request->deskripsi,
 'harga' => $request->harga
 
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

 public function update($id, Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_produk' => 'required',
 'deskripsi' => 'required',
 'harga' => 'required'
 
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $ubah = produk::where('id_produk', $id)->update([
 'nama_produk' => $request->nama_produk,
 'deskripsi' => $request->deskripsi,
 'harga' => $request->harga
 
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
 $hapus = produk::where('id_produk', $id)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }


}
