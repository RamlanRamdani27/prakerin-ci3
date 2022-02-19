<div class="block-header">
     <h1>
        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <li><a href="<?php echo base_url()?>pengajuan/index">Pengajuan</a></li>
            <li><a href="<?php echo base_url()?>pengajuan/detail_data/<?=$list->idpengajuan?>">Detail Pengajuan</a></li>
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
                            <h2><?php echo $judul?></h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>pengajuan/update_data">

                                <input type="hidden" class="form-control" name="idpengajuan" value="<?=$list->idpengajuan?>">
                                <div class="form-group form-float">
                                <label class="form-label">Industri</label>
                                    <select class="form-control select2" name="industri" required=""> 
                                        <option value="">-- Pilih Industri --</option>
                                          <?php
                                             foreach ($industri as $data ) {
                                                    
                                                    ?>
                                                <option <?php if($list->idindustri==$data->idindustri){echo "selected";} ?> value='<?=$data->idindustri?>'><?=$data->namaindustri?></option>
                                            <?php
                                                }
                                                $tglawal=date("d F Y", strtotime($list->tglmulai));
                                                $tglakhir=date("d F Y", strtotime($list->tglakhir));
                                             ?>
                                    </select>
                                </div>

                                <div class="form-group form-float">
                                 <label class="form-label">Tanggal Mulai Prakerin</label>
                                    <div class="form-line">
                                       <input type="text" class="datepicker form-control" name="tglmulai" value='<?= $tglawal?>' placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                 <label class="form-label">Tanggal Berakhir Prakerin</label>
                                    <div class="form-line">

                                       <input type="text" class="datepicker form-control" name="tglakhir" value='<?= $tglakhir ?>'placeholder="">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                <label class="form-label">Jumlah Prakerin</label>
                                    <div class="form-line">
                                        <input type="number" min="1" max="5" class="form-control" name="jml" value="<?=$list->jumlah?>" required="" aria-required="true">
                                        
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Penginput</label>
                                    <div class="form-line">
                                        <input type="text"  class="form-control" name="penginput" value="<?=$list->user_input?>" disabled="">
                                       
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