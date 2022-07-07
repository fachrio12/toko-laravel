<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class _detail_transaksi extends Model
{
    protected $table ='_detail_transaksi';
    public $timestamps =false;
    protected $primaryKey ='id_detail_transaksi';

    protected $fillable =['id_transaksi','id_produk','qty','subtotal'];
}
