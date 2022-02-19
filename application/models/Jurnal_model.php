<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_model extends CI_Model {

	var $data;
	var $tabel='tbjurnal';
	var $tabel2='tbdetailjurnal';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbjurnal.idjurnal,6) as kode', FALSE);
		$this->db->order_by('idjurnal', 'desc');
		$query=$this->db->get($this->tabel);
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='JNR'.date('ym').$kodemax;
		return $kodejadi;
	}

	function tampil(){
		$this->db->select('*');
		$this->db->from('tbjurnal');
		// $this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->order_by('tbjurnal.idjurnal', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_kajur($kode_jurusan){
		$this->db->select('*');
		$this->db->from('tbjurnal');
		$this->db->join('tbprakerin','tbprakerin.idprakerin=tbjurnal.idprakerin','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->order_by('tbjurnal.idjurnal', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}


	function tampil_jurnal_mahasiswa($idjurnal){
		$this->db->select('*');		
		// $this->db->from('tbjurnal');
		// $this->db->join('tbdetailjurnal','tbjurnal.idjurnal=tbdetailjurnal.idjurnal','LEFT');
		//  $this->db->where('tbjurnal.idprakerin',$idprakerin);
		// $this->db->order_by('tbjurnal.idjurnal', 'dsc');
		$this->db->from('tbdetailjurnal');
		$this->db->where('tbdetailjurnal.idjurnal',$idjurnal);
		$this->db->order_by('tbdetailjurnal.idjurnal', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_idprakerin_mahasiswa($nim) {

        $this->db->select('*');
		$this->db->from('tbprakerin');
        $this->db->where('tbprakerin.nim',$nim);
        $query = $this->db->get();
 
        //cek apakah ada data
       if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    function cek_jurnal($idprakerin){
    	$this->db->select('*');
		$this->db->from('tbjurnal');
        $this->db->where('tbjurnal.idprakerin',$idprakerin);
        $query = $this->db->get();

       if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    function insert_data_jurnal($data){
    	$insert=$this->db->insert($this->tabel,$data);
		return $insert;
    }

    function insert_data_detail_jurnal($data){
    	$insert=$this->db->insert($this->tabel2,$data);
		return $insert;
    }

    function get_byimage($where) {
        $this->db->select('*');
		$this->db->from($this->tabel2);
        $this->db->where($where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    function get_update($data,$where){
       $this->db->where($where);
       $this->db->update($this->tabel2, $data);
       return TRUE;
    }

    function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel2);
	       return TRUE;
	}
	function get_delete_lengkap($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel);
	       return TRUE;
	}



}