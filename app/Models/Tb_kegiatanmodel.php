<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_kegiatanmodel extends Model
{
    protected $table      = 'tb_kegiatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor','kegiatan','mulai','selesai','status','no_reg'];
}