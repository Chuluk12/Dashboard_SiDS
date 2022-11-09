<?php

namespace App\Controllers;


class Admin extends BaseController
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
        return view('admin/index',$data);
}


// Awal Insiden //

 public function insiden()
        {
            $dokumen1 = $this->tb_insidenmodel1->findAll();
        $data = [
            'insiden' => $dokumen1,
            'judul' => 'Daftar Rekaman Insiden',
            'title' => 'Daftar Rekaman Insiden'
        ];
        
        return view('admin/insiden',$data);
        }    

public function formaddinsiden()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdinsiden')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }


// Akhir Insiden //

// Awal Patrol //

public function patrol()
        {
            $dokumen1 = $this->tb_patrolmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Daftar Rekaman Patrol',
            'title' => 'Data Rekaman Patrol'
        ];
        
        return view('admin/patrol',$data);
        }

public function formaddpat()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdpat')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddpatrolmodal()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_pat' => [
                        'rules' =>'required|is_unique[tb_patrol.nomor]',
                        'errors' => [
                            'required' =>'No. Patrol Harus Diisi',
                            'is_unique' => 'No. Patrol Sudah Ada'
                        ]
                        ],
                    'plh_lok' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Lokasi Temuan Harus Diisi'
                        ]
                        ],
                    'plh_ktg' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Kategori Temuan Harus Diisi'
                        ]
                        ],
                    'plh_stat' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Status Temuan Harus Diisi'
                        ]
                    ],
                    'plh_bhy' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Jenis Bahaya Harus Diisi'
                        ]
                    ],
                    'tgl_pat' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Temuan Harus Diisi'
                        ]
                    ],
                  'tgl_tar' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Target Penyelesaian Harus Diisi'
                        ]
                    ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Kondisi Temuan Harus Diisi'
                        ]
                    ],
                    'tindakan' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tindakan Harus Diisi'
                        ]
                    ],
                    'ft_awal' => [
                                'rules' =>'uploaded[ft_awal]|is_image[ft_awal]|max_size[ft_awal,1048]|mime_in[ft_awal,image/png,image/jpg,image/jpeg]',
                                'errors' => [
                                    'uploaded' => 'Foto Temuan Harus diisi',
                                    'max_size' =>'Ukuran Foto Lebih Dari 1Mb',
                                    'mime_in' =>'Hanya Bisa .jpg dan .png',
                                    'is_image' =>'Hanya Gambar',
                                    ]
                                ],         
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'plh_lok' => $validation->getError('plh_lok'),
                            'plh_kt' => $validation->getError('plh_ktg'),
                            'plh_sts' => $validation->getError('plh_stat'),
                            'plh_bhy' => $validation->getError('plh_bhy'),   
                            'no_pat' => $validation->getError('no_pat'),
                            'deskripsi' => $validation->getError('deskripsi'),
                            'tindakan' => $validation->getError('tindakan'),                            
                            'tgl_pat' => $validation->getError('tgl_pat'),
                            'tgl_tar' => $validation->getError('tgl_tar'),
                            'ft_awal' => $validation->getError('ft_awal')
                            ]
                    ];
                }else{
                    $filedokumen = $this->request->getFile('ft_awal');
                    $filedokumen ->move('ft_awal');
                    $namadokumen = $filedokumen ->getName();
                                              
                    $simpanpatrol =[
                        'lokasi' => $this->request->getVar('plh_lok'),
                        'kategori' => $this->request->getVar('plh_ktg'),
                        'status' => $this->request->getVar('plh_stat'),
                        'jenis_bahaya' => $this->request->getVar('plh_bhy'),
                        'nomor'  => $this->request->getVar('no_pat'),
                        'deskripsi_bahaya'  => $this->request->getVar('deskripsi'),    
                        'tindak_lanjut' => $this->request->getVar('tindakan'),
                        'tgl_patrol' => $this->request->getVar('tgl_pat'),
                        'tgl_target' => $this->request->getVar('tgl_tar'),
                        'foto_awal' => $namadokumen    
                        ];
                        $this->tb_patrolmodel1->insert($simpanpatrol);
                        $msg = [
                            'message' => 'Data Temuan Patrol berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);
            }
        }

public function editpat() 
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_patrolmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'nomor' => $row['nomor'],
                    'deskripsi_bahaya' => $row['deskripsi_bahaya'],
                    'keterangan' => $row['keterangan'],
                    'tgl_target' => $row['tgl_target'],
                    'status' => $row['status'],
                    'foto_akhir' => $row['foto_akhir']
                ];

                $msg = [
                    'message' => view('/admin/modaleditpat',$data)
                ];
                echo json_encode($msg);
            }
        }

public function simpaneditpat()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Temuan Harus Diisi'
                        ]
                        ],
                     'plh_stat' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Status Temuan Harus Diisi'
                        ]
                        ],
                    'tgl_tar' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Penyelesaian Harus Diisi'
                        ]
                        ],
                    'foto_akhir' => [
                        'rules' =>'uploaded[ft_akhir]|is_image[ft_akhir]|max_size[ft_akhir,1048]|mime_in[ft_akhir,image/png,image/jpg,image/jpeg]',
                                'errors' => [
                                    'uploaded' => 'Foto Temuan Harus diisi',
                                    'max_size' =>'Ukuran Foto Lebih Dari 1Mb',
                                    'mime_in' =>'Hanya Bisa .jpg dan .png',
                                    'is_image' =>'Hanya Gambar',
                                    ]
                ],
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'deskripsi' => $validation->getError('deskripsi'),
                            'desk' => $validation->getError('desk'),
                            'tgl_tar' => $validation->getError('tgl_tar'),
                            'plh_stat' => $validation->getError('plh_stat'),
                            'ft_akhir' => $validation->getError('ft_akhir')
                            ]
                    ];
            }else{
                    $filedokumen = $this->request->getFile('ft_akhir');
                    $filedokumen ->move('ft_akhir');
                    $namadokumen = $filedokumen ->getName();
                    $id = $this->request->getVar('id');

                    $updatepat =[
                        'keterangan'  => $this->request->getVar('deskripsi'),
                        'deskripsi_bahaya' => $this->request->getVar('desk'),
                        'tgl_target' => $this->request->getVar('tgl_tar'),
                        'status' => $this->request->getvar('plh_stat'),
                        'foto_akhir' => $namadokumen    
                        ];
                        $this->tb_patrolmodel1->update($id, $updatepat);
                        $msg = [
                            'message' => 'Data Patrol Berhasil Diperbarui'
                        ];
                }
                echo json_encode($msg);
            }
        }

 public function hapuspat()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_patrolmodel1->delete($id);

                $msg = [
                    'message' => 'Rekaman Patrol berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
    }

