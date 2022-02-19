
   
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>mahasiswa/update_data">
                                                                <div class="form-group form-float">
                                 <label class="form-label">Nim</label>
                                    <div class="form-line">
                                        <input type="number" minlength="9" maxlength="10" value="<?= $list->nim ?>" class="form-control" name="nim"  required="" aria-required="true" aria-invalid="false">
                                       
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" value="<?= $list->nama ?>" class="form-control" name="nama" required="true">
                                       
                                    </div>
                                </div>
                                <div class="form-group form-float">

                                 <label class="form-label">Jenis Kelamin</label>
                                       <div class="demo-radio-button">
                                            <input name="jk"  type="radio" value="L" id="radio_7" class="with-gap radio-col-cyan" <?php if($list->jk=="L"){echo "checked";} ?>/>
                                            <label for="radio_7">Laki-laki</label>
                                            <input name="jk" type="radio" value="P" id="radio_8" class="with-gap radio-col-cyan" <?php if($list->jk=="P"){echo "checked";} ?>/>
                                            <label for="radio_8">Perempuan</label>
                                        </div>
                                </div>

<!--                                 <div class="form-group form-float">
                                <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" minlength="5" required="" aria-required="true">
                                        
                                    </div>
                                </div> -->
                                <div class="form-group form-float">
                                 <label class="form-label">Jurusan</label>
                                    <select class="select2" name="jurusan" required=""> 
                                        <option value="">-- Pilih Jurursan --</option>
                                       <?php
                                             foreach ($jurusan as $data ) {
                                                    
                                                    ?>
                                                    <option <?php if($list->idjurusan==$data->idjurusan){echo "selected";} ?> value='<?=$data->idjurusan?>'><?=$data->namajurusan?></option>
                                        <?php
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Alamat</label>
                                    <div class="form-line">
                                        <textarea name="alamat" cols="30" rows="5" class="form-control no-resize" required><?= $list->alamat ?></textarea>
                                       
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                   <?php
                                     if($list->foto==''){?>
                                    <img src="<?php echo base_url()?>/adminBSB/images/user/mahasiswa/Profile_kosong.png" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px"> 
                                    <?php     
                                     }else{

                                                
                                            ?>
                                    <img src="<?php echo base_url()?>adminBSB/images/user/mahasiswa/<?= $list->foto ?>" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px">
                                    <?php     
                                               }
                                            ?>
                                     <input type="hidden" name="filelama" value="<?= $list->foto ?>" readonly="">
                                    <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                        <input id="uploadImage" type="file" class="upload" name="userfile" onchange="PreviewImage();">
                                        
                                       
                                    </div>
                                  
                                </div>
                                <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                <a href="<?php echo base_url()?>mahasiswa/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
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