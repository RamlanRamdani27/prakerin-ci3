<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	  function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->model('User_model');
        $this->load->model('Mahasiswa_model');
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
    }
	public function Profil_admin()
      {
      		$username=$this->uri->segment(3);
      		$where=array('idlogin'=>$username);
            $a['Tabel']="Admin/Administrator";
            $a['title']="Profil Admin";
            $a['judul']="Admin/Administrator";
            $isi="profile/profil";
            $a['list'] = $this->User_model->get_byimage($where);
            $this->template->load('template',$isi,$a);
      }
     public function Profil_mahasiswa()
      {
      		$nim=$this->uri->segment(3);
        	$where=array('nim'=>$nim); 
            $a['Tabel']="Mahasiswa";
            $a['title']="Profil Mahasiswa";
            $a['judul']="Mahasiswa";
            $isi="profile/profil_mahasiswa";
            $a['list'] = $this->Mahasiswa_model->get_byimage($where);
            $this->template->load('template',$isi,$a);
      }

  public function update_data(){
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
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Data Profil ". $nama ." gagal di update ". $er_upload.".</span>
                  </div>");

                $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_admin/'.$username;
                 redirect($link,'refresh');
          
   
             }else{  
              
                $gbr = $this->upload->data();
                  $data = array(
                    'foto'=>$gbr['file_name'],         
                    'nama'=>$this->input->POST('nama'),
                 );
   
                 @unlink($path.$filelama);
   
                 $where =array('idlogin'=>$idgbr);
                 $this->User_model->get_update($data,$where); 
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Profil</span>
                  <br> 
                  <span data-notify="message">Profil berhasil di update.</span>
                  </div>');
                 $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_admin/'.$username;
                 redirect($link,'refresh');
             }

         }else{ 
   
             $data = array(
                  'nama'=>$this->input->POST('nama'),
             );
   
             $where =array('idlogin'=>$idgbr); 
             $this->User_model->get_update($data,$where); 
                             $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Profil</span>
                  <br> 
                  <span data-notify="message">Profil berhasil di update.</span>
                  </div>');
                  $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_admin/'.$username;
                 redirect($link,'refresh');
          }
  }
   



   public function passwordbaruu()
    {
        $id = $this->input->post('idlogin');
        $paslama = $this->input->post('paslama');

        $pas = $this->User_model->cekpass($id,$paslama);  
        if(!$pas){
            $data = array(
                'password' => MD5($this->input->post('pasbaru'))
            ); 
               
            $datt = $this->User_model->updatepassbaru($id,$data);  
             
            if($datt){
                 $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Profil</span>
                      <br> 
                      <span data-notify="message">Password berhasil di ubah.</span>
                      </div>');
                      $username=$this->session->userdata('SESS_USERNAME');
                      $link='profil/profil_admin/'.$username;
                     redirect($link,'refresh');
            }
            else{
               $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Password lama anda salah.</span>
                  </div>");

                $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_admin/'.$username;
                 redirect($link,'refresh');
          
            }
      }else{
        $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Password lama anda salah.</span>
                  </div>");

                $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_admin/'.$username;
                 redirect($link,'refresh');
          
      }
              
    }


    public function update_data_mahasiswa(){
      $nmfile=$this->input->post('nama');
      $path   = 'adminBSB/images/user/Mahasiswa/';
      $config['upload_path']  = $path;
      $config['allowed_types']= 'gif|jpg|jpeg|bmp|png';
      $config['max_size']= '2088';
      $config['max_width']= '1288';
      $config['max_height']= '768';
      $config['file_name']= $nmfile.date('his');
   
         $this->upload->initialize($config);
   
         $nim      = $this->input->post('nim'); 
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
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Data Profil ". $nama ." gagal di update ". $er_upload.".</span>
                  </div>");

                 $username=$this->session->userdata('SESS_USERNAME');
                 $link='profil/profil_mahasiswa/'.$username;
                 redirect($link,'refresh');
          
   
             }else{  
              
                $gbr = $this->upload->data();
                  $data = array(
                    'foto'=>$gbr['file_name'],         
                    'nama'=>$this->input->POST('nama'),
                    'jk'=>$this->input->POST('jk'),
                    'alamat'=>$this->input->POST('alamat'),
                 );
   
                 @unlink($path.$filelama);
   
                 $where =array('nim'=>$nim);
                 $this->Mahasiswa_model->get_update($data,$where); 
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Profil</span>
                  <br> 
                  <span data-notify="message">Profil berhasil di update.</span>
                  </div>');
                  $username=$this->session->userdata('SESS_USERNAME');
                 $link='profil/profil_mahasiswa/'.$username;
                 redirect($link,'refresh');
             }

         }else{ 
   
             $data = array(
                    'nama'=>$this->input->POST('nama'),
                    'jk'=>$this->input->POST('jk'),
                    'alamat'=>$this->input->POST('alamat'),
             );
   
             $where =array('nim'=>$nim); 
             $this->Mahasiswa_model->get_update($data,$where); 
                             $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Profil</span>
                  <br> 
                  <span data-notify="message">Profil berhasil di update.</span>
                  </div>');
                 $username=$this->session->userdata('SESS_USERNAME');
                 $link='profil/profil_mahasiswa/'.$username;
                 redirect($link,'refresh');
          }
    }

    public function passwordbaruu_mahasiswa()
    {
        $id = $this->input->post('nim');
        $paslama = $this->input->post('paslama');

        $pas = $this->Mahasiswa_model->cekpass($id,$paslama);  
        if(!$pas){
            $data = array(
                'password' => MD5($this->input->post('pasbaru'))
            ); 
               
            $datt = $this->Mahasiswa_model->updatepassbaru($id,$data);  
             
            if($datt){
                 $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Profil</span>
                      <br> 
                      <span data-notify="message">Password berhasil di ubah.</span>
                      </div>');
                      $username=$this->session->userdata('SESS_USERNAME');
                      $link='profil/profil_mahasiswa/'.$username;
                     redirect($link,'refresh');
            }
            else{
               $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Password lama anda salah.</span>
                  </div>");

                $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_mahasiswa/'.$username;
                 redirect($link,'refresh');
          
            }
      }else{
        $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Profil</span>
                  <br> 
                  <span data-notify='message'>Password lama anda salah.</span>
                  </div>");

                $username=$this->session->userdata('SESS_USERNAME');
                  $link='profil/profil_mahasiswa/'.$username;
                 redirect($link,'refresh');
          
      }
              
    }
   


}