// Akhir Patrol //

// Awal Rekaman //

 public function rekaman()
        {
            $dokumen1 = $this->tb_rekamanmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Daftar Dokumen Rekaman',
            'title' => 'Dokumen Rekaman'
        ];
        
        return view('admin/rekaman',$data);
        }

public function formaddrekmodal()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdrek')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddrekmodal()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_dok' => [
                        'rules' =>'required|is_unique[tb_rekaman.no_dok]',
                        'errors' => [
                            'required' =>'No. Dokumen Harus Diisi',
                            'is_unique' => 'No. Dokumen Sudah Ada'
                        ]
                        ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Dokumen Harus Diisi'
                        ]
                        ],
                    'pilih_kt' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Kategori Dokumen Harus Diisi'
                        ]
                        ],
                    'pilih_cara' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Pemusnahan Distribusi Harus Diisi'
                        ]
                        ],
                    'pilih_status' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Status Dokumen Harus Diisi'
                        ]
                    ],
                    'lama_simpan' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Lama Penyimpanan Dokumen Harus Diisi'
                        ]
                    ],
                    'lokasi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Lokasi Penyimpanan Dokumen Harus Diisi'
                        ]
                    ],    
                    'dokumen' => [
                        'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[dokumen,2054]',
                        'errors' => [
                            'uploaded' =>'File Dokumen Harus Diisi',
                            'mime_in' =>'Tipe Dokumen Harus Pdf / Word / Excel',
                            'max_size' => 'Maksimal Size Dokumen 2 Mb'
                        ]
                    ]
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'no_dok' => $validation->getError('no_dok'),
                            'deskripsi' => $validation->getError('deskripsi'),
                            'lokasi' => $validation->getError('lokasi'),
                            'lama_simpan' => $validation->getError('lama_simpan'),
                            'pilih_kt' => $validation->getError('pilih_kt'),
                            'pilih_status' => $validation->getError('pilih_status'),
                            'pilih_cara' => $validation->getError('pilih_cara'),
                            'dokumen' => $validation->getError('dokumen')
                            ]
                    ];
                }else{
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();
                                                
                    $simpanrekaman =[
                        'no_dok'  => $this->request->getVar('no_dok'),
                        'nm_dok'  => $this->request->getVar('deskripsi'),
                        'lokasi' => $this->request->getVar('lokasi'),
                        'lama_simpan' => $this->request->getVar('lama_simpan'),
                        'kategori' => $this->request->getVar('pilih_kt'),
                        'cara_musnah' => $this->request->getVar('pilih_cara'),
                        'status' => $this->request->getVar('pilih_status'),
                        'dokumen' => $namadokumen    
                        ];
                        $this->tb_rekamanmodel1->insert($simpanrekaman);
                        $msg = [
                            'message' => 'Data Dokumen berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);
            }
        }

public function editrek() 
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_rekamanmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'no_dok' => $row['no_dok'],
                    'nm_dok' => $row['nm_dok'],
                    'pilih_kt' => $row['kategori'],
                    'lokasi' => $row['lokasi'],
                    'lama_simpan' => $row['lama_simpan'],
                    'pilih_cara' => $row['cara_musnah'],
                    'pilih_status' => $row['status'],
                    'dokumen' => $row['dokumen']
                ];

                $msg = [
                    'message' => view('/admin/modaleditrek',$data)
                ];
                echo json_encode($msg);
            }
        }

public function editdokrek($id)
        {
            $edit = $this->tb_rekamanmodel1->where(['id' => $id])->first();
            $data = [            
                'title' => 'Edit Dokumen',
                'validation' => \Config\Services::validation(),
                'id' => $edit
                ];
                return view('admin/formeditrek',$data);
}

public function simpaneditrek()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Dokumen Harus Diisi'
                        ]
                        ],
                    'lokasi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Lokasi Simpan Dokumen Harus Diisi'
                        ]
                        ],
                    'lama_simpan' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Masa Simpan Dokumen Harus Diisi'
                        ]
                        ],
                    'dokumen' => [
                        'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[dokumen,2054]',
                        'errors' => [
                            'uploaded' =>'File Dokumen Harus Diisi',
                            'mime_in' =>'Tipe Dokumen Harus Pdf / Word / Excel',
                            'max_size' => 'Maksimal Size Dokumen 2 Mb'
                        ]
                    ]
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'deskripsi' => $validation->getError('deskripsi'),
                            'lama_simpan' => $validation->getError('lama_simpan'),
                            'lokasi' => $validation->getError('lokasi'),
                            'dokumen' => $validation->getError('dokumen')
                            ]
                    ];

            }else{
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();
                    $id = $this->request->getVar('id');

                    $updaterekaman =[
                        'nm_dok'  => $this->request->getVar('deskripsi'),
                        'lokasi' => $this->request->getVar('lokasi'),
                        'lama_simpan' => $this->request->getVar('lama_simpan'),
                        'dokumen' => $namadokumen    
                        ];
                        $this->tb_rekamanmodel1->update($id, $updaterekaman);
                        $msg = [
                            'message' => 'Data Dokumen Rekaman Berhasil Diperbarui'
                        ];
                }
                echo json_encode($msg);
            }
        }

 public function hapusrek()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_rekamanmodel1->delete($id);

                $msg = [
                    'message' => 'Rekaman Dokumen berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
    }

