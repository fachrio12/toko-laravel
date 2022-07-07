<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table ='order';
    public $timestamps =false;
    protected $primaryKey ='id_transaksi';

    protected $fillable =['tgl_transaksi','grandtotal']; 
}
