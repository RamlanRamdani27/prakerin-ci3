<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_model extends CI_Model {

	var $data;
	var $tabel='tbpengajuan';
	var $tabel2='tbdetailpengajuan';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbpengajuan.idpengajuan,6) as kode', FALSE);
		$this->db->order_by('idpengajuan', 'desc');
		$query=$this->db->get($this->tabel);
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='PNG'.date('ym').$kodemax;
		return $kodejadi;
	}

	function tampil(){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where('tbpengajuan.status_aprove=1');
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
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
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->group_by('tbpengajuan.idpengajuan');
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_mahasiswa($nim){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->where('tbdetailpengajuan.nim',$nim);
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}




	function get_pengajuan($idpengajuan) {

        $this->db->select('*,districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbpengajuan.idindustri=tbindustri.idindustri');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
        $this->db->where('tbpengajuan.idpengajuan',$idpengajuan);
        $query = $this->db->get();
 
        //cek apakah ada data
       if ($query->num_rows() == 1) {
            return $query->row();
        }
    }
    
    function get_pengajuan_mahasiswa($idpengajuan,$nim) {

        $this->db->select('*');
		$this->db->from('tbdetailpengajuan');
        $this->db->where('tbdetailpengajuan.idpengajuan',$idpengajuan);
        $this->db->where('tbdetailpengajuan.nim',$nim);
        $query = $this->db->get();
 
        //cek apakah ada data
       if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    function get_detail_pengajuan($idpengajuan) {

        $this->db->select('*');
		$this->db->from('tbdetailpengajuan');
		$this->db->join('tbmahasiswa','tbdetailpengajuan.nim=tbmahasiswa.nim');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan');
        $this->db->where('tbdetailpengajuan.idpengajuan',$idpengajuan);
        $query = $this->db->get();
 
        //cek apakah ada data
      if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
    }

    function get_jumlah_pengajuan($idpengajuan){
    	$this->db->select('count(*) as jumlah_pengajuan');
		$this->db->from('tbdetailpengajuan');
        $this->db->where('tbdetailpengajuan.idpengajuan',$idpengajuan);
        $query = $this->db->get();
 
     if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

	
	function savedetail($data){
			$insert=$this->db->insert($this->tabel,$data);
			return $insert;
	}
	
	function savedetail_lanjutan($RESULT= ARRAY()){

		$TOTAL_ARRAY = COUNT($RESULT);

		IF($TOTAL_ARRAY != 0){
		   $insert=$this->db->INSERT_BATCH($this->tabel2,$RESULT);
		   return $insert;
		}
	}

	function get_update($data,$where){
       $this->db->where($where);
       $this->db->update($this->tabel, $data);
       return TRUE;
    }

    function get_update_detail($data,$where,$id){
		$this->db->where($where);
		$this->db->where($id);
        $this->db->update($this->tabel2, $data);
	    return TRUE;
        
    }

    function get_update_statsu_approve($where,$data){
    	$this->db->where($where);
        $this->db->update($this->tabel, $data);
    }

	 //fungsi delete ke database
	function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel);
	       return TRUE;
	}
	function get_delete2($where){
	       $this->db->where($where);
	       $this->db->delete($this->tabel2);
	       return TRUE;
	}

	function get_nim_delete($idpengajuan,$nim){
	       $this->db->where($idpengajuan);
	       $this->db->where($nim);
	       $this->db->delete($this->tabel2);
	       return TRUE;
	}

}
