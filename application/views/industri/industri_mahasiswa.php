<div class="block-header">
    <h1>
            <?php echo $judul?>
            <a href="<?php echo base_url()?>industri/add_data" clas><button class="btn btn-success align-right" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <?php echo $title?></button></a>
    </h1>           
</div>

<?php                                                                                                       
if (!empty($industri)) {
   $no=1;

    foreach ($industri as $row) {
    $alamat_kecil = strtolower($row->alamat.", ".$row->namakecamatan.", ".$row->namakota.", ".$row->name);
    $alamat_new = ucwords($alamat_kecil);
                                         
?>
<div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?= $row->namaindustri ?>
                        <small><?= $row->namakategori ?></small>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn btn-xs btn-info waves-effect detail" href="<?=base_url().'/industri/detail_data/'. $row->idindustri;?>" title="Detail" \><i class="glyphicon glyphicon-arrow-right"></i></a>
                        </ul>
                     </h2>
                </div>
                <div class="body">
                        <p> <?= $alamat_new ?></p>
                        <p> <?= $row->cp ?></p>
                </div>
            </div>
       </div>
</div>
<?php
$no++;
    }
}
?>
<?php 
    // echo $this->pagination->create_links();
 echo $pagination;
    ?>