<div class="block-header">
     <h1>
        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <li><a href="<?php echo base_url()?>jurnal/index">Jurnal</a></li>
            <li class="active"><?php echo $judul?></li>
        </ol>    
    </h1>           
</div>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $judul?> 
                                <?php echo '('.$idjurnal.')' ?>
                           </h2>  
                        </div>
                        
                        <div class="body table-responsive">
                        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                            <table class="table" border="0">
                                <tbody>
                                    <tr>
                                        <td>Nim</td>
                                        <td><?= $list->nim ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td><?= $list->nama ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Industri</td>
                                        <td><?= $list->namaindustri ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <?php
                                            $alamat_kecil = strtolower($list->alamatindustri." ".$list->namakecamatan.", ".$list->namakota.", ".$list->name." -  " .  $list->cp);
                                            $alamat_new = ucwords($alamat_kecil);
                                        ?>
                                        <td><?= $alamat_new ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Prakerin</td>
                                        <td><?= date("d F Y", strtotime($list->tglmulai)) ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir Prakerin</td>
                                        <td><?= date("d F Y", strtotime($list->tglselesai)) ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       <div class="header">
                            <h2>
                                <?php echo $Tabel?> 
                           </h2>  
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurnal</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurnal</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                       
                                        if (!empty($jurnal)) {
                                        $no=1;

                                        foreach ($jurnal as $row) {
                                            
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idjurnal ?></td>
                                            <td><?= date("d F Y", strtotime($row->tanggal_kegiatan)) ?></td>
                                            <td><?= $row->kegiatan ?></td>
                                            <td><?= $row->status ?></td>
                                        </tr>
                                            <?php
                                            $no++;
                                        }
                                    }
                                        ?>
                                                     
                                   </tbody>
                                </table>

                            </div>
                           <br/>
                            <a href="<?php echo base_url()?>jurnal/index_kajur"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                        </div>

                </div>
            </div>
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>