<?php get_header(); ?>
	
	
	<?php get_template_part("partials/home-slider"); ?>
	
	
	
	<div class="container strapline">
		<div class="block">
			<h1>The UK's number one retailer, servicer and calibrator of Audiological Equipment</h1>
		</div>
	</div>
	
	
	<div class="container channels">
		<div class="block">
			
			<div class="channel-section inventory-channel">
				<div>
					<div class="channel-intro">
						<h2>Inventory Manager</h2>
						<div class="channel-content">
							<p>Are you researching costs for a major purchase?</p>
							<p>Or creating a reference library for potential purchasing?</p>
						</div>
					</div>
					<div class="channel-link">
						<?php
							$lists = WC_Wishlists_User::get_wishlists();
							$inventory_page = WC_Wishlists_Pages::get_url_for('wishlists');
						?>
						<a href="<?php echo $inventory_page; ?>" title="Find out more about Guymark Inventory manager">Inventory</a>
					</div>
				</div>
			</div>
			
			<div class="channel-section servicing-channel">
				<div>
					<div class="channel-intro">
						<h2>Servicing and Calibration</h2>
						<div class="channel-content">
							<p>Our expert engineers will keep your equipment in peak condition.</p>
							<p>Flexible contracts are available.</p>
						</div>
					</div>
					<div class="channel-link">
						<a href="/servicing-and-calibration/" title="" class="Find out more about Guymark Servicing and Calibration">Find out more</a>
					</div>
				</div>
			</div>
			
			<div class="channel-section shop-channel">
				<div>
					<div class="channel-intro">
						<h2>Buy online</h2>
						<div class="channel-content">
							<p>You can browse, research and purchase many of our products online.</p>
							<p>Payments are secure and protected for your peace of mind.</p>
						</div>
					</div>
					<div class="channel-link">
						<a href="/shop/" title="Shop for Professional Audio products on Guymark">Shop now</a>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	
	
	<?php get_template_part("partials/wc-promoted-products"); ?>
	
	<div class="container guymark-cta">
		<div class="block">
			Call us on: <b>01384 890 600</b> or enquire about any product product <a href="/contact-us/">here</a>
		</div>
	</div>
	
	<div class="container guymark-statement">
		<div class="block">
			<section>
				<h1><span>Guymark UK</span> was established in 1991, specialising in the provision and support of the highest quality medical equipment for the audiology sector.</h1>
				<p>In 1995, we established our sister company, Houseman-Caltec International, to ensure the highest standard of support in calibration and service of audiological equipment. In 1997, Guymark UK and Houseman-Caltec merged to form a total service company.</p>
			</section>
		</div>
	</div>
	
	
	<?php get_template_part("partials/split-blog"); ?>
	

<?php get_footer(); ?>
