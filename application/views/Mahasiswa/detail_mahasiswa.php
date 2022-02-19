        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li><a href="<?php echo base_url()?>mahasiswa/index">Mahasiswa</a></li>
                                <li class="active"><?php echo $judul?></li>
                            </ol>    
                      </h1>           
        </div>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $Tabel?> 
                           </h2>  
                        </div>
                        <div class="body table-responsive">
                            <table class="table" border="0">
                                <tbody>

                                    <tr>
                                       
                                        <td>Nim</td>
                                        <td><?= $list->nim ?></td>
                                        <td>
                                            <?php
                                     if($list->foto==''){?>
                                    <img src="<?php echo base_url()?>/adminBSB/images/user/mahasiswa/Profile_kosong.png" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px"> 
                                    <?php     
                                     }else{

                                                
                                            ?>
                                    <img src="<?php echo base_url()?>adminBSB/images/user/mahasiswa/<?= $list->foto ?>" id="uploadPreview" class="account_box img-rounded" height="80px" width="80px">
                                    <?php     
                                               }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                       
                                        <td>Nama</td>
                                        <td><?= $list->nama ?></td>
                                         <td></td>
                                    </tr>
                                    <tr>
                                       <?php 
                                       $ket;
                                       if($list->jk=="L"){
                                             $ket="Laki-Laki";
                                        }elseif($list->jk=="P"){
                                             $ket="Perempuan";
                                        }
                                         ?>
                                        <td>Jenis Kelamin</td>
                                        <td><?= $ket ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Jurusan</td>
                                        <td><?= $list->namajurusan ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Alamat</td>
                                        <td><?= $list->alamat ?></td>
                                        <td></td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                           <a href="<?php echo base_url()?>mahasiswa/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                        </div>
                    </div>
                </div>
            </div>