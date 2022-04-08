<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_order2_tabel extends Model
{
    protected $table = 'detail_order2_tabel';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'id_produk', 'qty', 'subtotal'];
    use HasFactory;
}
