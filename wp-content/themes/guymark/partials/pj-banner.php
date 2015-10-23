<?php
$featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$class = "";
$style = "";
if(is_single()){
	$title = get_the_date();
	$class = " newspost";
}
else {
	$title = get_the_title();
	$style = "background-image: url('$featured')";
}

?>

<div class="el_banner<?php echo $class; ?>" style="<?php echo $style; ?>">
	<h1><?php echo $title; ?></h1>
</div>