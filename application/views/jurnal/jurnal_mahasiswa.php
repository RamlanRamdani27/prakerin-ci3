        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index_mahasiswa">Home</a></li>
                                <li class="active"><?php echo $title?></li>
                            </ol>    
                      </h1>           
        </div>

            <div class="row clearfix">
            <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $Tabel?>
                                <?php
                                $ket=""; 
                                if ($prakerin->status==1) {
                               $ket="<div class='alert alert-warning alert-dismissible' role='alert'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                       Konfirmasi Mulai Prakerin Dahulu di Detail Prakerin
                                    </div> ";
                                }else if ($prakerin->status==2) {
                                ?>
                                <a href="<?php echo base_url()?>jurnal/add_data/<?=$idprakerin?>" clas><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i></button></a>
                                <?php
                                    }else if ($prakerin->status==3){
                                 ?>
                                <a class='btn bg-orange waves-effect' href='<?=base_url().'jurnal/cetak_jurnal/'. $idprakerin.'/'.$idjurnal;?>' title="Cetak" target="_blank"><i class='glyphicon glyphicon-print'></i></a>
                            <?php 
                            }else if($prakerin->status==""){


                             ?>
                             
                             <?php 
                            }
                             ?>
                           </h2>  
                        </div>
                        <div class="body">
                         <?php echo $ket?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurnal</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurnal</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                       
                                        if (!empty($jurnal)) {
                                        $no=1;

                                        foreach ($jurnal as $row) {
                                            
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idjurnal ?></td>
                                            <!-- <td><?//= $row->idprakerin ?></td> -->
                                            <td><?= date("d F Y", strtotime($row->tanggal_kegiatan)) ?></td>
                                            <td><?= $row->kegiatan ?></td>
                                            <td><?= $row->status ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-primary edit-User" href="<?=base_url().'/jurnal/edit_data/'. $row->id;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                                <a class='btn btn-xs btn-danger hapus-User' href='<?=base_url().'/jurnal/hapus_data/'. $row->id;?>' title="Hapus"><i class='glyphicon glyphicon-trash'></i></a>
                                            </td>
                                        </tr>
                                            <?php
                                            $no++;
                                        }
                                    }
                                        ?>
                                                     
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
            
            
<script type="text/javascript">
$(function(){

$.ajaxSetup({
    type:"post",
    cache:false,
    dataType: "json"
});


$(document).on("click",".hapus-User",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus data Juranl ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc143c",
        confirmButtonText: "Hapus",
        closeOnConfirm: false,
    },
        function(){
           
         window.location.href = delete_url;
          
    });
    return false;
});

$(document).on("click",".edit-User",function(){
    var edit_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Mau Edit data Jurnal ini?",
        showCancelButton: true,
        confirmButtonColor: "#ff7f50",
        confirmButtonText: "Edit",
        closeOnConfirm: false,
    },
        function(){

         window.location.href = edit_url;
        

    });
    return false;
});

$(document).on("click",".ganti-pass-User",function(){
    var edit_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Mau Reset Password Akun ini?",
        showCancelButton: true,
        confirmButtonColor: "#ff7f50",
        confirmButtonText: "Edit",
        closeOnConfirm: false,
    },
        function(){

         window.location.href = edit_url;
        

    });
    return false;
});

$('#notifications').slideDown('slow').delay(3000).slideUp('slow');

});
</script>