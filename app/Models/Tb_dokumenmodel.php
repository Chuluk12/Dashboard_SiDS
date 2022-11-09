<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_dokumenmodel extends Model
{
    protected $table      = 'tb_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_dokumen','nm_dokumen','tgl_update','tgl_distribusi','revisi_dokumen','status','kt_dokumen','dokumen','pemilik'];
}