// Akhir Rekaman //

// Akhir Kegiatan/Pelatihan //

public function kegiatan()
    {
        $dokumen1 = $this->tb_kegiatanmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Data Program Pelatihan'
        ];
        
        return view('admin/kegiatan',$data);
    }

public function formaddpel()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdpel')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddpel()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'nomor' => [
                'rules' =>'required|is_unique[tb_kegiatan.nomor]',
                'errors' => [
                    'required' =>'Nomor Kegiatan Harus Diisi',
                    'is_unique' => 'Nomor Kegiatan Sudah Ada'
                ]
                ],
            'kegiatan' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Deskripsi Kegiatan Harus Diisi'
                ]
                ],
            'mulai' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Tanggal Mulai Harus Diisi'
                ]
                ],
            'selesai' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Tanggal Selesai Harus Diisi'
                ]
                ],
            'no_reg' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'No. Program Harus Diisi'
                ]
                ],
            'status' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Status Harus Diisi'
                ]
                ]
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'nomor' => $validation->getError('nomor'),
                            'kegiatan' => $validation->getError('kegiatan'),
                            'mulai' => $validation->getError('mulai'),
                            'selesai' => $validation->getError('selesai'),
                            'no_reg' => $validation->getError('no_reg'),
                            'status' => $validation->getError('status')
                            ]
                    ];
                }else{
                    $simpanpelatihan =[
                        'nomor'  => $this->request->getVar('nomor'),
                        'kegiatan'  => $this->request->getVar('kegiatan'),
                        'mulai' => $this->request->getVar('mulai'),
                        'selesai' => $this->request->getVar('selesai'),
                        'no_reg' => $this->request->getVar('no_reg'),    
                        'status' => $this->request->getVar('status')    
                        ];
                        $this->tb_kegiatanmodel1->insert($simpanpelatihan);
                        $msg = [
                            'message' => 'Data Pelatihan berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);
            }
        }
        
public function editkegiatan()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_kegiatanmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'nomor' => $row['nomor'],
                    'kegiatan' => $row['kegiatan'],
                    'mulai' => $row['mulai'],
                    'selesai' => $row['selesai'],
                    'no_reg' => $row['no_reg'],
                    'status' => $row['status']
                ];

                $msg = [
                    'message' => view('/admin/modaleditpel',$data)
                ];
                echo json_encode($msg);
            }
        }

public function editpel($id)
        {
            $edit = $this->tb_kegiatanmodel1->where(['id' => $id])->first();
            $data = [            
                'title' => 'Edit Dokumen',
                'validation' => \Config\Services::validation(),
                'id' => $edit
                ];
                return view('admin/editpel',$data);
        }

public function simpaneditpel()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
            'kegiatan' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Deskripsi Kegiatan Harus Diisi'
                ]
                ],
            'mulai' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Tanggal Mulai Harus Diisi'
                ]
                ],
            'selesai' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Tanggal Selesai Harus Diisi'
                ]
                ],
            'status' => [
                'rules' =>'required',
                'errors' => [
                    'required' =>'Status Harus Diisi'
                ]
                ]
            ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'nomor' => $validation->getError('nomor'),
                            'kegiatan' => $validation->getError('kegiatan'),
                            'mulai' => $validation->getError('mulai'),
                            'selesai' => $validation->getError('selesai'),
                            'status' => $validation->getError('status')
                            ]
                    ];
            } else {
                    $id = $this->request->getVar('id');

                    $updatepelatihan =[
                        'nomor'  => $this->request->getVar('nomor'),
                        'kegiatan'  => $this->request->getVar('kegiatan'),
                        'mulai' => $this->request->getVar('mulai'),
                        'selesai' => $this->request->getVar('selesai'),   
                        'status' => $this->request->getVar('status')    
                        ];
                        $this->tb_kegiatanmodel1->update($id, $updatepelatihan);
                        $msg = [
                            'message' => 'Data Perizinan berhasil di diubah'
                        ];

                }
                echo json_encode($msg);
            }
        }

public function hapuskegiatan()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_kegiatanmodel1->delete($id);

                $msg = [
                    'message' => 'Agenda Kegiatan berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
    }


// Akhir Kegiatan/Pelatihan //

// Awal Dokumen Standar //

public function dokumen()
    {
        $dokumen1 = $this->tb_dokumenmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Dokumen Standar'
        ];
        
        return view('admin/dokumen',$data);
    }

public function formadddokmodal()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladddok')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }
        
