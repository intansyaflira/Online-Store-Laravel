<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas_tabel extends Model
{
    protected $table = 'petugas_tabel';
    public $timestamps = false;

    protected $fillable = ['nama_petugas', 'username', 'password', 'level'];
    use HasFactory;
}
