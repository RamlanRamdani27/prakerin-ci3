<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	  function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Laporan_model');
        $this->load->model('Jurusan_model');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }

	public function laporan_pengajuan(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan";
        $a['Tabel']="Laporan Pengajuan";
		$isi='laporan/laporan_pengajuan';
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan();
		$this->template->load('template',$isi,$a);
	}

	public function laporan_pengajuan_tahun(){

		$a['judul']="Pengajuan Pertahun";
        $a['title']="Laporan Pengajuan Pertahun";
        $a['Tabel']="Laporan Pengajuan Pertahun";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_tahun';

		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$pertahun=array('year(tbpengajuan.tglpengajuan)'=>$tahun);
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_pertahun($pertahun,$perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_pengajuan_jurusan(){

		$a['judul']="Pengajuan Jurusan";
        $a['title']="Laporan Pengajuan Jurusan";
        $a['Tabel']="Laporan Pengajuan Jurusan";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_jurusan';

		$jurusan=$this->input->post('jurusan');
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_perjurusan($perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_ditolak(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan Tidak Diterima Pertahun";
        $a['Tabel']="Laporan Pengajuan Tidak Diterima Pertahun";
		$isi='laporan/laporan_pengajuan_keterangan';
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_tidak_diterima();
		$this->template->load('template',$isi,$a);
	}

	public function laporan_ditolak_tahun(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan Tidak Diterima";
        $a['Tabel']="Laporan Pengajuan Tidak Diterima";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_keterangan_tahun';

		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$pertahun=array('year(tbpengajuan.tglpengajuan)'=>$tahun);
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_tidak_diterima_pertahun($pertahun,$perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_ditolak_jurusan(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan Tidak Diterima";
        $a['Tabel']="Laporan Pengajuan Tidak Diterima";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_keterangan_jurusan';

		$jurusan=$this->input->post('jurusan');
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_tidak_diterima_perjurusan($perjurusan);
		$this->template->load('template',$isi,$a);
	}




	public function laporan_diterima(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan Diterima";
        $a['Tabel']="Laporan Pengajuan Diterima";
		$isi='laporan/laporan_pengajuan_keterangan';
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_diterima();
		$this->template->load('template',$isi,$a);
	}


	public function laporan_diterima_tahun(){

		$a['judul']="Pengajuan";
        $a['title']="Laporan Pengajuan Diterima";
        $a['Tabel']="Laporan Pengajuan Diterima";
		$a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_keterangan_tahun';

		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$pertahun=array('year(tbpengajuan.tglpengajuan)'=>$tahun);
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_diterima_pertahun($pertahun,$perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_diterima_jurusan(){

		$a['judul']="Pengajuan Jurusan";
        $a['title']="Laporan Pengajuan Diterima Jurusan";
        $a['Tabel']="Laporan Pengajuan Diterima Jurusan";
		$a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_pengajuan_keterangan_jurusan';

		$jurusan=$this->input->post('jurusan');
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['pengajuan']=$this->Laporan_model->Laporan_pengajuan_diterima_perjurusan($perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_prakerin(){

		$a['judul']="Prakerin";
        $a['title']="Laporan Prakerin";
        $a['Tabel']="Laporan Prakerin";
		$isi='laporan/laporan_prakerin';
		$a['prakerin']=$this->Laporan_model->Laporan_data_prakerin();
		$this->template->load('template',$isi,$a);
	}

	public function laporan_prakerin_tahun(){

		$a['judul']="Prakerin Pertahun";
        $a['title']="Laporan Prakerin Pertahun";
        $a['Tabel']="Laporan Prakerin Pertahun";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_prakerin_tahun';

		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$pertahun=array('year(tbprakerin.tglmulai)'=>$tahun);
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['prakerin']=$this->Laporan_model->Laporan_data_prakerin_pertahun($pertahun,$perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_prakerin_jurusan(){

		$a['judul']="Prakerin Perjurusan";
        $a['title']="Laporan Prakerin Perjurusan";
        $a['Tabel']="Laporan Prakerin Perjurusan";
        $a['jurusan']=$this->Jurusan_model->tampil(); 
		$isi='laporan/laporan_prakerin_jurusan';

		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$perjurusan=array('tbjurusan.idjurusan'=>$jurusan);
		$a['prakerin']=$this->Laporan_model->Laporan_data_prakerin_perjurusan($perjurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_grafik(){

		$a['judul']="Laporan Grafik";
        $a['title']="Laporan Grafik";
        $a['Tabel']="Laporan Grafik";

		$isi='laporan/laporan_grafik';

		$a['bar_chart']=$this->Laporan_model->Grafik();
		$this->template->load('template',$isi,$a);
	}

	public function laporan_grafik_periode(){

		$a['judul']="Laporan Grafik";
        $a['title']="Laporan Grafik";
        $a['Tabel']="Laporan Grafik";
		$a['jurusan']=$this->Jurusan_model->tampil(); 

		$isi='laporan/laporan_grafik_pertahun';
		
		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		$a['bar_chart']=$this->Laporan_model->Grafik_periode_jurusan($jurusan,$tahun);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_grafik_jurusan(){

		$a['judul']="Laporan Grafik";
        $a['title']="Laporan Grafik";
        $a['Tabel']="Laporan Grafik";
		$a['jurusan']=$this->Jurusan_model->tampil(); 

		$isi='laporan/laporan_grafik_perjurusan';
		
		$jurusan=$this->input->post('jurusan');
		$a['bar_chart']=$this->Laporan_model->Grafik_jurusan($jurusan);
		$this->template->load('template',$isi,$a);
	}

	public function laporan_peta(){

		$a['judul']="Laporan Peta";
        $a['title']="Laporan Peta";
        $a['Tabel']="Laporan Peta";
		$isi='laporan/laporan_peta';
		$t_map = $this->Laporan_model->tampil_map();
		$daftar = [];
		if (!empty($t_map)) {
			foreach ($t_map as $d_map) {
				$list['nama']   = $d_map->namaindustri;
	        	$list['alamat'] = $d_map->alamat;
	        	$list['lat']    = $d_map->latitude;
	        	$list['lon']    = $d_map->longtitude;
	        	$list['icon']   = $d_map->ikon;
	        	$list['mhs'] = $this->Laporan_model->check_siswa_by_prakerin($d_map->idindustri);
	        	array_push($daftar, $list);
			}
		}

		$a['mhs_prakerin']=$daftar;
		$this->template->load('template',$isi,$a);
	}

	public function laporan_peta_periode(){

		$a['judul']="Laporan Peta";
        $a['title']="Laporan Peta";
        $a['Tabel']="Laporan Peta";
		$isi='laporan/laporan_peta_pertahun';
		$a['jurusan']=$this->Jurusan_model->tampil();
		$tahun=$this->input->post('tahun');
		$jurusan=$this->input->post('jurusan');
		
		$t_map = $this->Laporan_model->tampil_map_periode($jurusan,$tahun);
		$daftar = [];
		if (!empty($t_map)) {
			foreach ($t_map as $d_map) {
				$list['nama']   = $d_map->namaindustri;
	        	$list['alamat'] = $d_map->alamat;
	        	$list['lat']    = $d_map->latitude;
	        	$list['lon']    = $d_map->longtitude;
	        	$list['icon']   = $d_map->ikon;
	        	$list['mhs'] = $this->Laporan_model->check_siswa_by_prakerin_periode($d_map->idindustri,$jurusan);
	        	array_push($daftar, $list);
			}
		}

		$a['mhs_prakerin']=$daftar;
		$this->template->load('template',$isi,$a);
	}

	public function laporan_peta_perjurusan(){

		$a['judul']="Laporan Peta";
        $a['title']="Laporan Peta";
        $a['Tabel']="Laporan Peta";
		$isi='laporan/laporan_peta_perjurusan';
		$a['jurusan']=$this->Jurusan_model->tampil();
		$jurusan=$this->input->post('jurusan');
		
		$t_map = $this->Laporan_model->tampil_map_perjurusan($jurusan);
		$daftar = [];
		if (!empty($t_map)) {
			foreach ($t_map as $d_map) {
				$list['nama']   = $d_map->namaindustri;
	        	$list['alamat'] = $d_map->alamat;
	        	$list['lat']    = $d_map->latitude;
	        	$list['lon']    = $d_map->longtitude;
	        	$list['icon']   = $d_map->ikon;
	        	$list['mhs'] = $this->Laporan_model->check_siswa_by_prakerin_periode($d_map->idindustri,$jurusan);
	        	array_push($daftar, $list);
			}
		}

		$a['mhs_prakerin']=$daftar;
		$this->template->load('template',$isi,$a);
	}


        
}