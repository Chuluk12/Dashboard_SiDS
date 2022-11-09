<?php

namespace App\Models;

use CodeIgniter\Model;

class Tb_usermodel extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','jabatan','tmp_lahir','tgl_lahir','email','no_telp','foto','nm_user','divisi','kt_user','pass','id_karyawan','alamat'];
}