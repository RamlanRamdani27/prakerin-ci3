        <div class="block-header">
        	<h1>
        		<ol class="breadcrumb breadcrumb-col-cyan">
        			<li><a href="<?php echo base_url() ?>dashboard/index">Home</a></li>
        			<li><a href="<?php echo base_url() ?>industri/index">Industri</a></li>
        			<li class="active"><?php echo $judul ?></li>
        		</ol>
        	</h1>
        </div>

        <!-- Basic Validation -->
        <div class="row clearfix">
        	<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		<div class="card">
        			<div class="header">
        				<h2><?php echo $judul ?></h2>
        			</div>
        			<div class="body">
        				<form id="form_validation" enctype="multipart/form-data" method="POST" action="<?= base_url() ?>/industri/update_data">
        					<input type="hidden" value="<?= $list->idindustri ?>" class="form-control" name="id">
        					<div class="form-group form-float">
        						<label class="form-label">Nama Industri</label>
        						<div class="form-line">
        							<input type="text" class="form-control" name="nama" value="<?= $list->namaindustri ?>" required="true">
        						</div>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Kategori</label>
        						<select class="form-control select2" name="idkategori" required="">
        							<option value="">-- Pilih Kategori --</option>
        							<?php
											foreach ($kategori as $data) {

											?>
        								<option <?php if ($list->idkategori == $data->idkategori) {
																	echo "selected";
																} ?> value='<?= $data->idkategori ?>'><?= $data->namakategori ?></option>
        							<?php
											}
											?>
        						</select>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Telephone</label>
        						<div class="form-line">
        							<input type="tel" class="form-control" id="nomer" name="cp" value="<?= $list->cp ?>" required aria-required="true" aria-invalid="false">
        						</div>

        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Alamat</label>
        						<div class="form-line">
        							<textarea name="alamat" cols="30" rows="2" class="form-control no-resize" required><?= $list->alamat ?></textarea>
        						</div>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Provinsi</label>
        						<select id='provinsi' class="form-control select2" required="true">
        							<option value="">-- Pilih Provinsi --</option>
        							<?php
											foreach ($provinsi as $data) {

											?>
        								<option <?php if ($list->id == $data->id) {
																	echo "selected";
																} ?> value='<?= $data->id ?>'><?= $data->name ?></option>
        							<?php
											}
											?>
        						</select>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Kabupaten/kota</label>
        						<select id='kota' class="form-control select2" required="true">
        							<option value="<?= $list->idkota ?>"><?= $list->namakota ?></option>
        						</select>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Kecamatan</label>
        						<select id='kecamatan' class="form-control select2" name="idkec" required="true">
        							<option value="<?= $list->idkecamatan ?>"><?= $list->namakecamatan ?></option>
        						</select>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Ganti Lokasi Peta</label>
        						<div class="form-line">
        							<input type="text" id="lokasi" class="form-control">
        						</div>
        					</div>

        					<div class="body">
        						<div id="map-canvas" class="gmap"></div>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Latitude</label>
        						<div class="form-line">
        							<input type="text" class="form-control" name='lat' value="<?= $list->latitude ?>" id='lat' placeholder="Latitude" required="true">
        						</div>
        					</div>
        					<div class="form-group form-float">
        						<label class="form-label">Longitude</label>
        						<div class="form-line">
        							<input type="text" class="form-control" name='lng' value="<?= $list->longtitude ?>" id='lng' placeholder="Longitude" required="true">
        						</div>
        					</div>

        					<button class="btn btn-success waves-effect" type="submit">Simpan</button>
        					<a href="<?php echo base_url() ?>industri/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
        				</form>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- #END# Basic Validation -->
        <script type="text/javascript">
        	$(document).ready(function() {
        		$("#nomer").inputmask("(9999) 999-999");
        	});
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key="></script>
        <script type="text/javascript">
        	$(function() {

        		$.ajaxSetup({
        			type: "POST",
        			url: "<?php echo base_url('Industri/ambil_data'); ?>",
        			cache: false,
        		});


        		$("#provinsi").change(function() {

        			var value = $(this).val();
        			if (value > 0) {
        				$.ajax({
        					data: {
        						modul: 'kota',
        						id: value
        					},
        					success: function(respond) {
        						document.getElementById('kota').innerHTML = respond;
        					}
        				})
        			}

        		});


        		$("#kota").change(function() {
        			var value = $(this).val();
        			if (value > 0) {
        				$.ajax({
        					data: {
        						modul: 'kecamatan',
        						id: value
        					},
        					success: function(respond) {
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

        			center: new google.maps.LatLng(<?= $list->latitude ?>, <?= $list->longtitude ?>),
        			mapTypeId: google.maps.MapTypeId.ROADMAP,
        			zoom: 18,
        			mapTypeControl: false,
        			navigationControlOption: {
        				style: google.maps.NavigationControlStyle.SMALL
        			}
        		};



        		var map = new google.maps.Map(document.getElementById('map-canvas'),
        			mapOptions);


        		var icon = '<?php echo base_url() ?>/adminBSB/images/kategori/<?= $list->ikon ?>';
        		var input = (document.getElementById('lokasi'));


        		var autocomplete = new google.maps.places.Autocomplete(input);
        		autocomplete.bindTo('bounds', map);

        		var infowindow = new google.maps.InfoWindow();
        		var marker = new google.maps.Marker({
        			position: new google.maps.LatLng(<?= $list->latitude ?>, <?= $list->longtitude ?>),
        			icon: icon,
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

        			infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        			infowindow.open(map, marker);
        			updateMarkerPosition(marker.getPosition());

        		});
        	}

        	google.maps.event.addDomListener(window, 'load', initialize);
        </script>
