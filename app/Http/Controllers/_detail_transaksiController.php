<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\_detail_transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class _detail_transaksiController extends Controller
{
    
    public function show()
    {
        $data = DB::table('_detail_transaksi')
            ->join('order', '_detail_transaksi.id_transaksi', '=', 'order.id_transaksi')
            ->join('produk', '_detail_transaksi.id_produk', '=', 'produk.id_produk')
            ->select('_detail_transaksi.id_detail_transaksi','order.id_transaksi',  'produk.nama_produk', '_detail_transaksi.qty', '_detail_transaksi.subtotal')
            ->get();
        return Response()->json($data);
    }
    
    public function detail($id){
        if(_detail_transaksi::where('id_detail_transaksi', $id)->exists()){
            $data_order = _detail_transaksi::where('_detail_transaksi.id_detail_transaksi', '=', $id)
            ->get();
            return Response()->json($data_order);
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
 
 $id_produk=$request->id_produk;
 $qty=$request->qty;
 $harga=DB::table('produk')->where('id_produk',$id_produk)->value('harga');
 $subtotal=$harga*$qty;
 
 
 $simpan = _detail_transaksi::create([
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

 public function update($id, Request $request)
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
 $id_produk=$request->id_produk;
 $qty=$request->qty;
 $harga=DB::table('produk')->where('id_produk',$id_produk)->value('harga');
 $subtotal=$harga*$qty;
 
 $ubah = _detail_transaksi::where('id_detail_transaksi', $id)->update([
 'id_transaksi' => $request->id_transaksi,
 'id_produk' => $request->id_produk,
 'qty' => $request->qty,
 'subtotal' => $subtotal
 
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
    $hapus = _detail_transaksi::where('id_detail_transaksi', $id)->delete();
    if($hapus) {
    return Response()->json(['status' => 1]);
    }
    else {
    return Response()->json(['status' => 0]);
    }
    }


}
