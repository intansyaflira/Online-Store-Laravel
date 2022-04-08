<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers2_tabel extends Model
{
    protected $table = 'customers2_tabel';  // mengenalkan model
    public $timestamps = false; // membuat/mengisi data dalam kolom

    protected $fillable = ['nama', 'alamat', 'telp', 'username', 'password']; //mengintruksikan mana saja tabel yg boleh diisi
    use HasFactory;
}
