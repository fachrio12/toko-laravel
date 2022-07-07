<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table ='customers';
    public $timestamps =false;
    protected $primaryKey ='id_pelanggan';

    protected $fillable =['nama','alamat','telp','username','password'];
}
