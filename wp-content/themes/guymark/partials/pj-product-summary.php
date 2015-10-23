<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
global $post, $product;
//if( !db_is_available_for_purchase() ) return;
$meta = get_post_meta( $post->ID); 
// print_r($meta);

$cat = get_the_terms( $post->ID, 'product_cat' );
$cat2 = "";
foreach ($cat as $term) {
    $cat2 .= "<a href=\"/product-category/" . $term->slug . "\">" . $term->name . "</a>, ";
    break;
}
$cat2 = substr($cat2, 0, -2);


if( $warranties = $meta['warranties'][0] ) {
				
	// Get the assigned warranty option
	$field = get_field_object('warranties');
	$value = get_field('warranties');
	$label = $field['choices'][ $value ];
	
	// Get the warraty option content
	$warranty_content = get_field_object('warranty_content', 'option');
	$warranty_text = $warranty_content['choices'][ trim($value) ];
	
	
	// Assign the printed display name
	$warranty_name = $label;
	
	// Get a value from the display options
	foreach( $warranty_content['sub_fields'] as $arr=>$vals ) {
		if( $vals['name'] == $value ) {
			$warranty_value = $vals['default_value'];
		}
	}

}
?>

<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="display: none">
	
	<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>
	
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>


<div class="product summary">
	<div class="item_category"><?php echo $cat2; ?></div>
	<div class="item_name"><?php the_title(); ?></div>
	
	<div class="group_invis product_meta">
		<div class="item_key1">Product Code:</div>
		<div class="item_value1 sku"  itemprop="productID"><?php echo $product->get_sku(); ?>&nbsp;</div>
        
		<?php
		$othersku = $meta['previous_sku'][0];
		if(!empty($othersku)){ ?>
		<div class="item_key1">Other Product Code:</div>
		<div class="item_value1"><?php echo $othersku; ?></div>
		<?php } ?>
        
		<?php
		$manufacturer = $meta['manufacturer'][0];
		if(!empty($manufacturer)){ ?>
		<div class="item_key1">Manufacturer:</div>
		<div class="item_value1"><?php echo $manufacturer; ?></div>
		<?php } ?>
		<div style="clear: both; float: none; display: block"></div>
	</div>
	
	<?php 
	// Key Features
	if( $fields = get_field('key_features') ) : ?>
	<div class="group_box">
		<div class="title">Key features:</div>
		<ul class="list_features tick">
		<?php
			foreach( $fields as $field=>$feature ): ?>
			<li><?php echo $feature['feature']; ?></li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
	
	<div class="excerpt" itemprop="post-content">
		<?php
			$content = apply_filters('the_content', $post->post_content);
			echo $content;
		?>	
	</div>
	
	<?php
	// Dimensions
	if( $dimensions = get_field('dimensions') ) : ?>
	<div class="group_box">
		<div class="item_key1">Dimensions:</div>
		<div class="item_value1"><?php echo $dimensions; ?></div>
		<div class="clearfix"></div>
	</div>
	<?php endif; ?>
	
	<?php 
	// Warranty
	if( isset($warranty_name) ) : ?>
    <style>
	.woocommerce .product.summary .group_box2.warranty {padding: 18px 48px}
	.warranty_no_warranty {background-image: none !important; padding-left: 14px !important;}
    </style>
	<?php if($warranty_name != "No Warranty"){ ?>
	<div class="group_box2 warranty <?php echo "warranty_" . $warranties; ?>">
		<div class="title"><?php echo $warranty_name; ?></div>
		<p><?php echo $warranty_value; ?></p>
	</div>
	<?php } ?>
	<?php endif; ?>
	
	<?php
	// Services
	$services = get_field("acf_services");	
	foreach($services as $service){ ?>
	<div class="group_box2 included">
		<p><b><?php echo $service['label']; ?></b></p>
		<p><?php echo $service['text']; ?></p>
	</div>
	<?php } ?>
	
	<?php 
	function download_count($downloads){
		$count = 0;
		foreach($downloads as $download){
			if(empty($download['file'])){continue;}
			$count++;
		}
		return $count;
	}
	
	// Downloads
	$downloads = get_field("acf_product-downloads"); 
	if(download_count($downloads) > 0){
	?>
	<ul class="group_downloadspec">
		<?php
		foreach($downloads as $download){
			$attachment = $download['file'];
			$label = $download['label'];
			$file_url = wp_get_attachment_url($attachment);
			$file_size = round(filesize(get_attached_file($attachment)) / 1024 / 1024, 2, PHP_ROUND_HALF_UP);
			$file_ext = wp_check_filetype($file_url);
			$file_ext = strtoupper($file_ext['ext']);
			echo "<li><a href=\"{$file_url}\" target=\"_blank\">{$label}<span>{$file_ext} file - {$file_size}MB</span></a></li>";
		}
		?>
	</ul>
	<?php
	}
	?>
</div>
