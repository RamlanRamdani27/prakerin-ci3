<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	function __construct(){
		parent::__construct();
        
		$this->load->model('Jurusan_model');
        $this->load->helper('url');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
	}

	 public function index()
        {
     
          $a['judul']="Tampil Jurusan";
          $a['title']="Jurusan";
          $a['Tabel']="Daftar Jurusan";
          $isi='jurusan/jurusan';
          $a['jurusan']=$this->Jurusan_model->tampil(); 
          $a['kode']=$this->Jurusan_model->buat_kode_tr();
          $this->template->load('template',$isi,$a);
         }

    public function ajax_edit($id)
	{
		$data = $this->Jurusan_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
        $this->_validate();
		$data = array(
				'idjurusan' => $this->input->post('idjurusan'),
				'kodejurusan' => $this->input->post('kodejurusan'),
				'namajurusan' => $this->input->post('namajurusan'),
				
				
			);
		$insert = $this->Jurusan_model->get_save($data);
		echo json_encode(array("status" => TRUE));
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurusan</span>
                  <br> 
                  <span data-notify="message">Data Jurusan berhasil di input.</span>
                  </div>');
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kodejurusan' => $this->input->post('kodejurusan'),
				'namajurusan' => $this->input->post('namajurusan'),
				
			);
		$this->Jurusan_model->get_update(array('idjurusan' => $this->input->post('idjurusan')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('msg', 
                 '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurusan</span>
                  <br> 
                  <span data-notify="message">Data Jurusan berhasil di update.</span>
                  </div>');
	}

	public function ajax_delete()
	{
		$id  = $this->uri->segment(3);
		$this->Jurusan_model->delete_by_id($id);
		$this->session->set_flashdata('msg', 
               '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Jurusan</span>
                  <br> 
                  <span data-notify="message">Data Jurusan berhasil di hapus.</span>
                  </div>');

          redirect('jurusan/index','refresh');
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;



		if($this->input->post('idjurusan') == '')
		{
			$data['inputerror'][] = 'idjurusan';
			$data['error_string'][] = 'ID Jurusan Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('kodejurusan') == '')
		{
			$data['inputerror'][] = 'kodejurusan';
			$data['error_string'][] = 'Kode Jurusan Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('namajurusan') == '')
		{
			$data['inputerror'][] = 'namajurusan';
			$data['error_string'][] = 'Nama Jurusan Kosong';
			
			$data['status'] = FALSE;
		}
		// $kodejurusan=$this->input->post('kodejurusan');
  //       $cek=$this->Jurusan_model->cek_kode_jurusan($kodejurusan);
		// if ($cek==1) {
		// 	$this->session->set_flashdata('msg', 
  //                   '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
  //                     <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
  //                     <span data-notify="icon"></span> 
  //                     <span data-notify="title">Notifikasi Jurusan</span>
  //                     <br> 
  //                     <span data-notify="message">Kode Jurusan Sudah Ada.</span>
  //                     </div>');

		// }


		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}     

}
