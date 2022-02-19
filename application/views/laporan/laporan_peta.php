        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li class="active"><?php echo $title?></li>
                            </ol>    
                      </h1>           
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2> <?php echo $Tabel?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                         <div id="map-canvas" class="gmap"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if (!empty($mhs_prakerin)) {
        # code...
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key="></script>
<script>
                    
    var marker;
    function initialize() {
                      
    // Variabel untuk menyimpan informasi (desc)
    var infoWindow = new google.maps.InfoWindow;
                    
    //  Variabel untuk menyimpan peta Roadmap
    var mapOptions = {
        mapTypeId: google.maps.MapTypeId.ROADMAP
    } 
                    
    // Pembuatan petanya
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                              
    // Variabel untuk menyimpan batas kordinat
    var bounds = new google.maps.LatLngBounds();

    // Pengambilan data dari database
    <?php
        foreach ($mhs_prakerin as $data => $d_mhs) {

                $nama           = $d_mhs['nama'];
                $alamat         = $d_mhs['alamat'];
                $lat            = $d_mhs['lat'];
                $lon            = $d_mhs['lon'];
                $icon           = $d_mhs['icon'];  
    ?>
        var image = "<?php echo base_url().'adminBSB/images/kategori/'.$icon ?> ";

    <?php
            $mahasiswa = "";
            foreach ($d_mhs['mhs'] as $dt) {
              $mahasiswa .= 'Nim ='.$dt->nim.' Nama =' .$dt->nama."<br/>"; 
            }
        echo ("addMarker($lat, $lon, '<center><b>$nama</b><br> $alamat</center><br>$mahasiswa');\n"); 
        } 
    ?>
                      
        // Proses membuat marker 
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
                      
            var marker = new google.maps.Marker({
                        map: map,
                        position: lokasi,
                        icon:image
                      });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
        }
                    
                    // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
                            infoWindow.setContent(html);
                            infoWindow.open(map, marker);
                          });
        }
                 
    }
    google.maps.event.addDomListener(window, 'load', initialize);
                    
</script>
<?php
    }else{
        $lat="-6.9198225";
        $long="106.91261459999998";
        $ikon="kampus.png";
        $nama="Politeknik sukabumi";
        $alamat='Jl. Babakan Sirna 27 Benteng Kota Sukabumi 43132';
        $mahasiswa="";
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key=AIzaSyB8DAX3Thn7-UzkMPUPDzbc_EDzddIdTrY&callback=initMap"></script> 
<script>

 function initMap() {
        var uluru = {lat: <?=$lat?>, lng: <?=$long?>};
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 18,
          center: uluru
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading"><?=$nama?></h1>'+
            '<div id="bodyContent">'+
            '<p><?=$alamat?></b></p>' +
            '<p><?=$mahasiswa?></p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        var icon = '<?php echo base_url()?>/adminBSB/images/kategori/<?= $ikon ?>';
        var marker = new google.maps.Marker({
          position : new google.maps.LatLng(<?=$lat?>,<?=$long?>),
          icon     : icon,
          map: map,
          title: '<?=$nama?>'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }      
</script>



<?php      
    }
?>

