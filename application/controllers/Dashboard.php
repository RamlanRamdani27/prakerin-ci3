<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	  function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Dashboard_model');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }
	public function index(){

		$a['title']="Dashboard";
		$isi='dashboard/dashboard';
		$t_map = $this->Dashboard_model->tampil_map();
		$daftar = [];
		if (!empty($t_map)) {
			foreach ($t_map as $d_map) {
				$list['nama']   = $d_map->namaindustri;
	        	$list['alamat'] = $d_map->alamat;
	        	$list['lat']    = $d_map->latitude;
	        	$list['lon']    = $d_map->longtitude;
	        	$list['icon']   = $d_map->ikon;
	        	$list['mhs'] = $this->Dashboard_model->check_siswa_by_prakerin($d_map->idindustri);
	        	array_push($daftar, $list);
			}
		}

		$a['mhs_prakerin']=$daftar;
		$a['ditermina']=$this->Dashboard_model->jumlah_pengajuan_diterima();
		$a['tidak_diterima']=$this->Dashboard_model->jumlah_pengajuan_tidak_diterima();
		$a['baru']=$this->Dashboard_model->jumlah_pengajuan_baru();
		$a['bar_chart'] = $this->Dashboard_model->Data_prakerin();
		$a['jumlah_prakerin']=$this->Dashboard_model->jumlah_prakerin();
		$this->template->load('template',$isi,$a);
	}

	public function index_kajur(){

		$this->load->model('User_model');
            $kode=$this->session->userdata('SESS_USERNAME');
            $where=array('idlogin'=>$kode); 
            $ambil_kode_jurusan=$this->User_model->get_byimage($where);
            $kode_jurusan=$ambil_kode_jurusan->kodejurusan;
		
		$t_map = $this->Dashboard_model->tampil_map_jurusan($kode_jurusan);
		$daftar = [];
		if (!empty($t_map)) {
			foreach ($t_map as $d_map) {
				$list['nama']   = $d_map->namaindustri;
	        	$list['alamat'] = $d_map->alamat;
	        	$list['lat']    = $d_map->latitude;
	        	$list['lon']    = $d_map->longtitude;
	        	$list['icon']   = $d_map->ikon;
	        	$list['mhs'] = $this->Dashboard_model->check_siswa_by_prakerin_kajur($d_map->idindustri,$kode_jurusan);
	        	array_push($daftar, $list);
			}
		}

		$a['mhs_prakerin']=$daftar;
		// $a['bar_chart'] = $this->Dashboard_model->Data_prakerin();
		$a['ditermina']=$this->Dashboard_model->jumlah_pengajuan_diterima_kajur($kode_jurusan);
		$a['tidak_diterima']=$this->Dashboard_model->jumlah_pengajuan_tidak_diterima_kajur($kode_jurusan);
		$a['baru']=$this->Dashboard_model->jumlah_pengajuan_baru_kajur($kode_jurusan);
		$a['jumlah_prakerin']=$this->Dashboard_model->jumlah_prakerin_kajur($kode_jurusan);
		$a['title']="Dashboard";
		$isi='dashboard/dashboard_kajur';
		$this->template->load('template',$isi,$a);
	}

	public function index_mahasiswa(){
		$nim=$this->session->userdata('SESS_USERNAME');
		$a['title']="Dashboard";
		$isi='dashboard/dashboard_mahasiswa';
		$a['ditermina']=$this->Dashboard_model->jumlah_pengajuan_diterima_mahasiswa($nim);
		$a['tidak_diterima']=$this->Dashboard_model->jumlah_pengajuan_tidak_diterima_mahasiswa($nim);
		$a['baru']=$this->Dashboard_model->jumlah_pengajuan_baru_mahasiswa($nim);
		$a['jumlah_prakerin']=$this->Dashboard_model->jumlah_prakerin_mahasiswa($nim);
		$a['list']=$this->Dashboard_model->tampil_map_mahasiswa($nim);
		$this->template->load('template',$isi,$a);
	}
        
}
