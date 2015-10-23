<?php
global $override_parent;

/* PJ #1 - Fetch sidebar pages */
$parent = $post->post_parent;
$is_landing = ($parent > 0 ? false : true);
$current = $post->ID;
if($is_landing){$parent = $post->ID;}

$my_wp_query = new WP_Query();
if(!isset($override_parent)){
	$override_parent = $parent;
}
$parent_page = get_page($override_parent);
$allpages = $my_wp_query->query(array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $override_parent,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 ));
$child_pages = $allpages;
$child_pagecount = count($child_pages);
$class1 = "";

if($child_pagecount == 0){
	$class1 = " hidden";
}

?>



<div class="box links<?php echo $class1; ?>">
	<div class="label">
		<a href="<?php echo get_permalink($override_parent); ?>"><?php echo $parent_page->post_title; ?></a>
	</div>
	<ul class="list">
		<?php
		/* PJ #1 - Print child pages as list items */
		for($i = 0; $i < $child_pagecount; $i++){
			$id = $child_pages[$i]->ID;
			$permalink = get_permalink($id);
			$title = $child_pages[$i]->post_title;
			if($current == $id){
			echo "<li><a class=\"current\" href=\"$permalink\">$title</a>\n";}
			else {
			echo "<li><a href=\"$permalink\">$title</a>\n";}
		}
		?>
	</ul>
</div>