<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'no_nota',
        'tgl',
        'jam',
        'total_bayar',
        'tunai',
        'kembalian',
        'user_id'
    ];
    public $timestamps = false;
}
