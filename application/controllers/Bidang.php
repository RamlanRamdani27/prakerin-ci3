<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends CI_Controller {

	function __construct(){
		parent::__construct();
        
		$this->load->model('Bidang_model');
        $this->load->helper('url');


        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
	}

	public function index()
	{
		$this->load->helper('url');
		$a['judul']="Input Bidang";
        $a['title']="Bidang";
        $a['Tabel']="Daftar Bidang";
		$isi="bidang/bidang";
		$a['bidang']=$this->Bidang_model->tampil();
		$this->template->load('template',$isi,$a);
	}
	public function index_mahasiswa()
	{
		 $this->load->helper('url');
		$a['judul']="Input Bidang";
        $a['title']="Bidang";
        $a['Tabel']="Daftar Bidang";
		$isi="bidang/bidang_mahasiswa";
		$a['bidang']=$this->Bidang_model->tampil();
		$this->template->load('template',$isi,$a);
	}


		public function ajax_edit($id)
	{
		$data = $this->Bidang_model->get_by_id($id);
		// $data->tanggalmasuk = ($data->tanggalmasuk == '0000-00-00') ? '' : $data->tanggalmasuk; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$kode=$this->Bidang_model->buat_kode_tr();
		$data = array(
				'idbidang' => $kode,
				'namabidang' => $this->input->post('namabidang'),
				
				
			);
		$insert = $this->Bidang_model->get_save($data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Bidang</span>
                  <br> 
                  <span data-notify="message">Data Bidang berhasil di input.</span>
                  </div>');
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				
				'namabidang' => $this->input->post('namabidang'),
				
			);
		$this->Bidang_model->get_update(array('idbidang' => $this->input->post('kodebidang')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Bidang</span>
                  <br> 
                  <span data-notify="message">Data Bidang berhasil di update.</span>
                  </div>');
	}

	public function ajax_delete()
	{
		$id  = $this->uri->segment(3);
		$this->Bidang_model->delete_by_id($id);
		$this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Bidang</span>
                  <br> 
                  <span data-notify="message">Data Bidang berhasil di hapus.</span>
                  </div>');

          redirect('bidang/index','refresh');
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		// if($this->input->post('kodebidang') == '')
		// {
		// 	$data['inputerror'][] = 'kodebidang';
		// 	$data['error_string'][] = 'Kode Bidang Kosong';
		// 	$data['status'] = FALSE;
		// }

		if($this->input->post('namabidang') == '')
		{
			$data['inputerror'][] = 'namabidang';
			$data['error_string'][] = 'Nama Bidang Kosong';
			$data['status'] = FALSE;
		}


		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
