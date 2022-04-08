<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_tabel extends Model
{
    protected $table = 'product_tabel';
    public $timestamps = false;

    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'foto_produk'];
    use HasFactory;
}
