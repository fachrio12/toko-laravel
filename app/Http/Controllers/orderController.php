<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class orderController extends Controller
{
    public function show(){
        $data = DB::table('order')
            ->join('customers', 'order.id_pelanggan', '=' , 'customers.id_pelanggan')
            ->join('produk', 'order.id_produk', '=' , 'produk.id_produk')
            ->select('order.id_transaksi',  'customers.id_pelanggan', 'produk.id_produk')
            ->get();
        return Response()->json($data);
    }

    public function detail($id){
        if(Order::where('id_transaksi', $id)->exists()){
            $data_order = DB::table('order')
            ->join('customers', 'order.id_pelanggan', '=' , 'customers.id_pelanggan')
            ->join('produk', 'order.id_produk', '=' , 'produk.id_produk')
            ->select('order.id_transaksi',  'customers.id_pelanggan', 'produk.id_produk')
            ->where('order.id_transaksi', '=', $id)
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
    'id_pelanggan' => 'required',
    'id_produk' => 'required'
    
    ]
    );
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
    $simpan = order::create([
    'id_pelanggan' => $request->id_pelanggan,
    'id_produk' => $request->id_produk
    
    
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
    'id_pelanggan' => 'required',
    'id_produk' => 'required'
    
    
    ]
    );
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
    $ubah = order::where('id_transaksi', $id)->update([
    'id_pelanggan' => $request->id_pelanggan,
    'id_produk' => $request->id_produk
   
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
    $hapus = order::where('id_transaksi', $id)->delete();
    if($hapus) {
    return Response()->json(['status' => 1]);
    }
    else {
    return Response()->json(['status' => 0]);
    }
    }

}
