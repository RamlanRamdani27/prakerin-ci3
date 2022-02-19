
   
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li><a href="<?php echo base_url()?>mahasiswa/index">Mahasiswa</a></li>
                                <li class="active"><?php echo $judul?></li>
                            </ol>    
                      </h1>           
        </div>


            <!-- Basic Validation -->
            <div class="row clearfix">
                 <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $Tabel?></h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>mahasiswa/insert_data_import">
                            	<div class="form-group form-float">
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input id="uploadFile" class="form-control" placeholder="Pilih File..." disabled="disabled" />
                                        </div>
                                    </div>
                                    <div class="fileUpload btn btn-primary">
                                     <span>Upload</span>
                                        <input id="uploadImage" type="file" class="upload" name="file" id='files' required=""/>
                                       
                                    </div>
                                </div>
                                 <a href="<?php echo base_url()?>mahasiswa/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                 <button class="btn btn-warning waves-effect" type="reset">Reset</button>
                                <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(5000).slideUp('slow');
document.getElementById("uploadImage").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>