<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_promodel extends Model
{
    protected $table      = 'tb_program';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_reg','nm_reg','tipe_peserta','lama_pelaksanaan'];
}