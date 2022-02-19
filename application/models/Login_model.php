<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function validate_login($username,$password){
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));

		$query=$this->db->get('tblogin');

		if ($query->num_rows()==1) {
			$row =$query->row();
				$data=array(
					'SESS_USERNAME' => $row->idlogin,
					'SESS_LEVEL' => $row->level,
					'SESS_GAMBAR' => $row->foto,
					'SESS_EMAIL' => $row->username,	
					// 'SESS_KODE_JURUSAN' => $row->kodejurursan,
					'SESS_NAME' => $row->nama);
		$this->session->set_userdata($data);
				return TRUE;
		}else{
			return FALSE;
		}
	}

	function validate_login_mahasiswa($username,$password){
		$this->db->where('nim', $username);
		$this->db->where('password', md5($password));

		$query=$this->db->get('tbmahasiswa');

		if ($query->num_rows()==1) {
			$row =$query->row();
				$data=array(
					'SESS_USERNAME' => $row->nim,
					'SESS_LEVEL' => $Lev="Mahasiswa",
					'SESS_GAMBAR' => $row->foto,
					'SESS_EMAIL' => $row->nim,	
					'SESS_NAME' => $row->nama);
		$this->session->set_userdata($data);
				return TRUE;
		}else{
			return FALSE;
		}
	}



}

 ?>