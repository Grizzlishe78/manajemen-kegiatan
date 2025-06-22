<?php
// app/Models/Kegiatan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
       protected $fillable = ['nama', 'tgl_pelaksanaan', 'organisasi_id', 'nama_lokasi'];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
    public function panitia()
    {
        return $this->belongsToMany(Anggota::class, 'kepanitiaan')->withPivot('jabatan')->withTimestamps();
    }
}