public function simpanadddokmodal()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_dok' => [
                        'rules' =>'required|is_unique[tb_dokumen.kd_dokumen]',
                        'errors' => [
                            'required' =>'Kode Dokumen Harus Diisi',
                            'is_unique' => 'Kode Dokumen Sudah Ada'
                        ]
                        ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Dokumen Harus Diisi'
                        ]
                        ],
                    'tgl' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Dokumen Harus Diisi'
                        ]
                        ],
                    'tgl_dis' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Distribusi Harus Diisi'
                        ]
                        ],
                    'pilih_kt' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Kategori Dokumen Harus Diisi'
                        ]
                    ],
                    'pilih_status' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Status Dokumen Harus Diisi'
                        ]
                    ],
                    'pemilik' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Pemilik Dokumen Harus Diisi'
                        ]
                    ],    
                    'dokumen' => [
                        'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[dokumen,2054]',
                        'errors' => [
                            'uploaded' =>'File Dokumen Harus Diisi',
                            'mime_in' =>'Tipe Dokumen Harus Pdf / Word / Excel',
                            'max_size' => 'Maksimal Size Dokumen 2 Mb'
                        ]
                    ]
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'no_dok' => $validation->getError('no_dok'),
                            'deskripsi' => $validation->getError('deskripsi'),
                            'tgl' => $validation->getError('tgl'),
                            'tgl_dis' => $validation->getError('tgl_dis'),
                            'pilih_kt' => $validation->getError('pilih_kt'),
                            'pemilik' => $validation->getError('pemilik'),
                            'pilih_status' => $validation->getError('pilih_status'),
                            'dokumen' => $validation->getError('dokumen')
                            ]
                    ];
                }else{
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();
                    $revisi     = 0;                            
                    $simpandokumen =[
                        'kd_dokumen'  => $this->request->getVar('no_dok'),
                        'nm_dokumen'  => $this->request->getVar('deskripsi'),
                        'revisi_dokumen' => $revisi,
                        'tgl_update' => $this->request->getVar('tgl'),
                        'tgl_distribusi' => $this->request->getVar('tgl_dis'),
                        'kt_dokumen' => $this->request->getVar('pilih_kt'),
                        'pemilik' => $this->request->getVar('pemilik'),
                        'status' => $this->request->getVar('pilih_status'),
                        'dokumen' => $namadokumen    
                        ];
                        $this->tb_dokumenmodel1->insert($simpandokumen);
                        $msg = [
                            'message' => 'Data Dokumen berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);
            }
        }

public function editdok()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_dokumenmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'kd_dokumen' => $row['kd_dokumen'],
                    'nm_dokumen' => $row['nm_dokumen'],
                    'revisi_dokumen' => $row['revisi_dokumen'],
                    'tgl_update' => $row['tgl_update'],
                    'tgl_dis' => $row['tgl_distribusi'],
                    'kt_dokumen' => $row['kt_dokumen'],
                    'pemilik' => $row['pemilik'],
                    'dokumen' => $row['dokumen']
                ];

                $msg = [
                    'message' => view('/admin/modaleditdok',$data)
                ];
                echo json_encode($msg);
            }
        }

public function editdokumen($id)
        {
            $edit = $this->tb_dokumenmodel1->where(['id' => $id])->first();
            $data = [            
                'title' => 'Edit Dokumen',
                'validation' => \Config\Services::validation(),
                'id' => $edit
                ];
                return view('admin/formedit',$data);
    }

public function simpaneditdokumen()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                'deskripsi' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' =>'Deskripsi Dokumen Harus Diisi'
                    ]
                    ],
                'tgl' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' =>'Tanggal Dokumen Harus Diisi'
                    ]
                    ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf]|max_size[dokumen,2054]',
                    'errors' => [
                        'uploaded' =>'File Dokumen Harus Diisi',
                        'mime_in' =>'Tipe Dokumen Harus Pdf',
                        'max_size' => 'Maksimal Size Dokumen 2 Mb'
                    ]
                    ]
            ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'deskripsi' => $validation->getError('deskripsi'),
                            'tgl' => $validation->getError('tgl'),
                            'dokumen' => $validation->getError('dokumen')
                            ]
                    ];
            } else {
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();
                    $revisi     = $this->request->getVar('revisi') + 1;
                    $id = $this->request->getVar('id');
                    // $findid = $this->tb_dokumenmodel1->where(['id' => $id])->first();
                    
                    $updatedokumen =[
                        'nm_dokumen'  => $this->request->getVar('deskripsi'),
                        'revisi_dokumen' => $revisi,
                        'tgl_update' => $this->request->getVar('tgl'),
                        'dokumen' => $namadokumen    
                    ];

                        $this->tb_dokumenmodel1->update($id,$updatedokumen);
                        $msg = [
                            'message' => 'Data Dokumend berhasil di Ubah'
                        ];
                }
                echo json_encode($msg);
            }
        }
        
public function hapusdok()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_dokumenmodel1->delete($id);

                $msg = [
                    'message' => 'Dokumen berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
    }

// Akhir Dokumen Standar //

// Awal Perizinan //

public function perizinan()
        {
            $dokumen1 = $this->tb_dokizinmodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Daftar Dokumen Perizinan & Non Perizinan',
            'title' => ' Dokumen Perizinan & Non Perizinan'
        ];
        
        return view('admin/perizinan',$data);
        }

public function formaddizin()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdizin')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddizin()
        {
            if ($this->request->isAJAX()){
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_izin' => [
                        'rules' =>'required|is_unique[tb_dokizin.no_izin]',
                        'errors' => [
                            'required' =>'No. Perizinan Harus Diisi',
                            'is_unique' => 'No. Perizinan Sudah Ada'
                        ]
                        ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Perizinan Harus Diisi'
                        ]
                        ],
                    'penerbit' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Penerbit Perizinan Harus Diisi'
                        ]
                        ],
                    'tgl' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Perizinan Harus Diisi'
                        ]
                        ],
                    'tgl_masa' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Masa Berlaku Harus Diisi'
                        ]
                        ],
                    'pilih_kt' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Kategori Perizinan Harus Diisi'
                        ]
                    ],    
                    'dokumen' => [
                        'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf]|max_size[dokumen,2054]',
                        'errors' => [
                            'uploaded' =>'File Dokumen Harus Diisi',
                            'mime_in' =>'Tipe Dokumen Harus Pdf',
                            'max_size' => 'Maksimal Size Dokumen 2 Mb'
                        ]
                    ]
                ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'no_izin' => $validation->getError('no_izin'),
                            'deskripsi' => $validation->getError('deskripsi'),
                            'penerbit' => $validation->getError('penerbit'),
                            'tgl' => $validation->getError('tgl'),
                            'tgl_masa' => $validation->getError('tgl_masa'),
                            'pilih_kt' => $validation->getError('pilih_kt'),
                            'dokumen' => $validation->getError('dokumen')
                            ]
                    ];
                }else{
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();                         
                    $simpandokizin =[
                        'no_izin'  => $this->request->getVar('no_izin'),
                        'nm_izin'  => $this->request->getVar('deskripsi'),
                        'rilis_izin' => $this->request->getVar('penerbit'),
                        'kt_izin' => $this->request->getVar('pilih_kt'),
                        'tgl_izin' => $this->request->getVar('tgl'),
                        'masa_berlaku' => $this->request->getVar('tgl_masa'),
                        'dokumen' => $namadokumen    
                        ];
                        $this->tb_dokizinmodel1->insert($simpandokizin);
                        $msg = [
                            'message' => 'Data Perizinan berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);
            }
        }

