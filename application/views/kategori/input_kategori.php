 
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li><a href="<?php echo base_url()?>kategori/index">Kategori</a></li>
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>kategori/insert_data">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="kodek" value="<?=$kode?>" readonly>
                                        <label class="form-label">Kode Kategori</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="namak" required>
                                        <label class="form-label">Nama Kategori</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="ket" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Keterangan</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                            
                                            <input id="uploadImage" type="file" class="upload" name="userfile" onchange="PreviewImage();" required="">
                                        </div>
                                    <img src="<?php echo base_url()?>adminBSB/images/kategori/icon_kosong.png" id="uploadPreview" class="account_box img-rounded" height="40px" width="40px">
                                        
                                </div>
                                  
                                <a href="<?php echo base_url()?>kategori/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(5000).slideUp('slow');
function PreviewImage() {
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
oFReader.onload = function (oFREvent)
 {
    document.getElementById("uploadPreview").src = oFREvent.target.result;
};
};

</script>