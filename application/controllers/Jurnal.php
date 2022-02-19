<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller {

  	 function __construct() {
          parent::__construct();
          $this->load->helper('url');
          $this->load->model('Jurnal_model');
          $this->load->model('Bidang_model');
          $this->load->model('Prakerin_model');
          if ($this->session->userdata('SESS_USERNAME')==null) {
  			   redirect('login/index','refresh');
  		    }
    }

    public function index(){
          
          $a['judul']="Jurnal";
          $a['title']="Jurnal";
          $a['Tabel']="Data Jurnal Mahasiswa";
          $isi='jurnal/jurnal';
          $a['jurnal']=$this->Jurnal_model->tampil();
          $this->template->load('template',$isi,$a);
    }
    public function index_kajur(){
          
          $this->load->model('User_model');
          $kode=$this->session->userdata('SESS_USERNAME');
          $where=array('idlogin'=>$kode); 
          $ambil_kode_jurusan=$this->User_model->get_byimage($where);
          $kode_jurusan=$ambil_kode_jurusan->kodejurusan;
          $a['judul']="Jurnal";
          $a['title']="Jurnal";
          $a['Tabel']="Data Jurnal Mahasiswa";
          $isi='jurnal/jurnal_kajur';
          $a['jurnal']=$this->Jurnal_model->tampil_kajur($kode_jurusan);
          $this->template->load('template',$isi,$a);
    }

    public function index_mahasiswa(){
          $nim=$this->session->userdata('SESS_USERNAME');
          
          $cek_id_prakerin=$this->Jurnal_model->tampil_idprakerin_mahasiswa($nim);
            if($cek_id_prakerin=="") {
              $idprakerin="";
              redirect('pengajuan/index_mahasiswa','refresh');
            }else{
              $idprakerin=$cek_id_prakerin->idprakerin; 
               
            }
          $ambil_kode_jurnal=$this->Jurnal_model->cek_jurnal($idprakerin);
            if( !$ambil_kode_jurnal=="") {
              $idjurnal=$ambil_kode_jurnal->idjurnal;
            }else{
              $idjurnal="";
            }


          $a['judul']="Jurnal";
          $a['title']="Jurnal";
          $a['Tabel']="Jurnal Kegiatan Prakerin";
          $isi='jurnal/jurnal_mahasiswa';
          $a['idprakerin']=$idprakerin;
          $a['idjurnal']=$idjurnal;
          $a['prakerin']=$this->Prakerin_model->get_prakerin($idprakerin);
          $a['jurnal']=$this->Jurnal_model->tampil_jurnal_mahasiswa($idjurnal);

          $this->template->load('template',$isi,$a);
    }

    public function add_data(){
          $idprakerin=$this->uri->segment(3);
          
          if ($idprakerin) {
              $cek_id_jurnal=$this->Jurnal_model->cek_jurnal($idprakerin);
              if ( $cek_id_jurnal=="") {
                   $kode=$this->Jurnal_model->buat_kode_tr();
                   $data=[];
                   $data = array(
                      'idjurnal' => $kode,
                      'idprakerin' => $idprakerin,
                      'tanggal' => date("Y-m-d"),
                    );
                   $simpan_data=$this->Jurnal_model->insert_data_jurnal($data);
                   if ($simpan_data) {
                        $ambil_kode_jurnal=$this->Jurnal_model->cek_jurnal($idprakerin);
                        $idjurnal=$ambil_kode_jurnal->idjurnal;
                   }
              }else{
                 $ambil_kode_jurnal=$this->Jurnal_model->cek_jurnal($idprakerin);
                 $idjurnal=$ambil_kode_jurnal->idjurnal;
              }

              $a['idjurnal']=$idjurnal;
              $a['Tabel']="Input Jurnal";
              $a['title']="Jurnal";
              $a['judul']="Input Jurnal";
              $isi="jurnal/input_jurnal";
              $this->template->load('template',$isi,$a);
             
          }else{
              $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi</span>
                  <br> 
                  <span data-notify="message">Anda Harus Mengajukan Prakerin Dulu</span>
                  </div>');
          redirect('pengajuan/index_mahasiswa','refresh');
        }    
    }

    public function edit_data(){
        $id=$this->uri->segment(3);
        $where=array('id'=>$id); 
        $a['Tabel']="Edit Jurnal";
        $a['title']="Jurnal";
        $a['judul']="Edit Jurnal";
        $isi="jurnal/edit_jurnal_mahasiswa";
        $a['list'] = $this->Jurnal_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
    }

    public function detail_data(){
        $idjurnal=$this->uri->segment(3);
        $idprakerin=$this->uri->segment(4);
        $a['Tabel']="Kegiatan Prakerin";
        $a['title']="Jurnal";
        $a['judul']="Detail Jurnal";
        $isi="jurnal/detail_jurnal";
        $a['idjurnal'] =$idjurnal;
        $a['list'] = $this->Prakerin_model->get_prakerin($idprakerin);
        $a['jurnal'] = $this->Jurnal_model->tampil_jurnal_mahasiswa($idjurnal);
        $this->template->load('template',$isi,$a);
    }
    public function detail_data_kajur(){
        $idjurnal=$this->uri->segment(3);
        $idprakerin=$this->uri->segment(4);
        $a['Tabel']="Kegiatan Prakerin";
        $a['title']="Jurnal";
        $a['judul']="Detail Jurnal";
        $isi="jurnal/detail_jurnal_kajur";
        $a['idjurnal'] =$idjurnal;
        $a['list'] = $this->Prakerin_model->get_prakerin($idprakerin);
        $a['jurnal'] = $this->Jurnal_model->tampil_jurnal_mahasiswa($idjurnal);
        $this->template->load('template',$isi,$a);
    }

    public function insert_data(){
      $data=array(
        'idjurnal'=>$this->input->POST('id'),
        'kegiatan'=>$this->input->POST('kegiatan'),
        'status'=>$this->input->POST('status'),
        'tanggal_kegiatan'=>date("Y-m-d", strtotime($this->input->post('tglkegiatan'))),
        );

        $insert = $this->Jurnal_model->insert_data_detail_jurnal($data);
        if ($insert) {
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateI
                nUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurnal</span>
                  <br> 
                  <span data-notify="message">Data Jurnal berhasil di input.</span>
                  </div>');
                  redirect('jurnal/index_mahasiswa','refresh');
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurnal</span>
                  <br> 
                  <span data-notify="message">Data Jurnal Gagal di Input.</span>
                  </div>');
        }
    }


    public function update_data(){

      $id=$this->input->POST('id');
      $data=array(
        'kegiatan'=>$this->input->POST('kegiatan'),
        'status'=>$this->input->POST('status'),
        'tanggal_kegiatan'=>date("Y-m-d", strtotime($this->input->post('tglkegiatan'))),
        );
       $where =array('id'=>$id);
       $this->Jurnal_model->get_update($data,$where); 
          $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurnal</span>
                  <br> 
                  <span data-notify="message">Data Jurnal berhasil di update.</span>
                  </div>');
       redirect('jurnal/index_mahasiswa','refresh');


    }

    public function hapus_data(){
        $idjurnal=$this->uri->segment(3);
        $where  = array('id'=>$idjurnal);
        $this->Jurnal_model->get_delete($where); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurnal</span>
                  <br> 
                  <span data-notify="message">Data Jurnal berhasil di Hapus.</span>
                  </div>');
        redirect('jurnal/index_mahasiswa','refresh');
    }

    public function hapus_data_lengkap(){
        $idjurnal=$this->uri->segment(3);
        $where  = array('idjurnal'=>$idjurnal);
        $this->Jurnal_model->get_delete($where);
        $this->Jurnal_model->get_delete_lengkap($where);
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurnal</span>
                  <br> 
                  <span data-notify="message">Data Jurnal berhasil di Hapus.</span>
                  </div>');
        redirect('jurnal/index','refresh');
    }

    public function cetak_jurnal()
    {
        $data['title']="Cetak Jurnal";
        $this->load->library('FPDF');
            define('FPDF_FONTPATH',  $this->config->item('fonts_path')); 
        $idprakerin=$this->uri->segment(3);
        $idjurnal=$this->uri->segment(4);
       
       // echo $idprakerin." ".$idjurnal;
        $a['list'] = $this->Prakerin_model->get_prakerin($idprakerin);
        $a['jurnal'] = $this->Jurnal_model->tampil_jurnal_mahasiswa($idjurnal);
        $this->load->view('jurnal/cetak_jurnal',$a); 
    }  




}
