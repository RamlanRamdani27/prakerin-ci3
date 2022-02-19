<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function tampil_map(){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
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

	function jumlah_pengajuan_diterima(){
		$this->db->select('count(*) as jumlah_pengajuan_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('status_aprove=2');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_tidak_diterima(){
		$this->db->select('count(*) as jumlah_pengajuan_tidak_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('status_aprove=3');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_baru(){
		$this->db->select('count(*) as jumlah_pengajuan_baru');
		$this->db->from('tbpengajuan');
		$this->db->where('status_aprove=1');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_prakerin(){
		$this->db->select('count(*) as jumlah_prakerin');
		$this->db->from('tbprakerin');
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}


	function Data_prakerin(){
			$query = $this->db->query("SELECT COUNT(tbprakerin.idprakerin) as jumlah,tbindustri.namaindustri as nama FROM tbprakerin, tbindustri where tbprakerin.idindustri= tbindustri.idindustri and year(tbprakerin.tglselesai)=year(now()) GROUP BY tbindustri.namaindustri, year(tbprakerin.tglselesai)");
			 
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$result[] = $data;
				}
				return $result;
			}
	}

	function tampil_map_mahasiswa($nim){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where('tbprakerin.nim',$nim);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$this->db->group_by('tbindustri.idindustri');
		$query= $this->db->get();
		if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_diterima_mahasiswa($nim){
		$this->db->select('count(*) as jumlah_pengajuan_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->where('tbdetailpengajuan.nim',$nim);
		$this->db->where('status_aprove=2');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_tidak_diterima_mahasiswa($nim){
		$this->db->select('count(*) as jumlah_pengajuan_tidak_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->where('tbdetailpengajuan.nim',$nim);
		$this->db->where('status_aprove=3');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_baru_mahasiswa($nim){
		$this->db->select('count(*) as jumlah_pengajuan_baru');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->where('tbdetailpengajuan.nim',$nim);
		// $this->db->where('status_aprove=1');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_prakerin_mahasiswa($nim){
		$this->db->select('count(*) as jumlah_prakerin');
		$this->db->from('tbprakerin');
		$this->db->where('tbprakerin.nim',$nim);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}



	function tampil_map_jurusan($kode_jurusan){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$this->db->group_by('tbindustri.idindustri');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function check_siswa_by_prakerin_kajur($idindustri,$kode_jurusan)
	{
		$query = $this->db->select('tbmahasiswa.nim, tbmahasiswa.nama')
				 ->from('tbprakerin')
				 ->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT')
		         ->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT')
		         ->where('tbindustri.idindustri = "'.$idindustri.'"')
		         ->where('tbmahasiswa.idjurusan = "'.$kode_jurusan.'"')
		         ->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function jumlah_pengajuan_diterima_kajur($kode_jurusan){
		$this->db->select('count(*) as jumlah_pengajuan_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('status_aprove=2');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_tidak_diterima_kajur($kode_jurusan){
		$this->db->select('count(*) as jumlah_pengajuan_tidak_diterima');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('status_aprove=3');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_pengajuan_baru_kajur($kode_jurusan){
		$this->db->select('count(*) as jumlah_pengajuan_baru');
		$this->db->from('tbpengajuan');
		$this->db->join('tbdetailpengajuan','tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan','LEFT');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbdetailpengajuan.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('status_aprove=1');
		$this->db->where('year(tglakhir)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}

	function jumlah_prakerin_kajur($kode_jurusan){
		$this->db->select('count(*) as jumlah_prakerin');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$query= $this->db->get();
		 if ($query->num_rows() == 1) {
            return $query->row();
        }
	}


}
