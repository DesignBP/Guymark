

function resizeToEqual() {
	//Equal Height Blocks in Rows
	//http://css-tricks.com/equal-height-blocks-in-rows/
	var currentTallest = 0,
	currentRowStart = 0,
	rowDivs = new Array(),
	$el,
	topPosition = 0;


	jQuery('.channel-intro').each(function() {
		$el = jQuery(this);
		topPostion = $el.position().top;
		
		if (currentRowStart != topPostion) {
			// we just came to a new row.  Set all the heights on the completed row
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
			// set the variables for the new row
			rowDivs.length = 0; // empty the array
			currentRowStart = topPostion;
			currentTallest = $el.height();
			rowDivs.push($el);
		} else {
			// another div on the current row.  Add it to the list and check if it's taller
			rowDivs.push($el);
			currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		}
		
		// do the last row
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			rowDivs[currentDiv].height(currentTallest);
		}
		
	});
}

//______________________________________________________________________Set heights on load
		
resizeToEqual();

jQuery(window).on('resize', (function() {
	resizeToEqual();
}));




	
	
jQuery(function(){ 

	jQuery('.view a').click(function(){

		if(jQuery(this).hasClass('gallery')){
		
			jQuery(this).parent().parent().find('.block').removeClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		} else {
					
			jQuery(this).parent().parent().find('.block').addClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		}
		
		return false;
		
	});
	
	// Uniform
	jQuery("select.orderby, .variations select, input[type=radio]").uniform();
	
	// Carousel
	if (jQuery().jcarousel) {
		jQuery('#featured-products.fp-slider ul.featured-products').jcarousel({
			scroll: 4
		});
		jQuery('.jcarousel-prev, .jcarousel-next').appendTo('#featured-products.fp-slider');
	}
	
	
	
	// 
	
});
