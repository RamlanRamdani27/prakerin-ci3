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
                                
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pengajuan</th>
                                            <th>Tanggal mengajukan</th>
                                            <th>Nama Industri</th>
                                            <th>Status</th>
                                            <th>Penginput</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pengajuan</th>
                                            <th>Tanggal mengajukan</th>
                                            <th>Nama Industri</th>
                                            <th>Status</th>
                                            <th>Penginput</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                        
                                        if (!empty($pengajuan)) {
                                        $no=1;
                                        $terima=2;
                                        $tidak_diterima=3;
                                        $ket;
                                        foreach ($pengajuan as $row) {
                                            if ($row->status_aprove==1) {
                                               $ket="<span class='label label-warning'>Baru Mengajukan Surat</span>";
                                            }else if ($row->status_aprove==2) {
                                                $ket="<span class='label label-success'>Sudah Di Terima Industri</span>";
                                            }else{
                                                 $ket="<span class='label label-danger'>Tidak Di Terima Industri</span>";
                                            }
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idpengajuan ?></td>
                                            <td><?= date("d F Y", strtotime($row->tglpengajuan)) ?></td>
                                            <td><?= $row->namaindustri ?></td>
                                            <td><?= $ket ?></td>
                                            <td><?= $row->user_input ?></td>
                                            <td>
                                            <p>
                                                <a class="btn btn-xs btn-info" href="<?=base_url().'pengajuan/detail_data_kajur/'. $row->idpengajuan;?>" title="Detail"> <i class="glyphicon glyphicon-arrow-right"></i></a>
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


$(document).on("click",".hapus-pengajuan",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus pengajuan ini?",
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