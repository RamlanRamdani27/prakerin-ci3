<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industri extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        $this->load->model('Industri_model');
        $this->load->model('Kategori_model');
        $this->load->helper(array('url'));
        // $this->load->library('pagination');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }

    public function index()
        {
     
          $a['judul']="List Industri";
          $a['title']="Industri";
          $isi="industri/industri";
          $a['industri']=$this->Industri_model->tampil(); 
          $this->template->load('template',$isi,$a);
          
         }


    public function index_mahasiswa(){
     
        $this->load->library('pagination');
        $config['base_url'] = site_url('industri/index_mahasiswa'); //site url
        $config['total_rows'] = $this->db->count_all('tbindustri'); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
          $a['industri'] = $this->Industri_model->tampil_industri_mahasiswa($config["per_page"], $data['page']);           
 
          $a['pagination'] = $this->pagination->create_links();
          $a['judul']="List Industri";
          $a['title']="Industri";
          $isi="industri/industri_mahasiswa";
          // $a['industri']=$this->Industri_model->tampil(); 
          $this->template->load('template',$isi,$a);
    }

     public function add_data()
      {
            
            $isi="industri/input_industri";
            $a['isi']="industri/input_industri";
            $a['judul']="Input Industri";
            $a['title']="Tambah Industri";
            $a['provinsi']=$this->Industri_model->provinsi();
            $a['kategori']=$this->Kategori_model->tampil();
            $this->template->load('template',$isi,$a);
      }

      function ambil_data(){

      $modul=$this->input->post('modul');
      $id=$this->input->post('id');

      if($modul=="kota"){
        echo $this->Industri_model->kabupaten($id);

        }
        else if($modul=="kecamatan"){
        echo $this->Industri_model->kecamatan($id);

        }
        else if($modul=="kelurahan"){
        echo $this->Industri_model->kelurahan($id);

        }
    }

    function simpan_data(){
        $kode=$this->Industri_model->buat_kode_tr();
        $data=array(
        'idindustri'=>$kode,
        'namaindustri'=>$this->input->POST('nama'),
        'alamat'=>$this->input->POST('alamat'),
        'idkategori'=>$this->input->POST('idkategori'),
        'cp'=>$this->input->POST('cp'),
        'idkecamatan'=>$this->input->POST('idkec'),
        );
        $data2=array(
        'idindustri'=>$kode,
        'latitude'=>$this->input->POST('lat'),
        'longtitude'=>$this->input->POST('lng'),
        );
       
        $insert = $this->Industri_model->savedetail($data,$data2);
        if ($insert) {
                  
                  
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Industri berhasil di input.</span>
                  </div>');

                 if ($this->session->userdata('SESS_LEVEL')=='Mahasiswa') {
                    redirect('industri/index_mahasiswa','refresh');
                 }else{
                   redirect('industri/index','refresh');
                 }
                 
        }else{
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Industri Gagal di Input.</span>
                  </div>');
        }
        

    } 


    public function edit_data(){
        $a['judul']="Edit Industri";
        $id=$this->uri->segment(3);
        $where=array('tbindustri.idindustri'=>$id); 
        $a['title']='Industri';
        $isi='industri/edit_industri';
        $a['list'] = $this->Industri_model->get_byimage($where);
        $a['provinsi']=$this->Industri_model->provinsi(); 
        $a['kategori']=$this->Kategori_model->tampil();
        $this->template->load('template',$isi,$a);
        // $this->load->view('Template/template',$a);
     }

     public function detail_data(){
        $a['judul']="Detail Data Industri";
        $id=$this->uri->segment(3);
        $where=array('tbindustri.idindustri'=>$id); 
        $a['title']='Industri';
        $isi='industri/detail_industri';
        $a['list'] = $this->Industri_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
        // $this->load->view('Template/template',$a);
     }

     public function update_data(){

      $id=$this->input->POST('id');
      $data=array(
        'namaindustri'=>$this->input->POST('nama'),
        'alamat'=>$this->input->POST('alamat'),
        'idkategori'=>$this->input->POST('idkategori'),
        'cp'=>$this->input->POST('cp'),
        'idkecamatan'=>$this->input->POST('idkec'),
        );
       $data2=array(
        'latitude'=>$this->input->POST('lat'),
        'longtitude'=>$this->input->POST('lng'),
        );

       $where =array('idindustri'=>$id);
       $this->Industri_model->get_update($data,$data2,$where); 
          $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Industri berhasil di update.</span>
                  </div>');
       redirect('industri/index','refresh');


     }



    public function hapus_data(){

        $id  = $this->uri->segment(3);
        $where  = array('idindustri'=>$id);
        $this->Industri_model->get_delete2($where); 
        $this->Industri_model->get_delete($where); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Industri</span>
                  <br> 
                  <span data-notify="message">Data Industri berhasil di Hapus.</span>
                  </div>');


                  redirect('industri/index','refresh');

     }     

}    
  
    