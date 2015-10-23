<?php
/* PJ #1 - Fetch sidebar pages */

$current = $post->ID;
$my_wp_query = new WP_Query();
$allpages = $my_wp_query->query(array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'order'          => 'DESC',
    'orderby'        => 'date'
 ));
$child_pages = $allpages;

?>



<div class="box links">
	<div class="label">
		Latest News
	</div>
	<ul class="list">
		<?php
		/* PJ #1 - Print child pages as list items */
		for($i = 0; $i < count($child_pages); $i++){
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
	<a class="view-all-news" href="/latest-news/">View all news</a>
</div>