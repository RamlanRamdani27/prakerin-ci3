<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('Login_model');
	}


	public function index()
	{
		$a['title']='Login';	
		$this->load->view('Login/Login_mahasiswa',$a);

	}

	public function Admin()
	{
		$a['title']='Login';	
		$this->load->view('Login/Login',$a);

	}

	public function ceklogin(){
		$username=$this->input->post('txtusername');
		$password=$this->input->post('txtpassword');

		$query=$this->Login_model->validate_login($username,$password);
		if($query){
			if ($this->session->userdata('SESS_LEVEL')=='kajur') {
				redirect('dashboard/index_kajur');
			}else{
				redirect('dashboard');
			}
			
		}else{
			$this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Login</span>
                  <br> 
                  <span data-notify='message'>Cek Password dan Username.</span>
                  </div>");
			redirect('login/admin');
			  // echo "<script>alert('Anda Gagal Login'); window.location='".base_url()."login/Admin'</script>";	
			
			
		}
	}

	public function ceklogin_mahasiswa(){
		$username=$this->input->post('txtusername');
		$password=$this->input->post('txtpassword');

		$query=$this->Login_model->validate_login_mahasiswa($username,$password);
		if($query){
			
			redirect('dashboard/index_mahasiswa');
		}else{

			$this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Login</span>
                  <br> 
                  <span data-notify='message'>Cek Password dan Nim.</span>
                  </div>");
			redirect('login/index');
			  // echo "<script>alert('Anda Gagal Login'); window.location='".base_url()."login/index'</script>";	
			
			
		}
	}


	
	public function logout(){
         
         // $this->session->userdata(session_destroy());
        // echo "<script>alert('Anda Berhasil Logout'); window.location='".base_url()."login/index'</script>";
        $this->session->unset_userdata('SESS_USERNAME');
        $this->session->unset_userdata('SESS_LEVEL');
        $this->session->unset_userdata('SESS_GAMBAR');
        $this->session->unset_userdata('SESS_EMAIL');
        $this->session->unset_userdata('SESS_NAME');
        $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Logout</span>
                      <br> 
                      <span data-notify="message">Anda Berhasil Logout.</span>
                      </div>');

          redirect('Login/index','refresh');
          
    	}

    	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('txtusername') == '')
		{
			$data['inputerror'][] = 'txtusername';
			$data['error_string'][] = 'Username Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('txtpassword') == '')
		{
			$data['inputerror'][] = 'txtpassword';
			$data['error_string'][] = 'Password Kosong';
			$data['status'] = FALSE;
		}


		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


}
