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
                                            <th>Kode Jurnal</th>
                                            <th>ID Prakerin</th>
                                            <th>Tanggal Input</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurnal</th>
                                            <th>ID Prakerin</th>
                                            <th>Tanggal Input</th>
                                            <th>Action</th>
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
                                            <td><?= $row->idprakerin ?></td>
                                            <td><?= $row->tanggal ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="<?=base_url().'jurnal/detail_data_kajur/'. $row->idjurnal.'/'.$row->idprakerin;?>" title="Detail"> <i class="glyphicon glyphicon-arrow-right"></i></a>
                                            </td>
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
            
            
<script type="text/javascript">
$('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>