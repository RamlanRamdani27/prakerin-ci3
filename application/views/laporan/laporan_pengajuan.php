        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li class="active"><?php echo $title?></li>
                            </ol>    
                      </h1>           
        </div>

            <div class="row clearfix">
            <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
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
                                            <th>Kode Pengajuan</th>
                                            <th>Tanggal mengajukan</th>
                                            <th>Nama Industri</th>
                                            <th>Penginput</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pengajuan</th>
                                            <th>Tanggal mengajukan</th>
                                            <th>Nama Industri</th>
                                            <th>Penginput</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                        
                                        if (!empty($pengajuan)) {
                                        $no=1;
                                        $terima=2;
                                        $tidak_diterima=3;
                                        $ket;
                                        foreach ($pengajuan as $row) {
                                            if ($row->status_aprove==1) {
                                               $ket="<span class='label label-warning'>Baru Mengajukan Surat</span>";
                                            }else if ($row->status_aprove==2) {
                                                $ket="<span class='label label-success'>Sudah Di Terima Industri</span>";
                                            }else{
                                                 $ket="<span class='label label-danger'>Tidak Di Terima Industri</span>";
                                            }
                                         
                                            ?>
                                            <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idpengajuan ?></td>
                                            <td><?= date("d F Y", strtotime($row->tglpengajuan)) ?></td>
                                            <td><?= $row->namaindustri ?></td>
                                            <td><?= $row->user_input ?></td>
                                        </tr>
                                            <?php
                                            $no++;
                                        }
                                    }
                                        ?>
                                                     
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->