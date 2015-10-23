<?php
global $news_category;
?>
			
			<div class="el_content">
				<?php
				
				$content = trim(get_the_content());
				echo $content;

	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' ); }
	elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' ); }
	else { $paged = 1; }

	$query_args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'category_name' => $news_category
	);

	$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.

	remove_filter( 'pre_get_posts', 'woo_exclude_categories_homepage' );

	query_posts( $query_args );
					
	if ( have_posts() ) {
		$count = 0;
		while ( have_posts() ) {
			the_post(); $count++;

				?>
				
				
				<div class="post">
					<div class="featured">
						<?php
						if ( $woo_options['woo_post_content'] != 'content' ) {
							if( has_post_thumbnail() ){
								woo_image( 'width=' . 200 . '&class=thumbnail ' . $woo_options['woo_thumb_align'] );
							}
							else {
								echo "<div class=\"placeholder\"></div>";
							}
						}
						?>
					</div>
					<div class="right">
						<div class="title"><?php the_title(); ?></div>
						<div class="info">
							<div class="publish"><?php echo get_the_date(); ?></div>
							<div class="category" style="display: none"></div>
							<div class="author"><?php the_author(); ?></div>
							<div class="clearfix"></div>
						</div>
						<div class="content">
							<?php the_excerpt("...", ""); ?>
						</div>
						<a class="permalink" href="<?php the_permalink(); ?>">read full article</a>
					</div>
					<div class="clearfix"></div>
				</div>
				
				
<?php }} ?>
				
				
				
				
				<?php woo_pagenav(); ?>
			</div>