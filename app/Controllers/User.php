<?php

namespace App\Controllers;


class User extends BaseController
{
    public function index()
    {
        $doksids = $this->tb_dokumenmodel1->countAll();
        $izin = $this->tb_dokizinmodel1->countAll();
        $apd = $this->tb_apdmodel1->countAll();
        $pengguna = $this->tb_usermodel1->countAll();
        $program = $this->tb_promodel1->countAll();
        $kegiatan = $this->tb_kegiatanmodel1->countAll();
        $rekaman = $this->tb_rekamanmodel1->countAll();
        $patrol = $this->tb_patrolmodel1->countAll();
        $insiden = $this->Tb_insidenmodel1->countAll();
        $data = [
            'title' => 'Dashboard',
            'doksids' => $doksids,
            'izin' => $izin,
            'apd' => $apd,
            'pengguna' => $pengguna,
            'program'=> $program,
            'kegiatan'=> $kegiatan,
            'rekaman' => $rekaman,
            'patrol' => $patrol,
            'insiden' => $insiden,
        ];
        return view('/user/index',$data);
    }

public function dokumen()
    {
        $dokumen1 = $this->tb_dokumenmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Dokumen Standar'
        ];
        
        return view('/user/dokumen',$data);
    }       
    
public function rekaman()
    {
        $dokumen1 = $this->tb_rekamanmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Dokumen Rekaman'
        ];
        
        return view('/user/rekaman',$data);
    }

public function kegiatan()
    {
        $dokumen1 = $this->tb_kegiatanmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Data Program Pelatihan'
        ];
        
        return view('/user/kegiatan',$data);
    }

public function tampilfile(){
            $file = $this->request->getVar('file');
            $data=[
                'file' => $file
            ];
            return view('/user/tampilfile',$data);
        }    
        
public function perizinan()
        {
            $dokumen1 = $this->tb_dokizinmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Daftar Dokumen Perizinan & Non Perizinan',
            'title' => ' Dokumen Perizinan'
        ];
        
        return view('/user/perizinan',$data);
        }

public function patrol()
        {
            $dokumen1 = $this->tb_patrolmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Daftar Rekaman Patrol',
            'title' => 'Data Rekaman Patrol'
        ];
        
        return view('user/patrol',$data);
        }

public function profile()
        {
            $dokumen1 = $this->tb_usermodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Profile Pengguna',
            'title' => 'Profile'
        ];
        
        return view('user/profile',$data);
        }
        
public function apd()
        {
            $dokumen1 = $this->tb_apdmodel1->findAll();
            $data = [
                'dokumen' => $dokumen1,
                'title' => 'Alat Pelindung Diri (APD)'
            ];
            
            return view('/user/apd',$data);
        }
}
