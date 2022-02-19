
        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <?php
                                   if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                   ?><li><a href="<?php echo base_url()?>industri/index">Industri</a></li>
                                <?php
                                    }else{
                                ?><li><a href="<?php echo base_url()?>industri/index_mahasiswa">Industri</a></li>
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
                            <h2><?php echo $judul?></h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" enctype="multipart/form-data" method="POST" action="<?=base_url()?>industri/simpan_data">
                                <div class="form-group form-float">
                                <label class="form-label">Nama Industri</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" required="true"> 
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Kategori</label>
                                    <select class="form-control select2" name="idkategori" required=""> 
                                        <option value="">-- Pilih Kategori --</option>
                                       <?php
                                             foreach ($kategori as $data ) {
                                                    echo "<option value='$data->idkategori'>$data->namakategori</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Telephone</label>
                                    <div class="form-line">
                                        <input type="tel" class="form-control" id="nomer" name="cp"   required aria-required="true" aria-invalid="false">
                                    </div>
                                    
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Alamat</label>
                                    <div class="form-line">
                                        <textarea name="alamat" cols="30" rows="2" class="form-control no-resize" required></textarea>  
                                    </div>
                                </div>
                                <div class="form-group form-float" >
                                 <label class="form-label">Provinsi</label>
                                    <select id='provinsi' class="form-control select2" required="true"> 
                                        <option value="">-- Pilih Provinsi --</option>
                                            <?php 
                                                    foreach ($provinsi as $prov) {
                                                          
                                                    echo "<option value='$prov->id'>$prov->name</option>";
                                                    }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Kabupaten/kota</label>
                                    <select id='kota' class="form-control select2" required="true"> 
                                        <option value="0">&nbsp;</option>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                <label class="form-label">Kecamatan</label>
                                    <select id='kecamatan'class="form-control select2" name="idkec" required="true"> 
                                        <option value="0">&nbsp;</option>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Cari Lokasi Peta</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control"  id="lokasi" required="true">
                                    </div>
                                </div>

                                <div class="body">
                                     <div id="map-canvas" class="gmap"></div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Latitude</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name='lat' id='lat' placeholder="Latitude" required="true">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                 <label class="form-label">Longitude</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name='lng' id='lng' placeholder="Longitude" required="true">
                                    </div>
                                </div>
                                <button class="btn btn-success waves-effect" type="submit">Simpan</button>
                                <?php
                                   if ($this->session->userdata('SESS_LEVEL')=="Admin" or $this->session->userdata('SESS_LEVEL')=="Administrator") {
                                   ?>
                                    <a href="<?php echo base_url()?>industri/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php
                                    }else{
                                ?>
                                 <a href="<?php echo base_url()?>industri/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
                                <?php    }
                                ?>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
    <script type="text/javascript">
        $(document).ready(function(){ 
            $("#nomer").inputmask("(9999) 999-999");
        });
    </script>    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key=AIzaSyB8DAX3Thn7-UzkMPUPDzbc_EDzddIdTrY"></script> 

<script type="text/javascript">

$(function(){

    $.ajaxSetup({
    type:"POST",
    url: "<?php echo base_url('Industri/ambil_data');?>",
    cache: false,
    });


    $("#provinsi").change(function(){

    var value=$(this).val();
        if(value>0){
            $.ajax({
                    data:{modul:'kota',id:value},
                    success: function(respond){
                    document.getElementById('kota').innerHTML = respond ;
                    }
                })
            }

    });


    $("#kota").change(function(){
        var value=$(this).val();
        if(value>0){
            $.ajax({
                    data:{modul:'kecamatan',id:value},
                    success: function(respond){
                    $("#kecamatan").html(respond);
                    }
                })
            }
    })

});
$('#notifications').slideDown('slow').delay(5000).slideUp('slow');
</script>

   <script>
function updateMarkerPosition(latLng) {
  document.getElementById('lat').value = [latLng.lat()];
  document.getElementById('lng').value = [latLng.lng()];
  }


function initialize() {
  var mapOptions = {
   
    center: new google.maps.LatLng(-6.919781271197032,106.93368146093758),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 15,
    mapTypeControl: false,
    navigationControlOption: {
      style: google.maps.NavigationControlStyle.SMALL
    }
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var input = (document.getElementById('lokasi'));

  // var input = (document.getElementById('lokasii'));


  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function(event) {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      return;
    }
 
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17); 
    }
    marker.setIcon(({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address );
    infowindow.open(map, marker);
    updateMarkerPosition(marker.getPosition());
    
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>