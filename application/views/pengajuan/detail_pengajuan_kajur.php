<div class="block-header">
    <h1>
        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <li><a href="<?php echo base_url()?>pengajuan/index_kajur">Pengajuan</a></li>
            <li class="active"><?php echo $judul?></li>
        </ol>    
    </h1>           
</div>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                        <div class="header">
                            <h2>
                                <?php echo $Tabel?> <?= $list->idpengajuan ?>
                           </h2>  
                        </div>
                        <div class="body table-responsive">
                            <table class="table" border="0">
                                <tbody>
                                    <tr>
                                        <td>Industri</td>
                                        <td><?= $list->namaindustri ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <?php
                                            $alamat_kecil = strtolower($list->alamat.", ".$list->namakecamatan.", ".$list->namakota.", ".$list->name." -  " .  $list->cp);
                                            $alamat_new = ucwords($alamat_kecil);
                                        ?>
                                        <td><?= $alamat_new ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Prakerin</td>
                                        <td><?= date("d-m-Y", strtotime($list->tglmulai)) ?></td>
                                         <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir Prakerin</td>
                                        <td><?= date("d-m-Y", strtotime($list->tglakhir)) ?></td>
                                        <td></td>
                                    </tr>
                                    <tr> 
                                        <td>Jumlah Prakerin</td>
                                        <td><?= $list->jumlah ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Penginput</td>
                                        <td><?= $list->user_input ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="header">
                            <h2>
                            <?php echo $header_title?>  
                           </h2>  
                        </div>
                            <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                                                                                       
                                    
                                         if (!empty($listt)) {
                                            $no=1;
                                        foreach ($listt as $row) {
                                            
                                         
                                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->nim ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->notelepon ?></td>
                                    <?php
                                     $no++;
                                        } 
                                      
                                    }
                                        ?>
                                </tbody>
                            </table>
                              <a href="<?php echo base_url()?>pengajuan/index_kajur"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                            </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
$('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>