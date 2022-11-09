<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_apdmodel extends Model
{
    protected $table      = 'tb_apd';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_apd','jenis_apd','nm_apd','spesifikasi','user_apd','area_apd','foto_apd'];
}