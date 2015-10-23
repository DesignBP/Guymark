		
	<div class="container footer">
		
		<div class="block">
			<?php woo_content_after(); ?>
		</div>
		
		<footer>
		
			<div class="block">
				
				<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'primary-menu') ) { ?>
					<nav>
						<?php wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) ); ?>
					</nav>
				<?php }  ?>
				
				<?php // if ( function_exists( 'has_nav_menu') && has_nav_menu( 'footer-menu' ) ) { ?>
				
					<?php // wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'footer-nav', 'menu_class' => 'nav fl', 'theme_location' => 'footer-menu' ) ); ?>
				
				<?php // } ?>
				
				<ul class="last-nav">
					<li class="a"><a href="/privacy-policy/" accesskey="P">Privacy Policy</a><span> | </span></li>
                    <li class="b"><a href="/accessibility/" accesskey="A">Accessibility</a><span> | </span></li>
                    <li class="c"><a href="/site-map/" accesskey="S">Site Map</a><span> |</span></li>
                    <li class="d"><a href="/delivery-and-returns/" accesskey="R">Delivery and Returns</a><span> | </span></li>
					<li class="e"><a href="/conditions-of-sale/" accesskey="C">Conditions of Sale</a></li>
				</ul>

				
				<h6 class="designbp"><a href="http://designbp.ltd.uk" title="Website design by designbp Ltd">website design designbp</a></h6>
				
				<div class="social-media">
					<a href="#" class="facebook" style="display: none"></a>
					<a href="http://www.linkedin.com/company/guymark-uk-ltd" class="linkedin"></a>
					<a href="#" class="twitter" style="display: none"></a>
					<a href="#" class="youtube" style="display: none"></a>
					<div class="clearfix"></div>
				</div>
				
			</div>
		
		</footer>
	
	</div>

<?php wp_footer(); ?>
<?php woo_foot(); ?>

</body>
</html>
