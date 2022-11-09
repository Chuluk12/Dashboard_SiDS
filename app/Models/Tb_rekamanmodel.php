<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_rekamanmodel extends Model
{
    protected $table      = 'tb_rekaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_dok','nm_dok','kategori','lokasi','lama_simpan','cara_musnah','status','dokumen','pemilik'];
}