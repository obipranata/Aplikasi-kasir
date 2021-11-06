<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'kd_produk',
        'nama_produk',
        'harga',
        'stok',
        'kd_kategori',
    ];
    public $timestamps = false;
}
