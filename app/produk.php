<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table ='produk';
    public $timestamps =false;
    protected $primaryKey ='id_produk';

    protected $fillable =['nama_produk','deskripsi','harga'];
}
