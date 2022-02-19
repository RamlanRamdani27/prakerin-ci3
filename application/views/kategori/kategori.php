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
                                <a href="<?php echo base_url()?>kategori/add_data" clas><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <?php echo $title?></button></a>
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kategori</th>
                                            <th>Nama Kategori</th>
                                            <th>Keterangan</th>
                                            <th>icon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kategori</th>
                                            <th>Nama Kategori</th>
                                            <th>Keterangan</th>
                                            <th>icon</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                       
                                        if (!empty($kategori)) {
                                        $no=1;

                                        foreach ($kategori as $row) {
                                            
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idkategori ?></td>
                                            <td><?= $row->namakategori ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td>
                                            <img src="<?php echo base_url()?>/adminBSB/images/kategori/<?= $row->ikon ?>" alt="user-img" class="img-rounded" height="40px" width="40px"> 
                                            </td>
                                            <td>
                                            <a class="btn btn-xs btn-primary edit-kategori" href="<?=base_url().'/kategori/edit_data/'. $row->idkategori;?>" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
                                            <a class='btn btn-xs btn-danger hapus-kategori' href='<?=base_url().'/kategori/hapus_data/'. $row->idkategori;?>'><i class='glyphicon glyphicon-trash'></i></a>
                                           

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