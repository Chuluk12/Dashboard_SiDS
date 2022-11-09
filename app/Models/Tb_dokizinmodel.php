<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_dokizinmodel extends Model
{
    protected $table      = 'tb_dokizin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_izin', 'nm_izin', 'rilis_izin','kt_izin','tgl_izin','masa_berlaku','dokumen'];
}