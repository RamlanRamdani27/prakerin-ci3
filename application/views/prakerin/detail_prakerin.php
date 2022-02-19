<div class="block-header">
     <h1>
        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <?php
            if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
            ?>
           <li><a href="<?php echo base_url()?>prakerin/index">Prakerin</a></li>
            <?php
            }else{
            ?>
             <li><a href="<?php echo base_url()?>prakerin/index_mahasiswa">Prakerin</a></li>
            <?php    }
             ?>            
            
            <li class="active"><?php echo $judul?></li>
        </ol>    
    </h1>           
</div>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $Tabel?> 
                                <?php echo '('.$list->idprakerin.')' ?>
                                <ul class="header-dropdown m-r--5">
                                    <a class="btn btn-xs btn-info  edit-pengajuan" href="<?=base_url().'prakerin/edit_data/'. $list->idprakerin;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a> 
                                </ul>
                           </h2>  
                        </div>
                        
                        <div class="body table-responsive">
                        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                        <?php
                            if ($list->pembimbing_kampus=="" And $list->pembimbing_perusahaan=="" And $list->idbidang=="BDN1711000001") {?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Data Prakerin Pembimbing Kampus, Pembimbing Industri kosong dan Bidang Belum Di pilih
                                </div>
                        <?php
                           }else if ($list->pembimbing_perusahaan=="") {?>
                                 <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Data Prakerin Pembimbing Industri Tidak Ada
                                </div>      
                        <?php
                            }else if ($list->idbidang=="BDN1711000001") {?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Data Prakerin Bidang Belum Di pilih
                                </div>
                        <?php }else if($list->pembimbing_kampus==""){
                           ?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Data Prakerin Pembimbing Kampus Tidak Ada
                                </div>
                        <?php }
                        ?>
                        
                            <table class="table" border="0">
                                <tbody>
                                    <tr>
                                        <td>Nama Industri</td>
                                        <td><?= $list->namaindustri ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <?php
                                            $alamat_kecil = strtolower($list->alamatindustri." ".$list->namakecamatan.", ".$list->namakota.", ".$list->name." -  " .  $list->cp);
                                            $alamat_new = ucwords($alamat_kecil);
                                        ?>
                                        <td><?= $alamat_new ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nim</td>
                                        <td><?= $list->nim ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td><?= $list->nama ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Prakerin</td>
                                        <td><?= date("d F Y", strtotime($list->tglmulai)) ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir Prakerin</td>
                                        <td><?= date("d F Y", strtotime($list->tglselesai)) ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><?= $list->keterangan_prakerin ?></td>
                                        <td></td>
                                    </tr>
<!--                                     <tr>
                                        <td>Status</td>
                                        <td><?//= $list->status ?></td>
                                        <td></td>
                                    </tr> -->
                                    <tr>
                                        <td>Pembimbing Kampus</td>
                                        <td><?= $list->pembimbing_kampus ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Pembimbing Perusahaan</td>
                                        <td><?= $list->pembimbing_perusahaan ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Bidang</td>
                                        <td><?= $list->namabidang ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php 
                            if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                ?>
                           <a href="<?php echo base_url()?>prakerin/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                           <?php
                                }else{
                             ?>
                             <a href="<?php echo base_url()?>prakerin/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                             <?php 
                            }
                             ?>
                           <?php 
                                if ($list->status==1) {
                                    ?>
                                    <a href="<?php echo base_url().'prakerin/mulai_prakerin/'. $list->idprakerin.'/2';?>" title="Mulai Prakerin"><button type="button" class="btn btn-sm btn-success waves-effect"><i class="material-icons">done_all</i></button></a>
                                <?php
                                    }else if ($list->status==2){
                                 ?>
                                 <a href="<?php echo base_url().'prakerin/prakerin_selesai/'. $list->idprakerin.'/3';?>"><button type="button" class="btn btn-sm btn-danger waves-effect" title="Prakerin Selesai"><i class="material-icons">clear</i></button></a>
                                <?php 
                                }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">
$(function(){

$.ajaxSetup({
    type:"post",
    cache:false,
    dataType: "json"
});


$(document).on("click",".hapus-pengajuan",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus mahasiswa ini?",
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

$(document).on("click",".edit-pengajuan",function(){
    var edit_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Mau Edit Data Prakerin ini?",
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