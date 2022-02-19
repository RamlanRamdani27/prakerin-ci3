<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo base_url(); ?>adminBSB/images/user/<?= $list->foto?>" width="70" height="70" alt="user-img" class="img-rounded"/>
                                        </a>
                                </div>
                                <div class="media-body">
                                <br>
                                <p>
                                    <h4 class="media-heading"><?= $list->nama;?></h4>
                                    <small><?= $list->username;?></smal></small>
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
                                                    <td>Nama</td>
                                                    <td><?= $list->nama ?></td>
                                                </tr>
                                                <tr>
                                                   
                                                    <td>Email</td>
                                                    <td><?= $list->username ?></td>
                                                     <td></td>
                                                </tr>
                                                <tr>
                                                   
                                                    <td>Level</td>
                                                    <td><?= $list->level ?></td>
                                                     <td></td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <b>Settings Profile</b>
                                    <p>
                                      <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>profil/update_data">
                                            <div class="form-group form-float">
                                                    <input type="hidden" class="form-control" name="idlogin" value="<?=$list->idlogin?>" required="true">
                                            </div>
                                            <div class="form-group form-float">
                                                <img src="<?php echo base_url()?>adminBSB/images/user/<?=$list->foto?>" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px">
                                                <input type="hidden" name="filelama" value="<?= $list->foto ?>" readonly="">
                                               <div class="fileUpload btn btn-primary">
                                                    <span>Upload</span>
                                                    <input id="uploadImage" type="file" class="upload" name="userfile" onchange="PreviewImage();">
                                            </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama" value="<?=$list->nama?>" required="true">
                                                    <label class="form-label">Nama</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                        </form>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <b>Password</b>
                                    <p>
                                       <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>profil/passwordbaruu">
                                            <div class="form-group form-float">
                                                    <input type="hidden" class="form-control" name="idlogin" value="<?=$list->idlogin?>" required="true">
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
