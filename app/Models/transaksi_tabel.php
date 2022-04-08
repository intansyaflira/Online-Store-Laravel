<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_tabel extends Model
{
    protected $table = 'transaksi_tabel';
    public $timestamps = false;

    protected $fillable = ['id_pelanggan', 'id_petugas', 'tgl_transaksi'];
    use HasFactory;
}
