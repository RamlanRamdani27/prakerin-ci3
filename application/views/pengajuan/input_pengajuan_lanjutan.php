
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li><a href="<?php echo base_url()?>pengajuan/index">Pengajuan</a></li>
                                <?php 
                                if ($aktivitas==1) {
                                   ?>
                                   <li>
                                   <a href="<?php echo base_url()?>pengajuan/detail_data/<?=$idpengajuan?>">Detail Pengajuan</a>
                                   </li>
                                <?php
                                }
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>pengajuan/insert_data_lanjutan">
                            <input type="hidden" class="form-control" name="aktivitas" value="<?=$aktivitas?>">
                            <input type="hidden" class="form-control" name="id" value="<?=$idpengajuan?>">
                             <?php                                                                                                       
                                    
                                        for ($i=0; $i < $jumlah; $i++) {
                                            
                                         
                                            ?>
                                <input type="hidden" class="form-control" name="idpengajuan[]" value="<?=$idpengajuan?>">


                                <div class="form-group form-float">
                                <label class="form-label">Nim</label>
                                   <select class="form-control select2" name="nim[]" required=""> 
                                        <option value="">-- Pilih Nim --</option>
                                       <?php
                                             foreach ($nim as $data ) {
                                                    echo "<option value='$data->nim'>$data->nim</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Nomer Telepon</label>
                                    <div class="form-line">
                                        <input type="number" minlength="11" maxlength="12" class="form-control" id="nomer" name="nomer[]"  required="" aria-required="true">
                                        
                                    </div>
                                </div>
                                <?php
                                           
                                       
                                    }
                                        ?>
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
<script type="text/javascript">
        // $(document).ready(function(){ 
        //     $("#nomer").inputmask("9999-9999-9999");
        // });
    </script>  