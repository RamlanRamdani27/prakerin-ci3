<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function Laporan_pengajuan(){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Laporan_pengajuan_pertahun($pertahun,$perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($pertahun);
		$this->db->where($perjurusan);
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

	function Laporan_pengajuan_perjurusan($perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($perjurusan);
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

	function Laporan_pengajuan_diterima(){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where('tbpengajuan.status_aprove=2');
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Laporan_pengajuan_diterima_pertahun($pertahun,$perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($pertahun);
		$this->db->where($perjurusan);
		$this->db->where('tbpengajuan.status_aprove=2');
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

	function Laporan_pengajuan_diterima_perjurusan($perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($perjurusan);
		$this->db->where('tbpengajuan.status_aprove=2');
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

	function Laporan_pengajuan_tidak_diterima(){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where('tbpengajuan.status_aprove=3');
		$this->db->order_by('tbpengajuan.idpengajuan', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Laporan_pengajuan_tidak_diterima_pertahun($pertahun,$perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($pertahun);
		$this->db->where($perjurusan);
		$this->db->where('tbpengajuan.status_aprove=3');
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

	function Laporan_pengajuan_tidak_diterima_perjurusan($perjurusan){

		$this->db->select('*');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbdetailpengajuan.idpengajuan=tbpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbpengajuan.idindustri','LEFT');
		$this->db->where($perjurusan);
		$this->db->where('tbpengajuan.status_aprove=3');
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
	

	function Laporan_data_prakerin(){

		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Laporan_data_prakerin_pertahun($pertahun,$perjurusan){

		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where($pertahun);
		$this->db->where($perjurusan);
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Laporan_data_prakerin_perjurusan($perjurusan){

		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbjurusan','tbjurusan.idjurusan=tbmahasiswa.idjurusan','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where($perjurusan);
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function Grafik(){
				$query = $this->db->query("SELECT COUNT(tbprakerin.idprakerin) as jumlah,tbindustri.namaindustri as nama FROM tbprakerin, tbindustri where tbprakerin.idindustri= tbindustri.idindustri GROUP BY tbindustri.namaindustri");
			 
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$result[] = $data;
				}
				return $result;
			}
	}

	function Grafik_periode_jurusan($jurusan,$tahun){
		$query = $this->db->query("SELECT COUNT(tbprakerin.idprakerin) as jumlah,tbindustri.namaindustri as nama FROM tbprakerin, tbindustri,tbmahasiswa,tbjurusan where tbprakerin.idindustri= tbindustri.idindustri and tbprakerin.nim=tbmahasiswa.nim and tbmahasiswa.idjurusan=tbjurusan.idjurusan and tbjurusan.idjurusan='$jurusan' and year(tbprakerin.tglselesai)='$tahun' GROUP BY tbindustri.namaindustri");
			 
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$result[] = $data;
				}
				return $result;
			}
	}

	function Grafik_jurusan($jurusan){
		$query = $this->db->query("SELECT COUNT(tbprakerin.idprakerin) as jumlah,tbindustri.namaindustri as nama FROM tbprakerin, tbindustri,tbmahasiswa,tbjurusan where tbprakerin.idindustri= tbindustri.idindustri and tbprakerin.nim=tbmahasiswa.nim and tbmahasiswa.idjurusan=tbjurusan.idjurusan and tbjurusan.idjurusan='$jurusan'  GROUP BY tbindustri.namaindustri");
			 
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$result[] = $data;
				}
				return $result;
			}
	}

	function tampil_map(){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->group_by('tbindustri.idindustri');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function check_siswa_by_prakerin($idindustri)
	{
		$query = $this->db->select('tbmahasiswa.nim, tbmahasiswa.nama')
				 ->from('tbprakerin')
				 ->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT')
		         ->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT')
		         ->where('tbindustri.idindustri = "'.$idindustri.'"')
		         ->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_map_periode($jurusan,$tahun){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$jurusan);
		$this->db->where('year(tbprakerin.tglselesai)',$tahun);
		$this->db->group_by('tbindustri.idindustri');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function check_siswa_by_prakerin_periode($idindustri,$jurusan)
	{
		$query = $this->db->select('tbmahasiswa.nim, tbmahasiswa.nama')
				 ->from('tbprakerin')
				 ->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT')
		         ->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT')
		         ->where('tbindustri.idindustri = "'.$idindustri.'"')
		         ->where('tbmahasiswa.idjurusan = "'.$jurusan.'"')
		         ->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function tampil_map_perjurusan($jurusan){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$jurusan);
		$this->db->group_by('tbindustri.idindustri');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}
}