public function editizin()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_dokizinmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'no_izin' => $row['no_izin'],
                    'nm_izin' => $row['nm_izin'],
                    'rilis_izin' => $row['rilis_izin'],
                    'kt_izin' => $row['kt_izin'],
                    'tgl_izin' => $row['tgl_izin'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'dokumen' => $row['dokumen']
                ];

                $msg = [
                    'message' => view('/admin/modaleditizind',$data)
                ];
                echo json_encode($msg);
            }
        }

public function simpaneditizin()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                'no_izin' => [
                        'rules' =>'required',
                        'errors' =>[ 
                            'required' =>'Kode Perizinan Harus Diisi',
                            'is_unique' => 'Kode Perizinan Sudah Ada'
                        ]
                        ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi Perizinan Harus Diisi'
                        ]
                        ],
                    'penerbit' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Penerbit Perizinan Harus Diisi'
                        ]
                        ],
                    'tgl' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Dokumen Harus Diisi'
                        ]
                        ],
                    'tgl_masa' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Masa Berlaku Harus Diisi'
                        ]
                        ],
                      
                    'dokumen' => [
                        'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf]|max_size[dokumen,2054]',
                        'errors' => [
                            'uploaded' =>'File Dokumen Harus Diisi',
                            'mime_in' =>'Tipe Dokumen Harus Pdf',
                            'max_size' => 'Maksimal Size Dokumen 2 Mb'
                        ]
                    ]
            ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'no_izin' => $validation->getError('no_izin'),
                            'deskripsi' => $validation->getError('deskripsi'),
                            'penerbit' => $validation->getError('penerbit'),
                            'tgl' => $validation->getError('tgl'),
                            'tgl_masa' => $validation->getError('tgl_masa'),
                            'pilih_kt' => $validation->getError('pilih_kt'),
                            'dokumen' => $validation->getError('dokumen'),
                            ]
                    ];
            } else {
                    $filedokumen = $this->request->getFile('dokumen');
                    $filedokumen ->move('dokumen');
                    $namadokumen = $filedokumen ->getName();
                    $id = $this->request->getVar('id');


                    $updateizin = [
                        'no_izin'  => $this->request->getVar('no_izin'),
                        'nm_izin'  => $this->request->getVar('deskripsi'),
                        'rilis_izin' => $this->request->getVar('penerbit'),
                        'tgl_izin' => $this->request->getVar('tgl'),
                        'masa_berlaku' => $this->request->getVar('tgl_masa'),
                        'dokumen' => $namadokumen    
                        ];
                        $this->tb_dokizinmodel1->update($id , $updateizin);
                        $msg = [
                            'message' => 'Data Perizinan berhasil di diubah'
                        ];

                }
                echo json_encode($msg);
            }
        }

public function hapusizin()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_dokizinmodel1->delete($id);

                $msg = [
                    'message' => 'Dokumen berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
        }

// Akhir Perizinan //

// Awal APD //

public function apd()
        {
            $dokumen1 = $this->tb_apdmodel1->findAll();
            $data = [
                'dokumen' => $dokumen1,
                'title' => 'Alat Pelindung Diri (APD)'
            ];
            
            return view('/admin/apd',$data);
        }

public function formaddapdmodal()
        {
            if ($this->request->isAJAX()){                
                
                $msg = [
                    'data' => view('admin/modaladdapd')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddapdmodal()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_apd' => [
                        'rules' =>'required|is_unique[tb_apd.no_apd]',
                        'errors' => [
                            'required' =>'Nomor APD Harus Diisi',
                        ]
                        ],
                    'jenis_apd' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Jenis APD Harus Diisi',                            
                        ]
                        ],
                        'nm_apd' => [
                            'rules' =>'required',
                            'errors' => [
                                'required' =>'Deskripsi Harus Diisi'
                                ]
                            ],
                            'foto_apd' => [
                                'rules' =>'uploaded[foto_apd]|is_image[foto_apd]|max_size[foto_apd,1048]|mime_in[foto_apd,image/png,image/jpg,image/jpeg]',
                                'errors' => [
                                    'uploaded' => 'Foto APD Harus diisi',
                                    'max_size' =>'Ukuran Foto Lebih Dari 1Mb',
                                    'mime_in' =>'Hanya Bisa .jpg dan .png',
                                    'is_image' =>'Hanya Gambar',
                                    ]
                                ]                            
                ]); 
                if(!$valid){
                    $msg = [
                        'error' => [
                            'no_apd' => $validation->getError('no_apd'),
                            'jenis_apd' => $validation->getError('jenis_apd'),
                            'nm_apd' => $validation->getError('nm_apd'),
                            'foto_apd' => $validation->getError('foto_apd')
                        ]
                    ];   
                }else{
                        $foto = $this->request->getFile('foto_apd');
                        $foto ->move('fotoapd');
                        $namafoto = $foto ->getName();                        
                        
                        $simpanapd = [
                            'no_apd' => $this->request->getVar('no_apd'), 
                            'jenis_apd' => $this->request->getVar('jenis_apd'),
                            'nm_apd' => $this->request->getVar('nm_apd'),
                            'user_apd' => $this->request->getVar('pengguna'),
                            'area_apd' => $this->request->getVar('area'),
                            'foto_apd' => $namafoto
                    ];
                   
                    
                    $this->tb_apdmodel1->insert($simpanapd);
                   $msg = [
                    'message' => 'Data APD berhasil di simpan'
                   ];
                }
                echo json_encode($msg);   
            }else{
                exit('Maaf tidak dapat diproses');
            }        
        }

