<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prakerin extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Prakerin_model');
        $this->load->model('Bidang_model');
        if ($this->session->userdata('SESS_USERNAME')==null) {
			redirect('login/index','refresh');
		}
         
    }

	function proses_transaksi(){
       
        $kode=$this->uri->segment(3);
        $status_approve=$this->uri->segment(4);
        $data=array(
        'status_aprove'=>$status_approve,
        );
        if ($this->Prakerin_model->insert_co($kode,$data)) {
            $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Konfirmasi</span>
                  <br> 
                  <span data-notify="message">Data Prakerin berhasil di Konfirmasi.</span>
                  </div>');
        	redirect('prakerin/index','refresh');
        }
    }

    function index(){
        $a['judul']="Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="List Prakerin";
        $isi='prakerin/prakerin';
        $a['prakerin']=$this->Prakerin_model->tampil();
        $this->template->load('template',$isi,$a);
    }
    function index_mahasiswa(){
        $nim=$this->session->userdata('SESS_USERNAME');
        $a['judul']="Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="Data Prakerin";
        $isi='prakerin/prakerin';
        $a['prakerin']=$this->Prakerin_model->tampil_mahasiswa($nim);
        $this->template->load('template',$isi,$a);
    }
    function index_kajur(){
        $this->load->model('User_model');
        $kode=$this->session->userdata('SESS_USERNAME');
        $where=array('idlogin'=>$kode); 
        $ambil_kode_jurusan=$this->User_model->get_byimage($where);
        $kode_jurusan=$ambil_kode_jurusan->kodejurusan;
        $a['judul']="Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="Data Prakerin";
        $isi='prakerin/prakerin_kajur';
        $a['prakerin']=$this->Prakerin_model->tampil_kajur($kode_jurusan);
        $this->template->load('template',$isi,$a);
    }
    function detail_data(){
        $idprakerin=$this->uri->segment(3);
        $a['judul']="Detail Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="Detail Prakerin";
        $isi='prakerin/detail_prakerin';
        $a['list']=$this->Prakerin_model->get_prakerin($idprakerin);
        $this->template->load('template',$isi,$a);
    }
    function detail_data_kajur(){
        $idprakerin=$this->uri->segment(3);
        $a['judul']="Detail Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="Detail Prakerin";
        $isi='prakerin/detail_prakerin_kajur';
        $a['list']=$this->Prakerin_model->get_prakerin($idprakerin);
        $this->template->load('template',$isi,$a);
    }

    function edit_data(){
        $idprakerin=$this->uri->segment(3);
        $a['judul']="Edit data Prakerin";
        $a['title']="Prakerin";
        $a['Tabel']="Edit data Prakerin";
        $isi='prakerin/edit_prakerin';
        $a['bidang']=$this->Bidang_model->tampil();
        $a['list']=$this->Prakerin_model->get_prakerin($idprakerin);
        $this->template->load('template',$isi,$a);
    }

    function update_data(){
        $idPrakerin=$this->input->POST('idprakerin');
        $where  = array('idprakerin'=>$idPrakerin);
        $data=array(
        'pembimbing_kampus'=>$this->input->POST('pembimbing_kampus'),
        'pembimbing_perusahaan'=>$this->input->POST('pembimbing_perusahaan'),
        'idbidang'=>$this->input->POST('bidang')
        );
        $rubah = $this->Prakerin_model->get_update($data,$where);

        if ($rubah) {
                $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Prakerin</span>
                  <br> 
                  <span data-notify="message">Data Prakerin berhasil di Rubah.</span>
                  </div>');
                  $url = base_url() . 'prakerin/detail_data/'.$idPrakerin;
                  redirect($url,'refresh');       
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Prakerin</span>
                  <br> 
                  <span data-notify="message">Data Prakerin Gagal di Rubah.</span>
                  </div>');
        }
    }

    function mulai_prakerin(){
        $idprakerin=$this->uri->segment(3);
        $status_approve=$this->uri->segment(4);
        $where  = array('idprakerin'=>$idprakerin);
        $data=array(
        'status'=>$status_approve,
        'keterangan_prakerin'=>'Sedang Melaksanakan Prakerin',
        );
        $proses=$this->Prakerin_model->get_update($data,$where);
        if ($proses) {
            $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Konfirmasi Mulai Prakerin</span>
                  <br> 
                  <span data-notify="message">Anda Telah Mengkonfimasi Prakerin dilakasanakan.</span>
                  </div>');
            $url = base_url() . 'prakerin/detail_data/'.$idprakerin;
                  redirect($url,'refresh');
        }
    }
    function prakerin_selesai(){
        $idprakerin=$this->uri->segment(3);
        $status_approve=$this->uri->segment(4);
        $where  = array('idprakerin'=>$idprakerin);
        $data=array(
        'status'=>$status_approve,
        'keterangan_prakerin'=>'Sudah Melaksanakan Prakerin',
        );
        $proses=$this->Prakerin_model->get_update($data,$where);
        if ($proses) {
            $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Konfirmasi Selesasi Prakerin</span>
                  <br> 
                  <span data-notify="message">Anda Telah Mengkonfimasi Prakerin Telah dilakasanakan.</span>
                  </div>');
            $url = base_url() . 'prakerin/detail_data/'.$idprakerin;
                  redirect($url,'refresh');
        }
    }

    function hapus_data(){
        $idprakerin=$this->uri->segment(3);
        $where  = array('idprakerin'=>$idprakerin);
        $proses=$this->Prakerin_model->get_delete($where);
        if ($proses) {
            $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Hapus Prakerin</span>
                  <br> 
                  <span data-notify="message">Anda Telah Berhasil Menghapus Data Prakerin.</span>
                  </div>');
            redirect('prakerin/index/','refresh');
        }
    }




}
