<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	function __construct(){
		    parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		    $this->load->model('Mahasiswa_model');
        $this->load->model('Jurusan_model');
        $this->load->helper('url');
        $this->load->library('upload');
       
        if ($this->session->userdata('SESS_USERNAME')==null) {
        redirect('login/index','refresh');
        }
	}

   public function index()
        {
     
          $a['judul']="Tampil Mahasiswa";
          $a['title']="Mahasiswa";
          $a['Tabel']="Daftar Mahasiswa";
          $isi='Mahasiswa/Mahasiswa';
          $a['Mahasiswa']=$this->Mahasiswa_model->tampil();
          $this->template->load('template',$isi,$a);
         }

    public function add_data()
      {
            $a['Tabel']="Input Data Mahasiswa";
            $a['title']="Mahasiswa";
            $a['judul']="Input Data Mahasiswa";
            $isi="Mahasiswa/input_mahasiswa";
            $a['jurusan']=$this->Jurusan_model->tampil(); 
            $this->template->load('template',$isi,$a);
      }
   function insert_data(){
        $Nim=$this->input->post('nim');
        $cek=$this->Mahasiswa_model->ceknim($Nim);
        if ($cek=='') {
          $nmfile=$this->input->post('nama');
          $config['upload_path']  = 'adminBSB/images/user/Mahasiswa/';
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
                    <span data-notify='title'>Notifikasi Mahasiswa</span>
                    <br> 
                    <span data-notify='message'>Data Mahasiswa Gagal di Input.". $a.".</span>
                    </div>");

                  redirect('mahasiswa/add_data','refresh');  
                }else{
                  $gbr =$this->upload->data();
                  $foto=$gbr['file_name'];
                  $this->Mahasiswa_model->fill_data($foto);
                    if ($this->Mahasiswa_model->insert_data()) {
                      
                     $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Mahasiswa</span>
                      <br> 
                      <span data-notify="message">Data Mahasiswa berhasil di Input.</span>
                      </div>');

                      redirect('mahasiswa/index','refresh');
                    }else{
                      $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Mahasiswa</span>
                      <br> 
                      <span data-notify="message">Data Mahasiswa Gagal di Input.</span>
                      </div>');
                    }
                }
            }else{
              $this->session->set_flashdata('msg', 
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                      <span data-notify="icon"></span> 
                      <span data-notify="title">Notifikasi Mahasiswa</span>
                      <br> 
                      <span data-notify="message">Nim Sudah Ada.</span>
                      </div>');
              Redirect('mahasiswa/add_data','refresh');
            }
        }


    public function edit_data(){

        $nim=$this->uri->segment(3);
        $where=array('nim'=>$nim); 
        $a['judul']="Tampil Edit data Mahasiswa";
        $a['title']="Mahasiswa";
        $a['Tabel']="Edit data Mahasiswa";
        $isi='Mahasiswa/edit_mahasiswa';
        $a['list'] = $this->Mahasiswa_model->get_byimage($where);
        $a['jurusan']=$this->Jurusan_model->tampil(); 
        $this->template->load('template',$isi,$a);
     }
     public function detail_data(){

        $nim=$this->uri->segment(3);
        $where=array('nim'=>$nim); 
        $a['judul']="Tampil detail data Mahasiswa";
        $a['title']="Mahasiswa";
        $a['Tabel']="Detail data Mahasiswa";
        $isi='Mahasiswa/detail_mahasiswa';
        $a['list'] = $this->Mahasiswa_model->get_byimage($where);
        $this->template->load('template',$isi,$a);
     }

   public function update_data()
    {
   
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
                  <span data-notify='title'>Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify='message'>Data Mahasiswa ". $nama ." gagal di update ". $er_upload.".</span>
                  </div>");

                redirect('mahasiswa/index','refresh');  
          
   
             }else{  
              
                $gbr = $this->upload->data();
                  $data = array(
                    'foto'=>$gbr['file_name'],         
                    'nim'=>$this->input->POST('nim'),
                    'nama'=>$this->input->POST('nama'),
                    'jk'=>$this->input->POST('jk'),
                    'idjurusan'=>$this->input->POST('jurusan'),
                    'alamat'=>$this->input->POST('alamat'),
                 );
   
                 @unlink($path.$filelama);
   
                 $where =array('nim'=>$nim);
                 $this->Mahasiswa_model->get_update($data,$where); 
                 $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify="message">Edit Mahasiswa berhasil di update.</span>
                  </div>');
                 redirect('mahasiswa/index','refresh');
             }

         }else{ 
   
             $data = array(
                    'nim'=>$this->input->POST('nim'),
                    'nama'=>$this->input->POST('nama'),
                    'jk'=>$this->input->POST('jk'),
                    'idjurusan'=>$this->input->POST('jurusan'),
                    'alamat'=>$this->input->POST('alamat'),
             );
   
             $where =array('nim'=>$nim); 
             $this->Mahasiswa_model->get_update($data,$where); 
                             $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify="message">Edit dara Mahasiswa berhasil di update.</span>
                  </div>');
                 redirect('mahasiswa/index','refresh');
          }
    }


    public function hapus_data(){

         $nim  = $this->uri->segment(3);
         $path= 'adminBSB/images/user/Mahasiswa/';
         $where  = array('nim'=>$nim);
         $rowdel = $this->Mahasiswa_model->get_byimage($where);
   
         @unlink($path.$rowdel->foto);

          $this->Mahasiswa_model->get_delete($where); 
           $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify="message">Data Mahasiswa berhasil di Hapus.</span>
                  </div>');
          
          redirect('mahasiswa/index','refresh');

     }

    public function import_data()
      {
            $a['Tabel']="Import Data Mahasiswa";
            $a['title']="Mahasiswa";
            $a['judul']="Import Data Mahasiswa";
            $isi="Mahasiswa/import_mahasiswa_excel";
            $a['jurusan']=$this->Jurusan_model->tampil(); 
            $this->template->load('template',$isi,$a);
      }



    public function insert_data_import()
      {
        $fileName = $this->input->post('file', TRUE);
       
        $config['upload_path'] = './adminBSB/excel/'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['encrypt_name']= TRUE;
        $config['max_size'] = 0;
       
        // $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        
        if (!$this->upload->do_upload('file')) {
         $error = $this->upload->display_errors();
         $this->session->set_flashdata("msg", 
                "<div data-notify='container' class='bootstrap-notify-container alert alert-dismissible alert-danger p-r-35 animated rotateInUpRight' role='alert' data-notify-position='top-right' style='display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;'>
                  <button type='button' aria-hidden='true' class='close' data-notify='dismiss' style='position: absolute; right: 10px; top: 5px; z-index: 1033;'>×</button>
                  <span data-notify='icon'></span> 
                  <span data-notify='title'>Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify='message'>File Data Mahasiswa ". $fileName ." gagal di import ". $error.".</span>
                  </div>");

          redirect('mahasiswa/import_data','refresh');  
       } else {
         $media = $this->upload->data();
         $inputFileName = './adminBSB/excel/'.$media['file_name'];
         
         try {
          $inputFileType = IOFactory::identify($inputFileName);
          $objReader = IOFactory::createReader($inputFileType);
          $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
          die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
       
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
       
        for ($row = 2; $row <= $highestRow; $row++){ 
         $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
           NULL,
           TRUE,
           FALSE);
         $kodejurusan=$rowData[0][3];
         $where=array('nim'=>trim(preg_replace("/[^a-zA-Z0-9]/", "", $rowData[0][0])));
         $ambiljurusan=$this->Mahasiswa_model->ambil_jurusan($kodejurusan);
         if (!$ambiljurusan=='') {
              $kode=$ambiljurusan->idjurusan;
            }
            // else{
            //   $kode='JRS1711000004';
            // }
         $data = array(
                    'nim'=>trim(preg_replace("/[^a-zA-Z0-9]/", "", $rowData[0][0])),
                    'password'=>md5($rowData[0][0]),
                    'nama'=>$rowData[0][1],
                    'jk'=>$rowData[0][2],
                    // 'idjurusan'=>$rowData[0][3],
                    'idjurusan'=>$kode,
                    'alamat'=>$rowData[0][4],
                    );
           $cek= $this->Mahasiswa_model->cek_import_data($where);   
            if ($cek=='') {
               $this->Mahasiswa_model->import_data($data);
            }
        
       } 
        @unlink($inputFileName); // hapus file temp
         $count = $highestRow;
         $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi Mahasiswa</span>
                  <br> 
                  <span data-notify="message">Import data Mahasiswa berhasil di input.</span>
                  </div>');
          
          redirect('mahasiswa/index','refresh');
       
        }
      }


      public function update_pasword(){
        $nim=$this->uri->segment(3);
        $where=array('nim'=>$nim); 
        $password= array('password' => md5($nim) );
        $this->Mahasiswa_model->ganti_passsword_mahasiswa($where,$password);
        $this->session->set_flashdata('msg', 
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-light-green p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; right: 20px;">
                  <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
                  <span data-notify="icon"></span> 
                  <span data-notify="title">Notifikasi User</span>
                  <br> 
                  <span data-notify="message">Password berhasil di Ubah.</span>
                  </div>');
       redirect('mahasiswa/index','refresh');
       
     }
    
}