public function fotoapd()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_apdmodel1->find($id);

                $data= [
                    'nm_apd' => $row['nm_apd'],
                    'foto_apd' => $row['foto_apd']                    
                ];

                $msg = [
                    'message' => view('/admin/modalfotoapd',$data)
                ];
                echo json_encode($msg);
            }
        }

public function editapd()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_apdmodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'no_apd' => $row['no_apd'],
                    'jenis_apd' => $row['jenis_apd'],
                    'nm_apd' => $row['nm_apd'],
                    'user_apd' => $row['user_apd'],
                    'area_apd' => $row['area_apd'],
                    'foto_apd' => $row['foto_apd']                    
                ];

                $msg = [
                    'message' => view('/admin/modaleditapd',$data)
                ];
                echo json_encode($msg);
            }
        }

public function simpaneditapdmodal()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_apd' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Nomor APD Harus Diisi',
                        ]
                        ],
                    'jenis_apd' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Jenis APD Harus Diisi',                            
                        ]
                        ],
                        'nm_apd' => [
                            'rules' =>'required',
                            'errors' => [
                                'required' =>'Deskripsi Harus Diisi'
                                ]
                            ],
                            'foto_apd' => [
                                'rules' =>'is_image[foto_apd]|max_size[foto_apd,1048]|mime_in[foto_apd,image/png,image/jpg,image/jpeg]',
                                'errors' => [                                    
                                    'max_size' =>'Ukuran Foto Lebih Dari 1Mb',
                                    'mime_in' =>'Hanya Bisa .jpg dan .png',
                                    'is_image' =>'Hanya Gambar',
                                    ]
                                ]                            
                ]); 
                if(!$valid){
                    $msg = [
                        'error' => [
                            'no_apd' => $validation->getError('no_apd'),
                            'jenis_apd' => $validation->getError('jenis_apd'),
                            'nm_apd' => $validation->getError('nm_apd'),
                            'foto_apd' => $validation->getError('foto_apd')
                        ]
                    ];   
                }else{
                        $foto = $this->request->getFile('foto_apd');
                        if($foto == "")
                        {
                            $potolama = $this->request->getVar('fotolama');
                            $id = $this->request->getVar('id');
                            // $findid = $this->tb_apdmodel1->where(['id' => $id])->first();

                            $updateapd = [
                                'no_apd' => $this->request->getVar('no_apd'), 
                                'jenis_apd' => $this->request->getVar('jenis_apd'),
                                'nm_apd' => $this->request->getVar('nm_apd'),
                                'user_apd' => $this->request->getVar('pengguna'),
                                'area_apd' => $this->request->getVar('area'),
                                'foto_apd' => $potolama
                        ];
                        } else {
                        $potolama = $this->request->getVar('foto_lama');
                        $foto ->move('fotoapd');
                        $namafoto = $foto ->getName();                        
                        $id = $this->request->getVar('id');

                        $updateapd = [
                            'no_apd' => $this->request->getVar('no_apd'), 
                            'jenis_apd' => $this->request->getVar('jenis_apd'),
                            'nm_apd' => $this->request->getVar('nm_apd'),
                            'user_apd' => $this->request->getVar('pengguna'),
                            'area_apd' => $this->request->getVar('area'),
                            'foto_apd' => $namafoto
                    ];
                    }
                    $this->tb_apdmodel1->update($id, $updateapd);
                   $msg = [
                    'message' => 'Data APD berhasil di ubah'
                   ];
                }
                echo json_encode($msg);   
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function hapusapd()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_apdmodel1->delete($id);

                $msg = [
                    'message' => 'Data APD berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
        }

// Akhir APD //

// Awal Program //

public function program()
    {
        $program1 = $this->tb_promodel1->findAll();
        $data = [
            'program' => $program1,
            'title' => 'Daftar Program & Pelatihan'
        ];
        
        return view('admin/program',$data);
}

 public function tabelprogram()
        {
            if ($this->request->isAJAX()){
                
                $data = [
                    'program' => $program1,
                ];
                $msg = [
                    'data' => view('admin/tableprogram', $data)
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function formaddpromodal()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdpro')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function formaddprogram()
        {
            if ($this->request->isAJAX()){
                
                $msg = [
                    'data' => view('admin/modaladdpro')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanaddpro()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'no_reg' => [
                        'rules' =>'required|is_unique[tb_program.no_reg]',
                        'errors' => [
                            'required' =>'Kode Harus Diisi',
                            'is_unique' => 'Kode Sudah Terdaftar'
                        ]
                        ],
                    'deskripsi' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Deskripsi User Harus Diisi',                            
                        ]
                        ],    
                    'pilih_kt' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Pilih Kategori Harus Diisi'
                        ]
                        ],
                    'lama_pro' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Lama Pelaksanaan Harus Diisi'
                        ]
                    ]   
                ]); 
                if(!$valid){
                    $msg = [
                        'error' => [
                            'no_reg' => $validation->getError('no_reg'),
                            'nm_reg' => $validation->getError('deskripsi'),
                            'tipe_peserta' => $validation->getError('pilih_kt'),
                            'lama_pelaksanaan' => $validation->getError('lama_pro')
                        ]
                    ];   
                }else{                    
                    $simpandokumen =[
                        'no_reg'  => $this->request->getVar('no_reg'),
                        'nm_reg'  => $this->request->getVar('deskripsi'),
                        'tipe_peserta' => $this->request->getVar('pilih_kt'),
                        'lama_pelaksanaan' => $this->request->getVar('lama_pro')                        ];
                        
                $this->tb_promodel1->insert($simpandokumen);
                        $msg = [
                            'message' => 'Program berhasil di tambahkan'
                        ];
                }
                echo json_encode($msg);   
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function editpro()
          {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_promodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'no_reg' => $row['no_reg'],
                    'nm_reg' => $row['nm_reg'],
                    'tipe_peserta' => $row['tipe_peserta'],
                    'lama_pelaksanaan' => $row['lama_pelaksanaan']
                ];

                $msg = [
                    'message' => view('/admin/modaleditpro',$data)
                ];
                echo json_encode($msg);
            }
        }

