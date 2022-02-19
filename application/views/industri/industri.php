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
                                <?php echo $judul?>
                                <a href="<?php echo base_url()?>industri/add_data" clas><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <?php echo $title?></button></a>
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Industri</th>
                                            <th>Kategori</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                                           
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Industri</th>
                                            <th>Kategori</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                                           
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                       
                                        if (!empty($industri)) {
                                        $no=1;

                                        foreach ($industri as $row) {
                                            $alamat_kecil = strtolower($row->alamat.", ".$row->namakecamatan.", ".$row->namakota.", ".$row->name);
                                            $alamat_new = ucwords($alamat_kecil);
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->namaindustri ?></td>
                                            <td><?= $row->namakategori ?></td>
                                            <td><?= $alamat_new ?></td>
                                            <td><?= $row->cp ?></td>
                                            <td>
                                            <a class="btn btn-xs btn-primary edit-kategori" href="<?= base_url().'/industri/edit_data/'.$row->idindustri;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                            <a class="btn btn-xs btn-success waves-effect detail" href="<?=base_url().'/industri/detail_data/'. $row->idindustri;?>" title="Detail" \><i class="glyphicon glyphicon-arrow-right"></i></a>
                                            <a class='btn btn-xs btn-danger hapus-kategori' href='<?=base_url().'/industri/hapus_data/'. $row->idindustri;?>'><i class='glyphicon glyphicon-trash'></i></a>
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
})


$(document).on("click",".hapus-kategori",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus kategori ini?",
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
        text:"Mau Edit kategori ini?",
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
