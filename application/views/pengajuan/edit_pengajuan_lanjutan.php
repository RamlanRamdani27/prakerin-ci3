
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li><a href="<?php echo base_url()?>pengajuan/index">Pengajuan</a></li>
                                <li>
                                   <a href="<?php echo base_url()?>pengajuan/detail_data/<?=$list->idpengajuan?>">Detail Pengajuan</a>
                                   </li>
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>pengajuan/update_data_detail">
                                <input type="hidden" class="form-control" name="idpengajuan" value="<?=$list->idpengajuan?>">
                                <input type="hidden" class="form-control" name="id" value="<?=$list->id?>">


                                <div class="form-group form-float">
                                <label class="form-label">Nim</label>
                                   <select class="form-control select2" name="nim" required=""> 
                                        <option value="">-- Pilih Nim --</option>
                                       <?php
                                             foreach ($nim as $data ) {
                                                            ?>
                                                     <option <?php if($list->nim==$data->nim){echo "selected";} ?> value='<?=$data->nim?>'><?=$data->nim?></option>
                                          <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Nomer Telepon</label>
                                    <div class="form-line">
                                        <input type="number" minlength="11" maxlength="12" value="<?=$list->notelepon?>" class="form-control" id="nomer" name="nomer"  required="" aria-required="true">
                                        
                                    </div>
                                </div>
                                <a href="<?php echo base_url()?>pengajuan/detail_data/<?=$list->idpengajuan?>"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(5000).slideUp('slow');
</script>