public function simpaneditpro()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                'deskripsi' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' =>'Deskripsi Program Harus Diisi'
                    ]
                    ],
                'pilih_kt' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' =>'Kategori Harus Diisi'
                    ]
                    ],
                 'lama_pro' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' =>'Lama Pelaksanaan Harus Diisi'
                    ]
                    ]
            ]);
                if (!$valid){
                    $msg = [
                        'error' =>[
                            'nm_reg' => $validation->getError('deskripsi'),
                            'tipe_peserta' => $validation->getError('pilih_kt'),
                            'lama_pelaksanaan' => $validation->getError('lama_pro')
                            ]
                    ];
            } else {
                    $id = $this->request->getVar('id');
                    // $findid = $this->tb_dokumenmodel1->where(['id' => $id])->first();
                    
                    $updateprogram =[
                        'nm_reg'  => $this->request->getVar('deskripsi'),
                        'tipe_peserta' => $this->request->getVar('pilih_kt'),
                        'lama_pelaksanaan' => $this->request->getVar('lama_pro')
                    ];

                        $this->tb_promodel1->update($id,$updateprogram);
                        $msg = [
                            'message' => 'Data Program berhasil di Ubah'
                        ];
                }
                echo json_encode($msg);
            }
        }

public function hapusprogram()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $this->tb_promodel1->delete($id);

                $msg = [
                    'message' => 'Program berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
        }

// Tampil File Pdf //

public function tampilfile(){
            $file = $this->request->getVar('file');
            $data=[
                'file' => $file
            ];
            return view('/admin/tampilfile',$data);
        }

        // public function tampil($id)
        // {
        //     $edit = $this->tb_usermodel1->where(['id' => $id])->first();
        //     $data = [            
        //         'title' => 'Profile',
        //         'validation' => \Config\Services::validation(),
        //         'id' => $edit
        //         ];
        //         return view('admin/tampilprofile',$data);
        // }

// Akhir Tampil Pdf //

// awal user //

public function user()
        {
            $dokumen1 = $this->tb_usermodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'title' => 'Data Pengguna'
        ];
        
        return view('admin/user',$data);
        }

public function formadduser()
        {
            if ($this->request->isAJAX()){                
                
                $msg = [
                    'data' => view('admin/modaladduser')
                ];   
                echo json_encode($msg);
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function simpanadduser()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'id_kar' => [
                        'rules' =>'required|is_unique[tb_user.id_karyawan]',
                        'errors' => [
                            'required' =>'ID Karyawan Harus Diisi',
                            'is_unique' => 'ID Karyawan Sudah Terdaftar'
                        ]
                        ],
                    'nm_depan' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Nama Depan Harus Diisi',                            
                        ]
                        ],
                    'nm_belakang' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Nama Belakang Harus Diisi',                            
                        ]
                        ],
                    'tmp_lhr' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tempat Lahir Harus Diisi',                           
                        ]
                        ],
                    'tgl_lhr' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Tanggal Lahir Harus Diisi',                           
                        ]
                        ],    
                    'div' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Divisi Pengguna Harus Diisi'
                        ]
                        ],
                    'jab' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Jabatan Pengguna Harus Diisi'
                        ]
                        ],
                    'email' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'E-mail Harus Diisi',                           
                        ]
                        ],
                    'telp' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'No. Telepon Harus Diisi',                           
                        ]
                        ],
                    'almt' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Alamat Harus Diisi',                           
                        ]
                        ],    
                    'level' => [
                        'rules' =>'required',
                        'errors' => [
                            'required' =>'Level User Harus Diisi'
                        ]
                    ],
                    'foto' => [
                        'rules' =>'is_image[foto]|max_size[foto,1048]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                        'errors' => [
                            'max_size' =>'Ukuran Foto Lebih Dari 1Mb',
                            'mime_in' =>'Hanya Bisa .jpg dan .png',
                            'is_image' =>'Hanya Gambar',
                       ]
                    ]
                ]); 
                if(!$valid){
                    $msg = [
                        'error' => [
                            'id_kar' => $validation->getError('id_kar'),
                            'nm_depan' => $validation->getError('nm_depan'),
                            'nm_belakang' => $validation->getError('nm_belakang'),
                            'tmp_lhr' => $validation->getError('tmp_lhr'),
                            'tgl_lhr' => $validation->getError('tgl_lhr'),
                            'email' => $validation->getError('email'),
                            'telp' => $validation->getError('telp'),
                            'almt' => $validation->getError('almt'),
                            'div' => $validation->getError('div'),
                            'jab' => $validation->getError('jab'),
                            'level' => $validation->getError('level'),
                            'foto' => $validation->getError('foto')
                        ]
                    ];   
                }else{                    
                    $foto = $this->request->getFile('foto');
                    
                    if($foto == "")
                    {
                    $namafoto1 = "default.jpg";
                    $namadepan = $this->request->getVar('nm_depan');
                    $namabelakang = $this->request->getVar('nm_belakang');
                    $namalengkap = $namadepan . ' ' . $namabelakang;
                    $namadepan1 = strtolower($namadepan);
                    $pass = $namadepan1 . '123';
                    $simpanuser = [
                        'id_karyawan' => $this->request->getVar('id_kar'), 
                        'username' => $namadepan1, 
                        'nm_user' => $namalengkap,
                        'tmp_lahir' => $this->request->getVar('tmp_lhr'),
                        'tgl_lahir' => $this->request->getVar('tgl_lhr'),
                        'email' => $this->request->getVar('email'),    
                        'no_telp' => $this->request->getVar('telp'),
                        'alamat' => $this->request->getVar('almt'),
                        'divisi' => $this->request->getVar('div'),
                        'jabatan' => $this->request->getVar('jab'),
                        'foto' => $namafoto1,
                        'kt_user' => $this->request->getVar('level'),
                        'pass' => $pass
                    ];
                   
                    }else{
                        $foto = $this->request->getFile('foto');
                        $foto ->move('fotouser');
                        $namafoto = $foto ->getName();
                        $namadepan = $this->request->getVar('nm_depan');
                        $namabelakang = $this->request->getVar('nm_belakang');
                        $namalengkap = $namadepan . ' ' . $namabelakang;
                        $namadepan1 = strtolower($namadepan);
                        $pass = $namadepan1 . '123';
                        $simpanuser = [
                            'id_karyawan' => $this->request->getVar('id_kar'), 
                            'username' => $namadepan1, 
                            'nm_user' => $namalengkap,
                            'tmp_lahir' => $this->request->getVar('tmp_lhr'),
                            'tgl_lahir' => $this->request->getVar('tgl_lhr'),
                            'email' => $this->request->getVar('email'),    
                            'no_telp' => $this->request->getVar('telp'),
                            'alamat' => $this->request->getVar('almt'),
                            'divisi' => $this->request->getVar('div'),
                            'jabatan' => $this->request->getVar('jab'),
                            'foto' => $namafoto,
                            'kt_user' => $this->request->getVar('level'),
                            'pass' => $pass
                    ];
                   
                    }
                    $this->tb_usermodel1->insert($simpanuser);
                   $msg = [
                    'message' => 'Data Karyawan berhasil di tambahkan'
                   ];
                }
                echo json_encode($msg);   
            }else{
                exit('Maaf tidak dapat diproses');
            }
        }

