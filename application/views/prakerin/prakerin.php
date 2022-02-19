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
                                            <th>ID Prakerin</th>
                                            <th>Nama Industri</th>
                                            <th>Nim</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Prakerin</th>
                                            <th>Nama Industri</th>
                                            <th>Nim</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                        
                                        if (!empty($prakerin)) {
                                            $no=1;
                                        foreach ($prakerin as $row) {
                                             if($row->status==1){
                                                $ket="<span class='label label-info'>Sudah Di Terima Industri</span>";
                                             }else if($row->status==2){
                                                $ket="<span class='label bg-light-blue'>Mulai Prakerin</span>";
                                             }else if($row->status==3){
                                                $ket="<span class='label label-success'>Sudah Selesai Prakerin</span>";
                                             }
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idprakerin ?></td>
                                            <td><?= $row->namaindustri ?></td>
                                            <td><?= $row->nim ?></td>
                                            <td><?= $ket ?></td>
                                            <td>
                                            <p>
                                                <a class="btn btn-xs btn-info" href="<?=base_url().'prakerin/detail_data/'. $row->idprakerin;?>" title="Detail"> <i class="glyphicon glyphicon-arrow-right"></i></a>
                                                <?php
                                                if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                                ?>
                                                <a class='btn btn-xs btn-danger hapus-pengajuan' href='<?=base_url().'prakerin/hapus_data/'. $row->idprakerin;?>' title="Hapus"><i class='glyphicon glyphicon-trash'></i></a>
                                                <?php
                                                 }
                                                ?>
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