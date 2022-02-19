<div class="block-header">
    <h1>
        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <?php
             if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
            ?>
            <li><a href="<?php echo base_url()?>pengajuan/index">Pengajuan</a></li>
            <?php
            }else{
            ?>
            <li><a href="<?php echo base_url()?>pengajuan/index_mahasiswa">Pengajuan</a></li>
            <?php    }
            ?>
            <li class="active"><?php echo $judul?></li>
        </ol>    
    </h1>           
</div>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                        <div class="header">
                            <h2>
                                <?php echo $Tabel?> <?= $list->idpengajuan ?>
                                <ul class="header-dropdown m-r--5">
                                    <a class="btn btn-xs btn-info  edit-pengajuan" href="<?=base_url().'pengajuan/edit_data/'. $list->idpengajuan;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                </ul>    
                                
                           </h2>  
                        </div>
                        <div class="body table-responsive">
                            <table class="table" border="0">
                                <tbody>
                                    <tr>
                                        <td>Industri</td>
                                        <td><?= $list->namaindustri ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <?php
                                            $alamat_kecil = strtolower($list->alamat.", ".$list->namakecamatan.", ".$list->namakota.", ".$list->name." -  " .  $list->cp);
                                            $alamat_new = ucwords($alamat_kecil);
                                        ?>
                                        <td><?= $alamat_new ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Prakerin</td>
                                        <td><?= date("d-m-Y", strtotime($list->tglmulai)) ?></td>
                                         <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir Prakerin</td>
                                        <td><?= date("d-m-Y", strtotime($list->tglakhir)) ?></td>
                                        <td></td>
                                    </tr>
                                    <tr> 
                                        <td>Jumlah Prakerin</td>
                                        <td><?= $list->jumlah ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Penginput</td>
                                        <td><?= $list->user_input ?></td>
                                        <td></td>
                                    </tr>
                                    <!-- <tr>
                                        <td></td>
                                        <td> 
                                        <img src="<?php //echo base_url().$list->barcode; ?>" height="62px" width="154px"/>
                                        </td>
                                        <td> </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>

                        <div class="header">
                            <h2>
                            <?php echo $header_title?>
                            
                               <?php
                                    if ($list->jumlah > $total->jumlah_pengajuan ) {
                                        $jmlpengajuan=$list->jumlah;
                                        $jmldetail=$total->jumlah_pengajuan;
                                        $total=$jmlpengajuan- $jmldetail;
                                        // echo $total;
                                      ?>
                                     
                                    <div class="header-dropdown m-r--5">
                                        <a  href='<?=base_url().'pengajuan/tambah_detail_data/'. $total.'/'.$list->idpengajuan;?>'><button class="btn btn-xs btn-success">
                                        <i class="glyphicon glyphicon-plus"></i></button></a>
                                    </div>

                                <?php      
                                    }
                                    ?>   
                           </h2>  
                        </div>
                            <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                                                                                       
                                    
                                         if (!empty($listt)) {
                                            $no=1;
                                        foreach ($listt as $row) {
                                            
                                         
                                            ?>
                                    <tr>
                                        <td><?= $no ?></td>

                                        <td><?= $row->nim ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->notelepon ?></td>
                                        <td>
                                            <a class='btn btn-xs btn-danger hapus-pengajuan' href='<?=base_url().'pengajuan/hapus_data_mahasiswa/'. $row->idpengajuan.'/'.$row->nim;?>' title="Hapus"><i class='glyphicon glyphicon-trash'></i></a>
                                            <a class="btn btn-xs btn-primary edit-pengajuan" href="<?=base_url().'pengajuan/edit_data_detail/'. $row->idpengajuan.'/'.$row->nim;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                        </td>
                                    <?php
                                     $no++;
                                        } 
                                      
                                    }
                                    $status_diterima=2;
                                    $status_tidak_diterima=3;
                                        ?>
                                </tbody>
                            </table>
                            <?php
                                 if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                ?>
                               <a href="<?php echo base_url()?>pengajuan/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php
                                }else{
                                ?>
                              <a href="<?php echo base_url()?>pengajuan/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php    }
                            ?>
                            

                            <?php 
                            if ($list->status_aprove==3 or $list->status_aprove==2) {
                                

                                }else{
                             ?>
                             <a href="<?php echo base_url().'pengajuan/transaksi_ditolak/'. $list->idpengajuan.'/'.$status_tidak_diterima;?>"><button type="button" class="btn btn-danger waves-effect" title="Tidak Di terima"><i class="material-icons">clear</i></button></a>
                            <a href="<?php echo base_url().'prakerin/proses_transaksi/'. $list->idpengajuan.'/'.$status_diterima;?>" title="Di terima"><button type="button" class="btn btn-success waves-effect"><i class="material-icons">done_all</i></button></a>

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
        text:"Mau Edit pengajuan ini?",
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