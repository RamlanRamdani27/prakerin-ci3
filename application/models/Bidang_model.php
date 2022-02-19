<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang_model extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbbidang.idbidang,6) as kode', FALSE);
		$this->db->order_by('idbidang', 'desc');
		$query=$this->db->get('tbbidang');
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='BDN'.date('ym').$kodemax;
		return $kodejadi;
	}


	public function get_by_id($id)
	{
		$this->db->from('tbbidang');
		$this->db->where('idbidang',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_save($data)
	{
		$this->db->insert('tbbidang', $data);
		return $this->db->insert_id();
	}

	public function get_update($where, $data)
	{
		$this->db->update('tbbidang', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('idbidang', $id);
		$this->db->delete('tbbidang');
	}

	function tampil(){
		$this->db->order_by('idbidang', 'asc');
		$query= $this->db->get('tbbidang');
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}


}
