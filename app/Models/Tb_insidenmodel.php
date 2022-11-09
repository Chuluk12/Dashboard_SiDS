<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_insidenmodel extends Model
{
    protected $table      = 'tb_insiden';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_insiden','tgl_insiden','lokasi','jenis_insiden','nm_pelapor','uraian','nm_terlapor','foto_insiden','status'];
}