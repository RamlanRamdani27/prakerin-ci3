<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Kategori extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        $this->load->model('Kategori_model');
        $this->load->helper('url');
        $this->load->library('upload');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }
    


    public function index()
        {
     
          $a['judul']="Tampil Kategori Industri";
          $a['title']="Kategori";
          $a['Tabel']="Daftar Kategori";
          $isi='Kategori/Kategori';
          $a['kategori']=$this->Kategori_model->tampil();
          $this->template->load('template',$isi,$a);
         }

      public function add_data()
      {
            $a['Tabel']="Input Kategori";
            $a['title']="Kategori";
            $a['judul']="Input Kategori Industri";
            $isi="Kategori/input_Kategori";
            $a['kode']=$this->Kategori_model->buat_kode_tr();
            $this->template->load('template',$isi,$a);
      }

      function insert_data(){
        $nmfile=$this->input->post('namak');
        $config['upload_path']  = 'adminBSB/images/kategori/';
        $config['allowed_types']= 'gif|jpg|jpeg|bmp|png';
        $config['max_size']= '2088';
        $config['max_width']= '1288';
        $config['max_height']= '768';
        $config['file_name']= $nmfile.date('his');

        

          $this->upload->initialize($config);
            if (! $this->upload->do_upload()) {
              $a=$this->upload->display_errors();
               $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Kategori</span>
                  <br> 
                  <span data-notify='message'>Data Kategori Gagal di Input.". $a.".</span>
                  </div>");

                redirect('kategori/add_data','refresh');  
            }else{
              $gbr =$this->upload->data();
              $foto=$gbr['file_name'];
              $this->Kategori_model->fill_data($foto);
                if ($this->Kategori_model->insert_data()) {
                  
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Kategori</span>
                  <br> 
                  <span data-notify="message">Data Kategori berhasil di Input.</span>
                  </div>');

                  redirect('kategori/index','refresh');
                }else{
                  $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Kategori</span>
                  <br> 
                  <span data-notify="message">Data Kategori Gagal di Input.</span>
                  </div>');
                }
            }
      }

      public function edit_data(){

        $a['title']="Kategori";
        $id=$this->uri->segment(3);
        $where=array('idKategori'=>$id); 
        $a['judul']='Edit Kategori';
        $a['tabel']='Edit Kategori Industri';
        $isi='kategori/edit_Kategori';
        $a['list'] = $this->Kategori_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
     }

     public function update_data(){
   
      $nmfile=$this->input->post('namak');
      $path   = 'adminBSB/images/Kategori/';
      $config['upload_path']  = $path;
      $config['allowed_types']= 'gif|jpg|jpeg|bmp|png';
      $config['max_size']= '2088';
      $config['max_width']= '1288';
      $config['max_height']= '768';
      $config['file_name']= $nmfile.date('his');
   
         $this->upload->initialize($config);
   
         $idgbr      = $this->input->post('kodek'); 
         $filelama   = $this->input->post('filelama'); 
         $namak      = $this->input->post('namak'); 


         if(!$_FILES['filefoto']['name']== '')
         {
             if (!$this->upload->do_upload('filefoto'))
             {
                $er_upload=$this->upload->display_errors();
                 $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Kategori</span>
                  <br> 
                  <span data-notify='message'>Data Kategori ". $namak ." gagal di update ". $er_upload.".</span>
                  </div>");

                redirect('kategori/index','refresh');  
          
   
             }else{  
              
                $gbr = $this->upload->data();
                  $data = array(
                   'ikon' =>$gbr['file_name'],             
                   'namaKategori'=>$this->input->POST('namak'),                   
                   'keterangan'=>$this->input->POST('ket'),
   
                 );
   
                 @unlink($path.$filelama);
   
                 $where =array('idKategori'=>$idgbr);
                 $this->Kategori_model->get_update($data,$where); 
                $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Kategori</span>
                  <br> 
                  <span data-notify="message">Edit Kategori berhasil di update.</span>
                  </div>');
                redirect('kategori/index','refresh');
             }

         }else{ 
   
             $data = array(
                   'namaKategori'=>$this->input->POST('namak'),      
                   'keterangan'=>$this->input->POST('ket'),
             );
   
             $where =array('idKategori'=>$idgbr); 
             $this->Kategori_model->get_update($data,$where); 
                             $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Kategori</span>
                  <br> 
                  <span data-notify="message">Edit Kategori berhasil di update.</span>
                  </div>');
                redirect('kategori/index','refresh');
          }
       }
   

      public function hapus_data(){

         $idgbr  = $this->uri->segment(3);
         $path= 'adminBSB/images/Kategori/';
         $where  = array('idKategori'=>$idgbr);
         $rowdel = $this->Kategori_model->get_byimage($where);
   
         @unlink($path.$rowdel->ikon);

          $this->Kategori_model->get_delete($where); 
           $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Kategori</span>
                  <br> 
                  <span data-notify="message">Data Kategori berhasil di Hapus.</span>
                  </div>');
          
          redirect('kategori/index','refresh');

     }


} 