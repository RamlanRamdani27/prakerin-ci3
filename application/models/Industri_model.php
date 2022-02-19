<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industri_model extends CI_Model {

	var $data;
	var $tabel='tbindustri';
	var $tabel2='tbkoordinatindustri';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbindustri.idindustri,6) as kode', FALSE);
		$this->db->order_by('idindustri', 'desc');
		$query=$this->db->get($this->tabel);
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='IDS'.date('ym').$kodemax;
		return $kodejadi;
	}

	function tampil(){

		$this->db->select('*,districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*');
		$this->db->from('tbindustri');
		$this->db->join('tbkategori','tbindustri.idkategori=tbkategori.idkategori','LEFT');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
		$this->db->join('tbkoordinatindustri','tbindustri.idindustri=tbkoordinatindustri.idindustri','LEFT');

		$this->db->order_by('tbindustri.idindustri', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_industri_mahasiswa($number,$offset){
		$this->db->select('*,districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*');
		// $this->db->from('tbindustri');
		$this->db->join('tbkategori','tbindustri.idkategori=tbkategori.idkategori','LEFT');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
		$this->db->join('tbkoordinatindustri','tbindustri.idindustri=tbkoordinatindustri.idindustri','LEFT');
		return $query = $this->db->get('tbindustri',$number,$offset)->result();		
	}
 

	function getAll($config){  
		$this->db->select('*,districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*');
		// $this->db->from();
		$this->db->join('tbkategori','tbindustri.idkategori=tbkategori.idkategori','LEFT');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
		$this->db->join('tbkoordinatindustri','tbindustri.idindustri=tbkoordinatindustri.idindustri','LEFT');

		$this->db->order_by('tbindustri.idindustri', 'dsc');
        $hasilquery=$this->db->get('tbindustri',$config['per_page'], $this->uri->segment(3));
        if ($hasilquery->num_rows() > 0) {
            foreach ($hasilquery->result() as $value) {
                $data[]=$value;
            }
            return $data;
        }      
    }


	function provinsi(){
		$this->db->order_by('name','ASC');
		$provinces= $this->db->get('provinces');

		if ($provinces->num_rows() > 0){
			return $provinces->result();
		}
		else {
			return FALSE;
		}

	}



	function kabupaten($provId){

		$kabupaten="<option value='0'>-- Pilih Kota/Kabupaten --</option>";

		$this->db->order_by('name','ASC');
		$kab= $this->db->get_where('regencies',array('province_id'=>$provId));

		foreach ($kab->result_array() as $data ){
		$kabupaten.= "<option value='$data[id]'>$data[name]</option>";
		}

		return $kabupaten;

	}

	function kecamatan($kabId){
		$kecamatan="<option value='0'>-- Pilih Kecamatan --</option>";

		$this->db->order_by('name','ASC');
		$kec= $this->db->get_where('districts',array('regency_id'=>$kabId));

		foreach ($kec->result_array() as $data ){
		$kecamatan.= "<option value='$data[id]'>$data[name]</option>";
		}

		return $kecamatan;
	}

	function savedetail($data,$data2){
			$insert=$this->db->insert($this->tabel,$data);
			if ($insert) {
				$koordinat=$this->db->insert('tbkoordinatindustri',$data2);
				return $koordinat;
			}
			return $insert;
	}

	
	function get_byimage($where) {
        $this->db->select('tbindustri.*,tbkategori.*,tbkoordinatindustri.*, districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*');
		$this->db->from('tbindustri');
		$this->db->join('tbkategori','tbindustri.idkategori=tbkategori.idkategori','LEFT');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
		$this->db->join('tbkoordinatindustri','tbindustri.idindustri=tbkoordinatindustri.idindustri','LEFT');
        $this->db->where($where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

      function get_update($data,$data2,$where){
       	$this->db->where($where);
        $update=$this->db->update($this->tabel, $data);
			if ($update) {
				 $this->db->where($where);
				 $koordinat=$this->db->update('tbkoordinatindustri',$data2);
				 return $koordinat;
			}
		return $update;
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
}
