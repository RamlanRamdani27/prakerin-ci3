<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbjurusan.idjurusan,6) as kode', FALSE);
		$this->db->order_by('idjurusan', 'desc');
		$query=$this->db->get('tbjurusan');
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='JRS'.date('ym').$kodemax;
		return $kodejadi;
	}

	function cek_kode_jurusan($kodejurusan){

		$this->db->where('kodejurusan', $kodejurusan);
		$this->db->from('tbjurusan');
		$query = $this->db->get();
 
        //cek apakah ada data
        return $query->row();

	}

	public function get_by_id($id)
	{
		$this->db->from('tbjurusan');
		$this->db->where('idjurusan',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_save($data)
	{
		$this->db->insert('tbjurusan', $data);
		return $this->db->insert_id();
	}

	public function get_update($where, $data)
	{
		$this->db->update('tbjurusan', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('idjurusan', $id);
		$this->db->delete('tbjurusan');
	}

	function tampil(){
		$this->db->order_by('idjurusan', 'asc');
		$query= $this->db->get('tbjurusan');
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}


}
