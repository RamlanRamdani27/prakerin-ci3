<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prakerin_model extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->library('zend'); 
        $this->zend->load('Zend/Barcode');
		$this->load->database();
	}


	function buat_kode_tr(){
		$this->db->select('RIGHT(tbprakerin.idprakerin,6) as kode', FALSE);
		$this->db->order_by('idprakerin', 'desc');
		$query=$this->db->get('tbprakerin');
		if ($query->num_rows() <> 0) {
			$data =$query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}
		$kodemax=str_pad($kode, 6,"0",STR_PAD_LEFT);
		$kodejadi='PRKN'.date('ym').$kodemax;
		return $kodejadi;
	}

	function get_all_data_pelanggan($kode){
		$query=$this->db->query("SELECT * FROM tbpengajuan, tbdetailpengajuan,tbindustri,tbmahasiswa
			WHERE tbpengajuan.idpengajuan=tbdetailpengajuan.idpengajuan AND tbpengajuan.idindustri=tbindustri.idindustri AND tbdetailpengajuan.nim=tbmahasiswa.nim  AND tbpengajuan.idpengajuan='$kode'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	function insert_co($kode,$data){
		$this->db->trans_start();
		$ambil=$this->get_all_data_pelanggan($kode);
		foreach ($ambil as $key => $row) {
				$kode_prakerin=$this->buat_kode_tr();
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$kode_prakerin), array())->draw();
		        $imageName = $kode_prakerin.'.jpg';
		        $imagePath = './adminBSB/barcode/'; // penyimpanan file barcode
		         imagejpeg($imageResource, $imagePath.$imageName); 
		        $pathBarcode = $imagePath.$imageName; 
				$this->datarinci=array(
					'idprakerin'=>$kode_prakerin,
					'idindustri'=>$row->idindustri,
					'nim'=>$row->nim,
					'tglmulai'=>$row->tglmulai,
					'tglselesai'=>$row->tglakhir,
					'keterangan_prakerin'=>'Belum Mulai Prakerin',
					'status'=>'1',
					'idbidang'=>'BDN1711000001',
					'barcode'=>$pathBarcode 
					);
				
				$insert=$this->db->insert('tbprakerin', $this->datarinci);
		}
			$this->db->where('idpengajuan', $kode);
			$rubah= $this->db->update('tbpengajuan', $data );
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function tampil(){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}


	function get_prakerin($idprakerin) {

        $this->db->select('*,districts.id as idkecamatan, districts.name as namakecamatan,regencies.id as idkota ,regencies.name as namakota,provinces.*,tbindustri.alamat as alamatindustri');
		$this->db->from('tbprakerin');
		$this->db->join('tbindustri','tbprakerin.idindustri=tbindustri.idindustri');
		$this->db->join('districts','tbindustri.idkecamatan=districts.id','LEFT');
		$this->db->join('regencies','districts.regency_id=regencies.id','LEFT');
		$this->db->join('provinces','regencies.province_id=provinces.id','LEFT');
		$this->db->join('tbmahasiswa','tbprakerin.nim=tbmahasiswa.nim');
		$this->db->join('tbbidang','tbprakerin.idbidang=tbbidang.idbidang');
        $this->db->where('tbprakerin.idprakerin',$idprakerin);
        $query = $this->db->get();
 
        //cek apakah ada data
       if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    function tampil_mahasiswa($nim){
		$this->db->select('*');
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where('tbprakerin.nim',$nim);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
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
		$this->db->from('tbprakerin');
		$this->db->join('tbmahasiswa','tbmahasiswa.nim=tbprakerin.nim','LEFT');
		$this->db->join('tbindustri','tbindustri.idindustri=tbprakerin.idindustri','LEFT');
		$this->db->join('tbkoordinatindustri','tbkoordinatindustri.idindustri=tbindustri.idindustri','LEFT');
		$this->db->join('tbkategori','tbkategori.idkategori=tbindustri.idkategori','LEFT');
		$this->db->where('tbmahasiswa.idjurusan',$kode_jurusan);
		$this->db->where('year(tbprakerin.tglselesai)=year(now())');
		$this->db->order_by('tbprakerin.idprakerin', 'dsc');
		$query= $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

    function get_update($data,$where){
       $this->db->where($where);
       $this->db->update('tbprakerin', $data);
       return TRUE;
    }

    function get_delete($where){
	       $this->db->where($where);
	       $this->db->delete('tbprakerin');
	       return TRUE;
	}



}
