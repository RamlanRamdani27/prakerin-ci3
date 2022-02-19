
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <?php
                                 if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                ?>
                                 <li><a href="<?php echo base_url()?>jurnal/index">Jurnal</a></li>
                                <?php
                                }else{
                                ?>
                                <li><a href="<?php echo base_url()?>jurnal/index_mahasiswa">Jurnal</a></li>
                                <?php    }
                                ?>
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>jurnal/update_data">
                                <input type="hidden" class="form-control" name="id" placeholder="" value="<?=$list->id?>">
                                <div class="form-group form-float">
                                 <label class="form-label">ID Jurnal</label>
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="idjurnal" placeholder="" value="<?=$list->idjurnal?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Tanggal Kegiatan</label>
                                    <div class="form-line">
                                       <input type="text" class="datepicker form-control" name="tglkegiatan" value="<?= date("d F Y", strtotime($list->tanggal_kegiatan)) ?>" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Kegiatan</label>
                                    <div class="form-line">
                                        <textarea name="kegiatan" cols="30" rows="5" class="form-control no-resize" required><?=$list->kegiatan?></textarea>  
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Status</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="status" value="<?=$list->status?>" placeholder="">
                                    </div>
                                </div>
                                <a href="<?php echo base_url()?>jurnal/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
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
