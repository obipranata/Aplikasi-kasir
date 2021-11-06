<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_penjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';
    protected $fillable = ['no_nota','kd_produk', 'harga_beli', 'qty'];
    public $timestamps = false;
}