public function edituser()
        {
            if ($this->request->isAJAX()){
                $id= $this->request->getVar('id');
                $row = $this->tb_usermodel1->find($id);

                $data= [
                    'id' => $row['id'],
                    'id_karyawan' => $row['id_karyawan'],
                    'nm_user' => $row['nm_user'],
                    'divisi' => $row['divisi'],
                    'jabatan' => $row['jabatan'],
                    'kt_user' => $row['kt_user'],
                    'tmp_lahir' => $row['tmp_lahir'],
                    'tgl_lahir' => $row['tgl_lahir'],
                    'email' => $row['email'],
                    'no_telp' => $row['no_telp'],
                    'alamat' => $row['alamat']
                ];

                $msg = [
                    'message' => view('/admin/modaledituser',$data)
                ];
                echo json_encode($msg);
            }
        }


public function simpanedituserpak()
        {
            if ($this->request->isAJAX()){                
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                'nm_user' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Nama Karyawan Harus Diisi'
                                    ]
                                ],
                    'div' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Divisi Harus Diisi'
                                    ]
                                ],
                    'jab' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Jabatan Harus Diisi'
                                    ]
                                ],
                    'email' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'E-mail Harus Diisi'
                                    ]
                                ],
                    'telp' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'No. Telepom Harus Diisi'
                                    ]
                                ],
                    'tmp_lhr' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Tempat Lahir Harus Diisi'
                                    ]
                                ],
                    'tgl_lhr' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Tanggal Lahir Harus Diisi'
                                    ]
                                ],
                    'almt' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Alamat Harus Diisi'
                                    ]
                                ],
                    'lvl' => [
                                'rules' =>'required',
                                'errors' => [
                                    'required' =>'Level Karyawan Harus Diisi'
                                    ]
                                ]                          
                ]);
                if (!$valid){
                    $msg = [
                        'error' => [
                            'nm_user' => $validation->getError('nm_user'),
                            'tmp_lhr' => $validation->getError('tmp_lhr'),
                            'tgl_lhr' => $validation->getError('tgl_lhr'),
                            'email' => $validation->getError('email'),
                            'telp' => $validation->getError('telp'),
                            'almt' => $validation->getError('almt'),
                            'div' => $validation->getError('div'),
                            'jab' => $validation->getError('jab'),
                            'lvl' => $validation->getError('lvl')
                        ]
                    ];
            }else{
                            $id = $this->request->getVar('id');
                            // $findid = $this->tb_apdmodel1->where(['id' => $id])->first();
                            $update = [
                                'nm_user' => $this->request->getVar('nm_user'),
                                'tmp_lahir' => $this->request->getVar('tmp_lhr'),
                                'tgl_lahir' => $this->request->getVar('tgl_lhr'),
                                'email' => $this->request->getVar('email'),    
                                'no_telp' => $this->request->getVar('telp'),
                                'alamat' => $this->request->getVar('almt'),
                                'divisi' => $this->request->getVar('div'),
                                'jabatan' => $this->request->getVar('jab'),
                                'kt_user' => $this->request->getVar('lvl')
                        ];
                        $this->tb_usermodel1->update($id, $update);
                       $msg = [
                    'message' => 'Data Karyawan berhasil di ubah'
                   ];
                }
                echo json_encode($msg);   
            }
        }

public function hapususer()
        {
            if ($this->request->isAJAX()){
                $kd_user= $this->request->getVar('id');
                $this->tb_usermodel1->delete($kd_user);

                $msg = [
                    'message' => 'Data Karyawan berhasil dihapus'
                   ];
                echo json_encode($msg); 
            }
        }

// Awal Profile //

public function profile()
        {
            $dokumen1 = $this->tb_usermodel1->findAll();
        $data = [
            'dokumen' => $dokumen1,
            'judul' => 'Profile Pengguna',
            'title' => 'Profile'
        ];
        
        return view('admin/profile',$data);
        }

// Akhir Profile

} 