<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <?php
                                                 if($list->foto==''){?>
                                                <img src="<?php echo base_url()?>/adminBSB/images/user/Mahasiswa/Profile_kosong.png"  class="account_box img-rounded" height="80px" width="80px"> 
                                                <?php     
                                                 }else{

                                                            
                                                        ?>
                                                <img src="<?php echo base_url()?>adminBSB/images/user/Mahasiswa/<?= $list->foto ?>" class="account_box img-rounded" height="80px" width="80px">
                                                <?php     
                                                           }
                                                        ?>
                                        </a>
                                </div>
                                <div class="media-body">
                                <br>
                                <p>
                                    <h4 class="media-heading"><?= $list->nama;?></h4>
                                    <small><?= $list->nim;?></smal></small>
                                </p>     
                                </div>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">face</i> PROFILE
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">settings</i> SETTINGS
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">lock</i> GANTI PASSWORD
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="profile_with_icon_title">
                                    <b>Profile</b>
                                    <p>
                                        <table class="table" border="0">
                                            <tbody>
                                                <tr>
                                                    <td>Nim</td>
                                                    <td><?= $list->nim ?></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                   
                                                    <td>Nama</td>
                                                    <td><?= $list->nama ?></td>
                                                     <td></td>
                                                </tr>
                                                <tr>
                                                   <?php 
                                                   $ket;
                                                   if($list->jk=="L"){
                                                         $ket="Laki-Laki";
                                                    }elseif($list->jk=="P"){
                                                         $ket="Perempuan";
                                                    }
                                                     ?>
                                                    <td>Jenis Kelamin</td>
                                                    <td><?= $ket ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td>Jurusan</td>
                                                    <td><?= $list->namajurusan ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td>Alamat</td>
                                                    <td><?= $list->alamat ?></td>
                                                    <td></td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                    </table>
                                    </p>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <b>Settings Profile</b>
                                    <p>
                                        <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>profil/update_data_mahasiswa">
                                        <div class="form-group form-float">
                                               <?php
                                                 if($list->foto==''){?>
                                                <img src="<?php echo base_url()?>/adminBSB/images/user/Mahasiswa/Profile_kosong.png" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px"> 
                                                <?php     
                                                 }else{

                                                            
                                                        ?>
                                                <img src="<?php echo base_url()?>adminBSB/images/user/Mahasiswa/<?= $list->foto ?>" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px">
                                                <?php     
                                                           }
                                                        ?>
                                                 <input type="hidden" name="filelama" value="<?= $list->foto ?>">
                                                <div class="fileUpload btn btn-primary">
                                                        <span>Upload</span>
                                                    <input id="uploadImage" type="file" class="upload" name="userfile" onchange="PreviewImage();">
                                                </div>   
                                            </div>
                                            <div class="form-group form-float">
                                             <!-- <label class="form-label">Nim</label> -->
                                                <!-- <div class="form-line"> -->
                                                    <input type="hidden" minlength="9" maxlength="10" value="<?= $list->nim ?>" class="form-control" name="nim"  required="" aria-required="true" aria-invalid="false" >
                                                   
                                                <!-- </div> -->
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
                                            <div class="form-group form-float">
                                             <label class="form-label">Alamat</label>
                                                <div class="form-line">
                                                    <textarea name="alamat" cols="30" rows="5" class="form-control no-resize" required><?= $list->alamat ?></textarea>
                                                   
                                                </div>
                                            </div>
                                            
                                            <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                        </form>
                                    </p>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <b>Password</b>
                                    <p>
                                       <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>profil/passwordbaruu_mahasiswa">
                                            <div class="form-group form-float">
                                                    <input type="hidden" class="form-control" name="nim" value="<?=$list->nim?>" required="true">
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="paslama" required="true">
                                                    <label class="form-label">Password Lama</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="pasbaru" required="true">
                                                    <label class="form-label">Password Baru</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                        </form>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
