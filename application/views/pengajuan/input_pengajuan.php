
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <?php
                                   if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                   ?>
                                   <li><a href="<?php echo base_url()?>pengajuan/index">Pengajuan</a></li>
                                <?php
                                    }else{
                                ?>
                                <li><a href="<?php echo base_url()?>pengajuan/index_mahasiswa">Pengajuan</a></li>
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
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>pengajuan/insert_data">
                                <input type="hidden" class="form-control" name="penginput" value="<?=$this->session->userdata('SESS_EMAIL')?>">

                                <div class="form-group form-float">
                                <label class="form-label">Industri</label>
                                    <select class="form-control select2" name="industri" required=""> 
                                        <option value="">-- Pilih Industri --</option>
                                       <?php
                                             foreach ($industri as $data ) {
                                                    echo "<option value='$data->idindustri'>$data->namaindustri</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Tanggal Mulai Prakerin</label>
                                    <div class="form-line">
                                       <input type="text" class="datepicker form-control" name="tglmulai" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                 <label class="form-label">Tanggal Berakhir Prakerin</label>
                                    <div class="form-line">
                                       <input type="text" class="datepicker form-control" name="tglakhir" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                <label class="form-label">Jumlah Prakerin</label>
                                    <div class="form-line">
                                        <input type="number" min="1" max="5" class="form-control" name="jml" placeholder="Maksimal 5 Orang" required="" aria-required="true">
                                        
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Jurusan</label>
                                   <select class="form-control select2" name="jurusan" required=""> 
                                        <option value="">-- Pilih Jurusan --</option>
                                       <?php
                                             foreach ($jurusan as $data ) {
                                                    echo "<option value='$data->idjurusan'>$data->namajurusan</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Penginput</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="penginput" value="<?=$this->session->userdata('SESS_NAME')?>" disabled="">
                                       
                                    </div>
                                </div>
                                <?php
                                   if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                   ?>
                                   <a href="<?php echo base_url()?>pengajuan/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php
                                    }else{
                                ?>
                                <a href="<?php echo base_url()?>pengajuan/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php    }
                                ?>
                                
                                <a href="<?php echo base_url()?>industri/add_data"><button type="button" class="btn btn-info waves-effect">Tambah Industri</button></a>
                                <button class="btn btn-success waves-effect" type="submit">Lanjutkan</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(5000).slideUp('slow');
</script>
