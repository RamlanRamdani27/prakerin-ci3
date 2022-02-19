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
                                            <th>ID Prakerin</th>
                                            <th>Nama Industri</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Prakerin</th>
                                            <th>Nama Industri</th>
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
                                            <td><?= $row->namaindustri ?></td>
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