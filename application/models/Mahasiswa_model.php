<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

	var $data;
	var $tabel='tbmahasiswa';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function ceknim($Nim){
		$this->db->select('nim');
		$this->db->where('nim', $Nim);
		$this->db->from($this->tabel);
		$query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
	}
	function cekpass($id,$paslama){
		$this->db->select('nim');
		$this->db->where('nim', $id);
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
			'nim'=>$this->input->POST('nim'),
			'password'=>md5($this->input->POST('password')),
			'nama'=>$this->input->POST('nama'),
			'jk'=>$this->input->POST('jk'),
			'idjurusan'=>$this->input->POST('jurusan'),
			'alamat'=>$this->input->POST('alamat'),
			'foto'=>$foto,
			);
	}

	function insert_data(){
		$insert=$this->db->insert($this->tabel,$this->data);
		return $insert;
	}

	function cek_import_data($where){
		$this->db->select('nim');	
		$this->db->where($where);
		$this->db->from($this->tabel);
        $query = $this->db->get();
		if ($query->num_rows() == 1) {
            return $query->row();
        }
	}
	function ambil_jurusan($kodejurusan){
		$this->db->select('idjurusan');	
		$this->db->where('kodejurusan',$kodejurusan);
		$this->db->from('tbjurusan');
        $query = $this->db->get();
		if ($query->num_rows() == 1) {
            return $query->row();
        }
	}


	function import_data($data){
		$insert=$this->db->insert($this->tabel,$data);
		return $insert;
	}
	

	function tampil(){
		$this->db->order_by('nim', 'asc');
		$query= $this->db->get($this->tabel);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_filter($filtermahasiswa){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->where('idjurusan',$filtermahasiswa);
		$query= $this->db->get();
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
		$this->db->join('tbjurusan','tbmahasiswa.idjurusan=tbjurusan.idjurusan','LEFT');
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
       $this->db->where('nim',$id);
       $this->db->update($this->tabel, $data);
       return TRUE;
    }
 
	  //fungsi delete ke database
	  function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel);
	       return TRUE;
	    }

	function ganti_passsword_mahasiswa($where,$password){
	    	$this->db->where($where);
       		$this->db->update($this->tabel, $password);
       		return TRUE;
    }

}
