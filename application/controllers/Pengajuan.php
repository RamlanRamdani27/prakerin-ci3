<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {
	 function __construct() {
        parent::__construct();

        $this->load->model('Pengajuan_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Industri_model');
        $this->load->helper('url');
        $this->load->library('zend'); 
        $this->zend->load('Zend/Barcode');
        
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }

  	public function index()
  	{
  		      $a['judul']="Pengajuan";
            $a['title']="Pengajuan";
            $a['Tabel']="Daftar Pengajuan";
            $isi='pengajuan/pengajuan';
            $a['pengajuan']=$this->Pengajuan_model->tampil();
  		      $this->template->load('template',$isi,$a);
  	}

    public function index_mahasiswa()
    {   
            $nim=$this->session->userdata('SESS_USERNAME');
            $a['judul']="Pengajuan";
            $a['title']="Pengajuan";
            $a['Tabel']="Daftar Pengajuan";
            $isi='pengajuan/pengajuan';
            $a['pengajuan']=$this->Pengajuan_model->tampil_mahasiswa($nim);
            $this->template->load('template',$isi,$a);
    }
    public function index_kajur()
    {       
            $this->load->model('User_model');
            $kode=$this->session->userdata('SESS_USERNAME');
            $where=array('idlogin'=>$kode); 
            $ambil_kode_jurusan=$this->User_model->get_byimage($where);
            $kode_jurusan=$ambil_kode_jurusan->kodejurusan;
            // echo $kode_jurusan;
            $a['judul']="Pengajuan";
            $a['title']="Pengajuan";
            $a['Tabel']="Daftar Pengajuan";
            $isi='pengajuan/pengajuan_kajur';
            $a['pengajuan']=$this->Pengajuan_model->tampil_kajur($kode_jurusan);
            $this->template->load('template',$isi,$a);
    }

	  public function add_data(){
            $a['Tabel']="Input Pengajuan";
            $a['title']="Pengajuan";
            $a['judul']="Input Pengajuan";
            $isi="pengajuan/input_pengajuan";
            $a['industri']=$this->Industri_model->tampil(); 
            $a['jurusan']=$this->Jurusan_model->tampil(); 
            $this->template->load('template',$isi,$a);
    }

    public function edit_data(){

        $idpengajuan=$this->uri->segment(3);
        $a['judul']="Tampil Edit data Pengajuan";
        $a['title']="Pengajuan";
        $a['Tabel']="Edit data Pengajuan";
        $isi='pengajuan/edit_pengajuan';
        $a['industri']=$this->Industri_model->tampil();
        $a['list'] = $this->Pengajuan_model->get_pengajuan($idpengajuan);
       $this->template->load('template',$isi,$a);
     }

     public function edit_data_detail(){
        $idpengajuan=$this->uri->segment(3);
        $nim=$this->uri->segment(4);
        $a['judul']="Edit data Pengajuan Mahasiswa";
        $a['title']="Pengajuan";
        $a['Tabel']="Edit data Pengajuan Mahasiswa";
        $isi='pengajuan/edit_pengajuan_lanjutan';
        $a['list'] = $this->Pengajuan_model->get_pengajuan_mahasiswa($idpengajuan,$nim);
        $a['nim']=$this->Mahasiswa_model->tampil(); 
       $this->template->load('template',$isi,$a);
     }


     public function detail_data(){

        $idpengajuan=$this->uri->segment(3);
        $a['judul']="Tampil Detail data Pengajuan";
        $a['header_title']=" Data Mahasiswa yang mengajukan Prakerin";
        $a['title']="Pengajuan";
        $a['Tabel']="Detail data Pengajuan";
        $isi='pengajuan/detail_pengajuan';
        $a['total'] = $this->Pengajuan_model->get_jumlah_pengajuan($idpengajuan);
        $a['list'] = $this->Pengajuan_model->get_pengajuan($idpengajuan);
        $a['listt'] = $this->Pengajuan_model->get_detail_pengajuan($idpengajuan);
       $this->template->load('template',$isi,$a);
     }

     public function detail_data_kajur(){

        $idpengajuan=$this->uri->segment(3);
        $a['judul']="Tampil Detail data Pengajuan";
        $a['header_title']=" Data Mahasiswa yang mengajukan Prakerin";
        $a['title']="Pengajuan";
        $a['Tabel']="Detail data Pengajuan";
        $isi='pengajuan/detail_pengajuan_kajur';
        $a['list'] = $this->Pengajuan_model->get_pengajuan($idpengajuan);
        $a['listt'] = $this->Pengajuan_model->get_detail_pengajuan($idpengajuan);
       $this->template->load('template',$isi,$a);
     }

  function insert_data(){

        $kode=$this->Pengajuan_model->buat_kode_tr();
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$kode), array())->draw();
        $imageName = $kode.'.jpg';
        $imagePath = './adminBSB/barcode/'; // penyimpanan file barcode
         imagejpeg($imageResource, $imagePath.$imageName); 
        $pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase

        $data=array(
        'idpengajuan'=>$kode,
        'tglpengajuan'=>date("Y-m-d"),
        'user_input'=>$this->input->POST('penginput'),
        'idindustri'=>$this->input->POST('industri'),
        'tglmulai'=>date("Y-m-d", strtotime($this->input->post('tglmulai'))),
        'tglakhir'=>date("Y-m-d", strtotime($this->input->post('tglakhir'))),
        'jumlah'=>$this->input->POST('jml'),
        'status_aprove'=>$status_approve=1,
        // 'status_aprove'=>$status_approve=2,
        'barcode'=>$pathBarcode,
        );
       
        $insert = $this->Pengajuan_model->savedetail($data);
        if ($insert) {
                  
                  
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateI
                nUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Awal berhasil di input.</span>
                  </div>');
                 $filtermahasiswa=$this->input->POST('jurusan');
                 $a['aktivitas']=0;
                 $a['nim']=$this->Mahasiswa_model->tampil_filter($filtermahasiswa);
                 $a['Tabel']="Input Pengajuan Lanjutan";
                 $a['title']="Pengajuan";
                 $a['judul']="Input Pengajuan Lanjutan";
                 $a['jumlah']=$this->input->POST('jml');
                 $a['idpengajuan'] =$kode;
                 $isi="pengajuan/input_pengajuan_lanjutan";
                 $this->template->load('template',$isi,$a);
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Awal Gagal di Input.</span>
                  </div>');
        }
    }


    function insert_data_lanjutan(){
          $aktivitas=$this->input->post('aktivitas');
          $idpengajuan=$this->input->post('id');
          $RESULT = ARRAY();
          FOREACH($_POST['idpengajuan'] AS $KEY => $VAL)
          {
          $RESULT[] = ARRAY(
            "idpengajuan" => $_POST['idpengajuan'][$KEY],
            "nim" => $_POST['nim'][$KEY],
            "notelepon" => $_POST['nomer'][$KEY]
            );
          }        
       
        $insert = $this->Pengajuan_model->savedetail_lanjutan($RESULT);
        if ($insert) {
                  
                  
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan berhasil di input.</span>
                  </div>');
                  if ($aktivitas==1) {
                      $url = base_url() . 'pengajuan/detail_data/'.$idpengajuan;
                      redirect($url,'refresh');
                  }else{
                    if ($this->session->userdata('SESS_LEVEL')=="Mahasiswa") {
                      redirect('pengajuan/index_mahasiswa','refresh'); 
                    }else{
                      redirect('pengajuan/index','refresh'); 
                    }
                    
                  }
                  
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Gagal di Input.</span>
                  </div>');
        }
    }

    public function tambah_detail_data(){
        $a['aktivitas']=1;
        $a['nim']=$this->Mahasiswa_model->tampil();
        $a['Tabel']="Tambah Mahasiswa";
        $a['title']="Pengajuan";
        $a['judul']="Tambah Mahasiswa";
        $a['jumlah']=$this->uri->segment(3);
        $a['idpengajuan'] =$this->uri->segment(4);
        $isi="pengajuan/input_pengajuan_lanjutan";
        $this->template->load('template',$isi,$a);
    }

    public function update_data(){

        $idpengajuan=$this->input->POST('idpengajuan');
        $where  = array('idpengajuan'=>$idpengajuan);
        $data=array(
        'idindustri'=>$this->input->POST('industri'),
        'tglmulai'=>date("Y-m-d", strtotime($this->input->post('tglmulai'))),
        'tglakhir'=>date("Y-m-d", strtotime($this->input->post('tglakhir'))),
        'jumlah'=>$this->input->POST('jml')
        );
        $rubah = $this->Pengajuan_model->get_update($data,$where);

         if ($rubah) {
                $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan berhasil di Rubah.</span>
                  </div>');
                  $url = base_url() . 'pengajuan/detail_data/'.$idpengajuan;
                  redirect($url,'refresh');       
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Gagal di Rubah.</span>
                  </div>');
        }
        
    }

    public function update_data_detail(){

        $idpengajuan=$this->input->POST('idpengajuan');
        $id=$this->input->POST('id');
        $nim=$this->input->POST('nim');
        $no=$this->input->POST('nomer');
        $where  = array('idpengajuan'=>$idpengajuan);
        $id  = array('id'=>$id);
        $data=array(
        'nim'=>$nim,
        'notelepon'=>$no
        );
        $rubah = $this->Pengajuan_model->get_update_detail($data,$where,$id);

         if ($rubah) {
                $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Mahasiswa berhasil di Rubah.</span>
                  </div>');
                  $url = base_url() . 'pengajuan/detail_data/'.$idpengajuan;
                  redirect($url,'refresh');           
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Pengajuan</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan Mahasiswa Gagal di Rubah.</span>
                  </div>');
        }
        
    }
  


     public function hapus_data(){

        $idpengajuan=$this->uri->segment(3);
        $rowdel= $this->Pengajuan_model->get_pengajuan($idpengajuan);
         @unlink($rowdel->barcode);

        $where  = array('idpengajuan'=>$idpengajuan);
        $this->Pengajuan_model->get_delete2($where); 
        $this->Pengajuan_model->get_delete($where); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Pengajuan berhasil di Hapus.</span>
                  </div>');
        if ($this->session->userdata('SESS_LEVEL')=="Mahasiswa") {
           redirect('pengajuan/index_mahasiswa','refresh');
        }else{
           redirect('pengajuan/index','refresh');
        }
       

     }

     public function transaksi_ditolak(){
        $id=$this->uri->segment(3);
        $tidak_diterima =$this->uri->segment(4);
        $data  = array('status_aprove'=>$tidak_diterima);
        $where  = array('idpengajuan'=>$id);
        $this->Pengajuan_model->get_update_statsu_approve($where,$data); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Mahasiswa berhasil di Hapus.</span>
                  </div>');

        // $url = base_url() . 'Pengajuan/detail_data/'.$list->idpengajuan;
        // redirect($url,'refresh');
        redirect('pengajuan/index','refresh');

     }

     public function hapus_data_mahasiswa(){
        $id=$this->uri->segment(3);
        $nim =$this->uri->segment(4);
        $nim  = array('nim'=>$nim);
        $idpengajuan  = array('idpengajuan'=>$id);
        $list = $this->Pengajuan_model->get_pengajuan($id);
        $this->Pengajuan_model->get_nim_delete($idpengajuan,$nim); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Mahasiswa berhasil di Hapus.</span>
                  </div>');

        $url = base_url() . 'pengajuan/detail_data/'.$list->idpengajuan;
        redirect($url,'refresh');

     }

    public function cetak_surat()
    {
        $data['title']="Cetak Pengajuan";
        $this->load->library('FPDF');
            define('FPDF_FONTPATH',  $this->config->item('fonts_path'));
        $idpengajuan=$this->uri->segment(3);
        $a['list']= $this->Pengajuan_model->get_pengajuan($idpengajuan);
        $a['listt']= $this->Pengajuan_model->get_detail_pengajuan($idpengajuan);
        $this->load->view('pengajuan/cetak_pengajuan',$a); 
    }  


}