<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
        
		    $this->load->model('User_model');
        $this->load->model('Jurusan_model');
        $this->load->helper('url');
        $this->load->library('upload');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
	   }

   public function index()
        {
     
          $a['judul']="Tampil User Admin/Administrator";
          $a['title']="User Admin/Administrator";
          $a['Tabel']="Daftar User Admin/Administrator";
          $isi='User/User';
          $a['user']=$this->User_model->tampil();
          $this->template->load('template',$isi,$a);
         }

    public function add_data()
      {
            $a['Tabel']="Input User Admin/Administrator";
            $a['title']="User";
            $a['judul']="Input User Admin/Administrator";
            $isi="User/input_user";
            $a['jurusan']=$this->Jurusan_model->tampil(); 
            $this->template->load('template',$isi,$a);
      }
      // public function Profil()
      // {
      //       $a['Tabel']="Input User Admin/Administrator";
      //       $a['title']="User";
      //       $a['judul']="Input User Admin/Administrator";
      //       $isi="Profile/Profil";
      //       $this->template->load('template',$isi,$a);
      // }


    function insert_data(){
      $Username=$this->input->post('email');
      $cek=$this->User_model->cekusername($Username);
      if ($cek=='') {
        $nmfile=$this->input->post('nama');
        $config['upload_path']  = 'adminBSB/images/user/';
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
                  <span data-notify='title'>Notifikasi User</span>
                  <br> 
                  <span data-notify='message'>Data User Gagal di Input.". $a.".</span>
                  </div>");

                redirect('user/add_data','refresh');  
            }else{
              $gbr =$this->upload->data();
              $foto=$gbr['file_name'];
              $this->User_model->fill_data($foto);
                if ($this->User_model->insert_data()) {
                  
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Data User berhasil di Input.</span>
                  </div>');

                  redirect('user/index','refresh');
                }else{
                  $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Data User Gagal di Input.</span>
                  </div>');
                }
            }
        }else{
          $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                    <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Alamat Email Sudah Ada.</span>
                  </div>');
          Redirect('user/add_data','refresh');
        }
      }


    public function edit_data(){

        $id=$this->uri->segment(3);
        $where=array('idlogin'=>$id); 
        $a['judul']="Tampil Edit Data User Admin/Administrator";
        $a['title']="User Admin/Administrator";
        $a['Tabel']="Data User Admin/Administrator";
        $isi='User/edit_user';
        $a['jurusan']=$this->Jurusan_model->tampil(); 
        $a['list'] = $this->User_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
     }

   	public function update_data()
    {
   
      $nmfile=$this->input->post('nama');
      $path   = 'adminBSB/images/user/';
      $config['upload_path']  = $path;
      $config['allowed_types']= 'gif|jpg|jpeg|bmp|png';
      $config['max_size']= '2088';
      $config['max_width']= '1288';
      $config['max_height']= '768';
      $config['file_name']= $nmfile.date('his');
   
         $this->upload->initialize($config);
   
         $idgbr      = $this->input->post('idlogin'); 
         $filelama   = $this->input->post('filelama'); 
         $nama       = $this->input->post('nama'); 


       if(!$_FILES['userfile']['name']== '')
       {
           if (!$this->upload->do_upload('userfile'))
           {
                $er_upload=$this->upload->display_errors();
                 $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi User</span>
                  <br> 
                  <span data-notify='message'>Data User ". $nama ." gagal di update ". $er_upload.".</span>
                  </div>");

                redirect('user/index','refresh');  
          
   
             }else{  
              
                $gbr = $this->upload->data();
                  $data = array(
                    'foto'=>$gbr['file_name'],         
                    'username'=>$this->input->POST('email'),
          					'level'=>$this->input->POST('level'),
          					'level'=>$this->input->POST('level'),
                    'kodejurusan'=>$this->input->POST('jurusan'),
                 );
   
                 @unlink($path.$filelama);
   
                 $where =array('idlogin'=>$idgbr);
                 $this->User_model->get_update($data,$where); 
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Edit User berhasil di update.</span>
                  </div>');
                 redirect('user/index','refresh');
             }

         }else{ 
   
             $data = array(
                  'username'=>$this->input->POST('email'),
        					'level'=>$this->input->POST('level'),
        					'nama'=>$this->input->POST('nama'),
                  'kodejurusan'=>$this->input->POST('jurusan'),
             );
   
             $where =array('idlogin'=>$idgbr); 
             $this->User_model->get_update($data,$where); 
                             $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Edit data User berhasil di update.</span>
                  </div>');
                 redirect('user/index','refresh');
          }
    }


    public function hapus_data(){

         $idgbr  = $this->uri->segment(3);
         $path= 'adminBSB/images/User/';
         $where  = array('idlogin'=>$idgbr);
         $rowdel = $this->User_model->get_byimage($where);
   
         @unlink($path.$rowdel->foto);

          $this->User_model->get_delete($where); 
           $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Data User berhasil di Hapus.</span>
                  </div>');
          
          redirect('user/index','refresh');

     }

     public function edit_pasword(){

        $id=$this->uri->segment(3);
        $where=array('idlogin'=>$id); 
        $a['judul']="Ganti Paaword User Admin/Administrator";
        $a['title']="User Admin/Administrator";
        $isi='User/ganti_pass_user';
        $a['list'] = $this->User_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
     }

    public function update_pasword(){

        $id      = $this->input->post('idlogin'); 
        $data = array('password'=>md5($this->input->POST('password')),);
        $where =array('idlogin'=>$id); 
        $this->User_model->get_update($data,$where); 
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Password berhasil di Ubah.</span>
                  </div>');
                 redirect('user/index','refresh');
     }
    

}
