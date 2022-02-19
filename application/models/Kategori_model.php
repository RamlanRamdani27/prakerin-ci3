<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	var $data;
	var $tabel='tbkategori';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbkategori.idkategori,6) as kode', FALSE);
		$this->db->order_by('idkategori', 'desc');
		$query=$this->db->get('tbkategori');
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='KI'.date('ym').$kodemax;
		return $kodejadi;
	}


	function fill_data($foto){
		$this->data=array(
			'idkategori'=>$this->input->POST('kodek'),
			'namakategori'=>$this->input->POST('namak'),
			'keterangan'=>$this->input->POST('ket'),
			'ikon'=>$foto,
			
			);
	}

	function insert_data(){
		$insert=$this->db->insert($this->tabel,$this->data);
		return $insert;
	}
	

	function tampil(){
		$this->db->order_by('idkategori', 'asc');
		$query= $this->db->get($this->tabel);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function get_byimage($where) {
        $this->db->select('idkategori,namakategori,keterangan,ikon');
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
 
	  //fungsi delete ke database
	  function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel);
	       return TRUE;
	    }



}
