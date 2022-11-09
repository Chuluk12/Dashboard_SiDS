<?php

namespace App\Controllers;


class Login extends BaseController
{
public function index()
    {
        $session = session();
        $user = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $cek = $this->tb_usermodel1->where(array('username' => $user))->get()->getRowArray();
        

        if($cek)
        {
            $pass = $cek['pass'];
            $veryfi = md5($password,$pass);
            if ($veryfi)
            {
                session()->set('user', $cek['username']);
                session()->set('id_kar', $cek['id_karyawan']);
                session()->set('div', $cek['divisi']);
                session()->set('jab', $cek['jabatan']);
                session()->set('almt', $cek['alamat']);
                session()->set('tmp_lhr', $cek['tmp_lahir']);
                session()->set('tgl_lhr', $cek['tgl_lahir']);
                session()->set('email', $cek['email']);
                session()->set('telp', $cek['no_telp']);
                session()->set('nmlengkap', $cek['nm_user']);
                session()->set('level', $cek['kt_user']);
                session()->set('foto', $cek['foto']);
                $data =[
                        'nmlengkap' => $cek['nm_user']
                    ];
                if ($cek['kt_user']=='Admin')
                {
                    
                    return redirect()->to('/admin'); 
                }else{
                    return redirect()->to('/user');
                }

            }else{
                $session->setFlashdata('message', 'Password Salah');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('message', 'Username Tidak di temukan');
            return redirect()->to('/');
        }
    }    
public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}