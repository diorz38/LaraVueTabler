<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jafung extends Model
{

    protected $table = 'jafung';
    public $timestamps = false;

    protected $fillable = ['klasifikasi','no','unsur','sub_kode','sub_unsur','no_keg','uraian_kegiatan','output','angka_kredit','pelaksana','butir','deskripsi','batasan','bukti_fisik','contoh','flag','jafung'];
}
