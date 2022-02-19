        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
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
                                <a href="<?php echo base_url()?>mahasiswa/add_data"><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <?php echo $title?></button></a>
                                 <a href="<?php echo base_url()?>mahasiswa/import_data"><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-import"></i> <?php echo $title?></button></a>
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nim</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                              <th>No</th>
                                            <th>Nim</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php                                                                                                       
                                        if (!empty($Mahasiswa)) {
                                        $no=1;

                                        foreach ($Mahasiswa as $row) {
                                            if($row->jk=="L"){
                                                $jk="Laki-Laki";
                                            }else{
                                                $jk="Perempuan";
                                            }
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->nim ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $jk ?></td>
                                           
                                            <td>
                                            <?php
                                                if($row->foto==''){?>
                                                <img src="<?php echo base_url()?>/adminBSB/images/user/mahasiswa/Profile_kosong.png" alt="user-img" class="img-rounded" height="40px" width="40px"> 
                                               <?php     
                                                }else{

                                                
                                            ?>
                                            <img src="<?php echo base_url()?>/adminBSB/images/user/mahasiswa/<?= $row->foto ?>" alt="user-img" class="img-rounded" height="40px" width="40px"> 
                                            <?php     
                                               }
                                            ?>
                                            </td>
                                            <td>
                                            <p>
                                                <a class="btn btn-xs btn-primary waves-effect edit-kategori" href="<?=base_url().'/mahasiswa/edit_data/'. $row->nim;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                                <a class="btn btn-xs btn-success waves-effect" href="<?=base_url().'/mahasiswa/detail_data/'. $row->nim;?>" title="Detail" \><i class="glyphicon glyphicon-arrow-right"></i></a>
                                            </p>
                                            <p>
                                                <a class="btn btn-xs btn-warning waves-effect ganti-pass-User" href="<?=base_url().'mahasiswa/update_pasword/'. $row->nim;?>" title="Ganti Password"> <i class="glyphicon glyphicon-lock"></i></a>
                                                <a class='btn btn-xs btn-danger waves-effect hapus-kategori' href='<?=base_url().'/mahasiswa/hapus_data/'. $row->nim;?>'><i class='glyphicon glyphicon-trash'></i></a>
                                            </p>
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


$(document).on("click",".hapus-kategori",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus data Mahasiswa ini?",
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

$(document).on("click",".edit-kategori",function(){
    var edit_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Mau Edit data Mahasiswa ini?",
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
        text:"Mau Reset Password Mahasiswa ini?",
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