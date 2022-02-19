<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	var $data;
	var $tabel='tblogin';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function cekusername($Username){
		$this->db->select('username');
		$this->db->where('username', $Username);
		$this->db->from($this->tabel);
		$query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function cekpass($id,$paslama){
		$this->db->select('username');
		$this->db->where('idlogin', $id);
		$this->db->where('password', $paslama);
		$this->db->from($this->tabel);
		$query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function fill_data($foto){
		$this->data=array(
			'username'=>$this->input->POST('email'),
			'password'=>md5($this->input->POST('password')),
			'level'=>$this->input->POST('level'),
			'nama'=>$this->input->POST('nama'),
			'kodejurusan'=>$this->input->POST('jurusan'),
			'foto'=>$foto,
			);
	}

	function insert_data(){
		$insert=$this->db->insert($this->tabel,$this->data);
		return $insert;
	}
	

	function tampil(){
		$this->db->order_by('username', 'asc');
		$query= $this->db->get($this->tabel);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function get_byimage($where) {
        $this->db->select('*');
		$this->db->from($this->tabel);
        $this->db->where($where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    
    	//fungsi update ke database
     function get_update($data,$where){
       $this->db->where($where);
       $this->db->update($this->tabel, $data);
       return TRUE;
    }

     function updatepassbaru($id,$data){
       $this->db->where('idlogin',$id);
       $this->db->update($this->tabel, $data);
       return TRUE;
    }
 
	  //fungsi delete ke database
	  function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel);
	       return TRUE;
	    }



}
