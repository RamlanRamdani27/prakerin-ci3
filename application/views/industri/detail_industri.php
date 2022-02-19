        <div class="block-header">
        	<h1>
        		<ol class="breadcrumb breadcrumb-col-cyan">
        			<li><a href="<?php echo base_url() ?>dashboard/index">Home</a></li>
        			<?php
							if ($this->session->userdata('SESS_LEVEL') == "Admin" or $this->session->userdata('SESS_LEVEL') == "Administrator") {
							?><li><a href="<?php echo base_url() ?>industri/index">Industri</a></li>
        			<?php
							} else {
							?><li><a href="<?php echo base_url() ?>industri/index_mahasiswa">Industri</a></li>
        			<?php    }
							?>
        			<li class="active"><?php echo $judul ?></li>
        		</ol>
        	</h1>
        </div>

        <div class="row clearfix">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		<div class="card">
        			<div class="header">
        				<h2>
        					<?php echo $judul ?>
        				</h2>
        			</div>

        			<div class="body">
        				<div id="map-canvas" class="gmap"></div>
        			</div>

        			<div class="body table-responsive">
        				<table class="table" border="0">
        					<tbody>

        						<tr>

        							<td>Nama Industri</td>
        							<td><?= $list->namaindustri ?></td>
        							<td></td>
        						</tr>
        						<tr>

        							<td>Kategori</td>
        							<td><?= $list->namakategori ?></td>
        							<td></td>
        						</tr>
        						<tr>
        							<td></td>
        							<td><?= $list->keterangan ?></td>
        							<td></td>
        						</tr>
        						<tr>
        							<td>Telephone</td>
        							<td><?= $list->cp ?></td>
        							<td></td>
        						</tr>
        						<tr>
        							<?php
											$alamat_kecil = strtolower($list->alamat . ", " . $list->namakecamatan . ", " . $list->namakota . ", " . $list->name);
											$alamat_new = ucwords($alamat_kecil);
											?>
        							<td>Alamat</td>
        							<td><?= $alamat_new ?></td>
        							<td></td>
        						</tr>
        						<tr>

        							<td>Koordinat Industri</td>
        							<td><?= $list->latitude . ", " . $list->longtitude ?></td>
        							<td></td>
        						</tr>


        					</tbody>
        				</table>
        				<?php
								if ($this->session->userdata('SESS_LEVEL') == "Mahasiswa") {
								?>
        					<a href="<?php echo base_url() ?>industri/index_mahasiswa"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
        				<?php
								} else {
								?>
        					<a href="<?php echo base_url() ?>industri/index"><button type="button" class="btn btn-default waves-effect">Cancel</button></a>
        				<?php
								}
								?>
        			</div>
        		</div>
        	</div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key="></script>
        <script>
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
