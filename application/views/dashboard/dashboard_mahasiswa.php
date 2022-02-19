<div class="container-fluid">
	<div class="block-header">
		<h2>DASHBOARD MAHASISWA</h2>
	</div>

	<!-- Widgets -->
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-cyan hover-expand-effect">
				<div class="icon">
					<i class="material-icons">playlist_add_check</i>
				</div>
				<div class="content">
					<div class="text">PENGAJUAN</div>
					<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?= $baru->jumlah_pengajuan_baru ?></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-pink hover-expand-effect">
				<div class="icon">
					<i class="material-icons">clear</i>
				</div>
				<div class="content">
					<div class="text">TIDAK DITERIMA</div>
					<div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?= $tidak_diterima->jumlah_pengajuan_tidak_diterima ?></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-light-green hover-expand-effect">
				<div class="icon">
					<i class="material-icons">done_all</i>
				</div>
				<div class="content">
					<div class="text">DITERIMA</div>
					<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $ditermina->jumlah_pengajuan_diterima ?></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-orange hover-expand-effect">
				<div class="icon">
					<i class="material-icons">person_add</i>
				</div>
				<div class="content">
					<div class="text">PRAKERIN</div>
					<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?= $jumlah_prakerin->jumlah_prakerin ?></div>
				</div>
			</div>
		</div>
	</div>
	<!-- #END# Widgets -->
	<?php
	if (!empty($list)) {
		$lat = $list->latitude;
		$long = $list->longtitude;
		$ikon = $list->ikon;
		$nama = $list->namaindustri;
		$alamat = $list->alamat;
		$mahasiswa = $list->nim;
	} else {
		$lat = "-6.9198225";
		$long = "106.91261459999998";
		$ikon = "kampus.png";
		$nama = "Politeknik sukabumi";
		$alamat = 'Jl. Babakan Sirna 27 Benteng Kota Sukabumi 43132';
		$mahasiswa = "";
	}
	?>

	<!-- Maps -->
	<div class="row clearfix">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header">
					<div class="row clearfix">
						<div class="col-xs-12 col-sm-6">
							<?php
							if ($nama == "Politeknik sukabumi") {
							?>

								<h2>Peta <?= $nama ?></h2>
							<?php
							} else {
							?>
								<h2>Lokasi Peta Prakerin Di <?= $nama ?></h2>
							<?php
							}
							?>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key=&callback=initMap"></script>
<!--    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8DAX3Thn7-UzkMPUPDzbc_EDzddIdTrY&callback=initMap">
    </script> -->
<script>
	function initMap() {
		var uluru = {
			lat: <?= $lat ?>,
			lng: <?= $long ?>
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), {
			zoom: 18,
			center: uluru
		});

		var contentString = '<div id="content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<h1 id="firstHeading" class="firstHeading"><?= $nama ?></h1>' +
			'<div id="bodyContent">' +
			'<p><?= $alamat ?></b></p>' +
			'<p><?= $mahasiswa ?></p>' +
			'</div>' +
			'</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		var icon = '<?php echo base_url() ?>/adminBSB/images/kategori/<?= $ikon ?>';
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?= $lat ?>, <?= $long ?>),
			icon: icon,
			map: map,
			title: '<?= $nama ?>'
		});
		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
	}
</script>

<script>
	// function initialize() {
	//   var mapOptions = {

	//     center: new google.maps.LatLng(<?= $lat ?>,<?= $long ?>),
	//     mapTypeId: google.maps.MapTypeId.ROADMAP,
	//     zoom: 18,
	//     mapTypeControl: false,
	//     navigationControlOption: {
	//       style: google.maps.NavigationControlStyle.SMALL
	//     }
	//   };

	//   var map = new google.maps.Map(document.getElementById('map-canvas'),
	//     mapOptions);


	//   var icon = '<?php echo base_url() ?>/adminBSB/images/kategori/<?= $ikon ?>';
	//   var input = (document.getElementById('lokasi'));


	//   var autocomplete = new google.maps.places.Autocomplete(input);
	//   autocomplete.bindTo('bounds', map);

	//   var infowindow = new google.maps.InfoWindow();
	//   var marker = new google.maps.Marker({
	//      position : new google.maps.LatLng(<?= $lat ?>,<?= $long ?>),
	//      icon     : icon,
	//      map      : map
	//   });

	//   google.maps.event.addListener(autocomplete, 'place_changed', function(event) {
	//     infowindow.close();
	//     marker.setVisible(false);
	//     var place = autocomplete.getPlace();
	//     if (!place.geometry) {
	//       return;
	//     }

	//     if (place.geometry.viewport) {
	//       map.fitBounds(place.geometry.viewport);
	//     } else {
	//       map.setCenter(place.geometry.location);
	//       map.setZoom(17); 
	//     }
	//     marker.setIcon(({
	//       url: place.icon,
	//       size: new google.maps.Size(71, 71),
	//       origin: new google.maps.Point(0, 0),
	//       anchor: new google.maps.Point(17, 34),
	//       scaledSize: new google.maps.Size(35, 35)
	//     }));
	//     marker.setPosition(place.geometry.location);
	//     marker.setVisible(true);

	//     var address = '';
	//     if (place.address_components) {
	//       address = [
	//         (place.address_components[0] && place.address_components[0].short_name || ''),
	//         (place.address_components[1] && place.address_components[1].short_name || ''),
	//         (place.address_components[2] && place.address_components[2].short_name || '')
	//       ].join(' ');
	//     }

	//     infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address );
	//     infowindow.open(map, marker);
	//     updateMarkerPosition(marker.getPosition());

	//   });
	// }

	// google.maps.event.addDomListener(window, 'load', initialize);
</script>
