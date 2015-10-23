<?php
$featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<style>
.gmnoprint img {max-width: none;}
</style>
<script type="text/javascript">
function initialize() {
	var location = new google.maps.LatLng(52.483262, -2.117042);

	var mapOptions = {
		center: location,
		mapTypeControl: true,
		mapTypeControlOptions: {
		  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		zoom: 15,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.LEFT_TOP
		}
	};
	var map = new google.maps.Map(document.getElementById("google_map"), mapOptions);
	
	var marker = new google.maps.Marker({
		position: location,
		map: map
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="el_banner map">
	<div id="google_map"></div>
	<h1><?php the_title(); ?></h1>
</div>