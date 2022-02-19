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
                         <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>laporan/laporan_prakerin_jurusan">
                                <div class="col-md-3 focused">
                                    <select class="form-control select2" name="jurusan" required=""> 
                                        <option value="">-- Pilih Jurursan --</option>
                                       <?php
                                             foreach ($jurusan as $data ) {
                                                    echo "<option value='$data->idjurusan'>$data->namajurusan</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="col-md-3 focused">
                                    <button class="btn btn-success waves-effect" type="submit">Lihat</button>
                                </div>
                            </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Prakerin</th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Prakerin</th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php                                                                                                        
                                        if (!empty($prakerin)) {
                                            $no=1;
                                        foreach ($prakerin as $row) {
                                             if($row->status==1){
                                                $ket="<span class='label label-info'>Sudah Di Terima Industri</span>";
                                             }else if($row->status==2){
                                                $ket="<span class='label bg-light-blue'>Mulai Prakerin</span>";
                                             }else if($row->status==3){
                                                $ket="<span class='label label-success'>Sudah Selesai Prakerin</span>";
                                             }
                                            ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->idprakerin ?></td>
                                            <td><?= $row->nim ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $ket ?></td>

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