<?php
/* PJ - Fetch list of categories  */
$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'asc',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => 10,
	'taxonomy'                 => 'category',
	'pad_counts'               => false 
); 
$categories2 = get_categories( $args );
$categories = array_reverse($categories2);

?>



<div class="box links">
	<div class="label">
		Categories
	</div>
	<ul class="list">
		<?php
		/* PJ #1 - Print child pages as list items */
		for($i = 0; $i < count($categories); $i++){
			$cat = $categories[$i];
			$name = $cat->cat_name;
			$link = trim($cat->description);
			//if($current == $id){
			//echo "<li><a class=\"current\" href=\"$link\">$name</a>\n";}
			//else {
			echo "<li><a href=\"$link\">$name</a>\n";
			//}
		}
		?>
	</ul>
</div>