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
                                <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <?php echo $title?></button>
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Jurusan</th>
                                            <th>Kode Jurusan</th>
                                            <th>Nama Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Jurusan</th>
                                            <th>Kode Jurusan</th>
                                            <th>Nama Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                       
                                        if (!empty($jurusan)) {
                                        $no=1;

                                        foreach ($jurusan as $row) {
                                            
                                         
                                            ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idjurusan ?></td>
                                            <td><?= $row->kodejurusan ?></td>
                                            <td><?= $row->namajurusan ?></td>
                                            <td>
                                            <a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('<?=$row->idjurusan;?>')"><i class="glyphicon glyphicon-pencil"></i> </a>
                                            <a class="btn btn-xs btn-danger hapus-jurusan" href='<?=base_url().'/jurusan/ajax_delete/'. $row->idjurusan;?>'><i class="glyphicon glyphicon-trash"></i> </a>
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

var save_method; //for save method string
// var table=document.getElementsById('#dynamic-table');

$(document).ready(function() {

    //datatables
  

    //datepicker



    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(' Add <?php echo $title?>'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Jurusan/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {



            $('[name="id"]').val(data.id);
            $('[name="idjurusan"]').val(data.idjurusan);
            $('[name="kodejurusan"]').val(data.kodejurusan);
            $('[name="namajurusan"]').val(data.namajurusan);
            
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit <?php echo $title?>'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    // $('#dynamic-table').ajax.reload(null,false); //reload datatable ajax 
    window.location.reload();
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('Jurusan/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Jurusan/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                 window.location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

$(document).on("click",".hapus-jurusan",function(){
    var delete_url=$(this).attr("href");
    swal({
        title:"Alert",
        text:"Yakin akan menghapus Jurusan ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc143c",
        confirmButtonText: "Hapus",
        closeOnConfirm: false,
    },
        function(){

         window.location.href = delete_url;


    }

    );
    return false;
});


$('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-color panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="panel-title"><?php echo $title?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                     <div class="modal-body">
                                <div class="form-group form-float">
                                    <label class="form-label">ID Jurusan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="idjurusan" value="<?=$kode?>" readonly>
                                    </div>
                                </div>
                                <br>
                                
                                <div class="form-group form-float">
                                 <label class="form-label">Kode Jurusan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="kodejurusan" required>
                                       
                                    </div>
                                    
                                </div> 
                                <br>
                                <div class="form-group form-float">
                                 <label class="form-label">Nama Jurusan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="namajurusan" required>
                                       
                                    </div>
                                    
                                </div> 
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
