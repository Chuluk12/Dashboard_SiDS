<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_patrolmodel extends Model
{
    protected $table      = 'tb_patrol';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor','tgl_patrol','tgl_target','lokasi','kategori','deskripsi_bahaya','jenis_bahaya','tindak_lanjut','keterangan','foto_awal','foto_akhir','status'];
}