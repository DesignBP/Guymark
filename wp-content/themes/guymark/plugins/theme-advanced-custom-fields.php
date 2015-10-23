<?php
// Hide acf from plugin display if not being used locally
$acf_excluded_domains = array('www.guymark.com');

if( !in_array($_SERVER['SERVER_NAME'], $acf_excluded_domains) ) {
	
	define( 'ACF_LITE' , true );
	
}


// include ACF
include_once get_template_directory() . '/plugins/advanced-custom-fields/acf.php';


// Add repeater field plugin
add_action('acf/register_fields', 'GM_register_fields');

function GM_register_fields() {
	include_once get_template_directory() . '/plugins/acf-repeater/repeater.php';
}


// Add custom options plugin
include_once get_template_directory() . '/plugins/acf-options-page/acf-options-page.php';



// Callable function to check if a product has been toggled available
// Return true or false
function db_is_available_for_purchase( $id = '') {
	global $product;
	
	$product_id = $id ? (int) $id :  $product->id;
	$available_for_purchase = get_field('available_for_purchase', $product_id);	
	$IS_available_for_purchase = ( (int) $available_for_purchase == 1) ? true : false;
	
	return $IS_available_for_purchase;
}
// Available for purchase field
if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_available-for-purchase',
		'title' => 'Available for purchase',
		'fields' => array (
			array (
				'key' => 'field_52ea633f38ecc',
				'label' => __('Available for purchase'),
				'name' => 'available_for_purchase',
				'type' => 'true_false',
				'instructions' => __('Toggle display of add to basket and pricing'),
				'message' => 'Product is available for purchase',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product_variation',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_top-rated-product',
		'title' => 'Top rated product',
		'fields' => array (
			array (
				'key' => 'field_52ea633f38ecd',
				'label' => __('Top rated product'),
				'name' => 'top_rated_product',
				'type' => 'true_false',
				'instructions' => __('Toggle display of product in top rated products list'),
				'message' => 'Product is top rated',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product_variation',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




// Relative services for the product
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_services',
		'title' => 'Services',
		'fields' => array (
			array (
				'key' => 'field_5489c07062ed9',
				'label' => __('Services'),
				'name' => 'acf_services',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5489c07e62eda',
						'label' => __('Label'),
						'name' => 'label',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5489c08d62edb',
						'label' => __('Text'),
						'name' => 'text',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Service',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}





// Related product download files
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_product-downloads',
		'title' => 'Downloads',
		'fields' => array (
			array (
				'key' => 'field_5489b67f05c75',
				'label' => __('Downloads'),
				'name' => 'acf_product-downloads',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5489b8a205c78',
						'label' => __('Label'),
						'name' => 'label',
						'type' => 'text',
						'instructions' => __('This is the text that appears on the download button'),
						'required' => 1,
						'column_width' => '',
						'default_value' => 'Download tech spec',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5489b76605c76',
						'label' => __('File'),
						'name' => 'file',
						'type' => 'file',
						'instructions' => __('Upload a file'),
						'column_width' => '',
						'save_format' => 'id',
						'library' => 'uploadedTo',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add new download',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


// Key features for product pages
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_key-features',
		'title' => 'Key Features',
		'fields' => array (
			array (
				'key' => 'field_52b1b5f131c0f',
				'label' => __('Key Features'),
				'name' => 'key_features',
				'type' => 'repeater',
				'instructions' => __('Add more fields, which will appear in the "Key features" box on the product page.'),
				'sub_fields' => array (
					array (
						'key' => 'field_52b1ba3506201',
						'label' => __('Feature'),
						'name' => 'feature',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Feature Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}





/*----------------------------------------------------------------------------------------
 WARRANTY OPTIONS
 Next two ACF's use a single array of values so they can be matched in the templates.
----------------------------------------------------------------------------------------*/

// Follows the label => name format of ACF: field_name => Display Title
$WARRANTY_CONTENT = array(
		'no_warranty' => array(
				'label' => 'No Warranty',
				'name' => 'no_warranty',
				),
		'standard' => array(
			'label' => '90 Day Warranty',
			'name' => '90_day',
				),
		'standard_12' => array(
			'label' => '12 Month Warranty',
			'name' => '12_month',
				),
		'standard_24' => array(
			'label' => '24 Month Warranty',
			'name' => '24_month',
				),
		'standard_36' => array(
				'label' => '12 Month Warranty with Extended Warranties Available',
				'name' => '12_month_extended',
				),
		'standard_60' => array(
				'label' => '24 Month Warranty with Extended Warranties Available',
				'name' => '24_month_extended',
				),
		'additional_benefits' => array(
			'label' => 'Additional Benefits',
			'name' => 'additional_benefits',
			),
		);

// Warranty theme options
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_theme-options',
		'title' => 'Theme options',
		'fields' => array (
			array (
				'key' => 'field_52b4227c1cb5a',
				'label' => __('Warranty Content'),
				'name' => 'warranty_content',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_52b422fdd0995',
						'label' => __($WARRANTY_CONTENT['standard']['label']),
						'name' => $WARRANTY_CONTENT['standard']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'Guymark warranty which covers the repair of faulty equipment due to a product defect. Parts and labour will be covered with the following exceptions: externally connected accessories, bulbs, batteries, misuse, physical damage, fair wear and tear, modification.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_52b425e0d0996',
						'label' => __($WARRANTY_CONTENT['standard_12']['label']),
						'name' => $WARRANTY_CONTENT['standard_12']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'Standard factory warranty which covers the repair or replacement of faulty equipment due to defects in material or workmanship. Parts and labour will be covered with the following exceptions: externally connected accessories, bulbs, batteries, misuse, physical damage, fair wear and tear, modification.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_52b42604d0997',
						'label' => __($WARRANTY_CONTENT['standard_24']['label']),
						'name' => $WARRANTY_CONTENT['standard_24']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'Standard factory warranty which covers the repair or replacement of faulty equipment due to defects in material or workmanship. Parts and labour will be covered with the following exceptions: externally connected accessories, bulbs, batteries, misuse, physical damage, fair wear and tear, modification.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_52b4265bd0998',
						'label' => __($WARRANTY_CONTENT['standard_36']['label']),
						'name' => $WARRANTY_CONTENT['standard_36']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'Standard factory warranty which covers the repair or replacement of faulty equipment due to defects in material or workmanship. Parts and labour will be covered with the following exceptions: externally connected accessories, bulbs, batteries, misuse, physical damage, fair wear and tear, modification. Extension of the standard factory warranty is available on this product to three or five years which include calibration. (Three year warranties include calibration at the end of years one and two, five year warranties at the end of years one, two, three and four). Calibration can be done either on or off site depending on warranty level.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_52b426b9d0999',
						'label' => __($WARRANTY_CONTENT['standard_60']['label']),
						'name' => $WARRANTY_CONTENT['standard_60']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'Standard factory warranty which covers the repair or replacement of faulty equipment due to defects in material or workmanship. Parts and labour will be covered with the following exceptions: externally connected accessories, bulbs, batteries, misuse, physical damage, fair wear and tear, modification. Extension of the standard factory warranty is available on this product to three or five years which include calibration. (Three year warranties include calibration at the end of years one and two, five year warranties at the end of years one, two, three and four). Calibration can be done either on or off site depending on warranty level.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_52b426dbd099a',
						'label' => __($WARRANTY_CONTENT['additional_benefits']['label']),
						'name' => $WARRANTY_CONTENT['additional_benefits']['name'],
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => 'All return to base calibrations include collection and return carriage charges.
	At the end of year three (or five) an additional 3% (or 5%) discount will be offered for any replacement equipment of a similar type purchased from Guymark UK.',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

// Product Warranty options
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_warranty-options',
		'title' => 'Warranty Options',
		'fields' => array (
			array (
				'key' => 'field_52b3176882daf',
				'label' => __('Warranties'),
				'name' => 'warranties',
				'type' => 'radio',
				'instructions' => __('Select a warranty type'),
				'choices' => array (
					$WARRANTY_CONTENT['no_warranty']['name'] => $WARRANTY_CONTENT['no_warranty']['label'],
					$WARRANTY_CONTENT['standard']['name'] => $WARRANTY_CONTENT['standard']['label'],
					$WARRANTY_CONTENT['standard_12']['name'] => $WARRANTY_CONTENT['standard_12']['label'],
					$WARRANTY_CONTENT['standard_24']['name'] => $WARRANTY_CONTENT['standard_24']['label'],
					$WARRANTY_CONTENT['standard_36']['name'] => $WARRANTY_CONTENT['standard_36']['label'],
					$WARRANTY_CONTENT['standard_60']['name'] => $WARRANTY_CONTENT['standard_60']['label'],
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $WARRANTY_CONTENT['no_warranty']['name'] . ' : ' . $WARRANTY_CONTENT['no_warranty']['label'],
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



// SLIDER
function create_post_type_home_slider() {
	register_taxonomy_for_object_type('category', 'home-slider'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'home-slider');
	register_post_type('home-slider', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Home Page Slides', 'home-slider'), // Rename these to suit
			'singular_name' => __('Slide', 'home-slider'),
			'add_new' => __('Add New', 'home-slider'),
			'add_new_item' => __('Add New Slide', 'home-slider'),
			'edit' => __('Edit', 'home-slider'),
			'edit_item' => __('Edit Slides', 'home-slider'),
			'new_item' => __('New Slide', 'home-slider'),
			'view' => __('View Slides', 'home-slider'),
			'view_item' => __('View Slide', 'home-slider'),
			'search_items' => __('Search Slides', 'home-slider'),
			'not_found' => __('No Slides found', 'home-slider'),
			'not_found_in_trash' => __('No Slides found in Trash', 'home-slider')
		),
		'public' => true,
		'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
		),
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post-tag'
		) // Add Category and Post Tags support
	));
}
add_action('init', 'create_post_type_home_slider');

// Add slide layout functionality fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-page-slides',
		'title' => 'Home page slides',
		'fields' => array (
			array (
				'key' => 'field_52cac7691c169',
				'label' => __('Full width image'),
				'name' => 'full_width_image',
				'type' => 'image',
				'instructions' => __('Image to be used as full width background.'),
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_52cad6f86a1b2',
				'label' => __('First line'),
				'name' => 'first_line',
				'type' => 'text',
				'instructions' => __('First line of text for the slide, 18 character limit.'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 18,
			),
			array (
				'key' => 'field_52cad764a2d68',
				'label' => __('Second line'),
				'name' => 'second_line',
				'type' => 'text',
				'instructions' => __('Second line of text (bolded). 12 char limit.'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 12,
			),
			array (
				'key' => 'field_52cad786a2d69',
				'label' => __('Bold support line'),
				'name' => 'bold_support_line',
				'type' => 'text',
				'instructions' => __('First line of support text (bolded). '),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52cad7b9a2d6a',
				'label' => __('Additional support text'),
				'name' => 'additional_support_text',
				'type' => 'text',
				'instructions' => __('Additional line of support text.'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52d6a77611595',
				'label' => __('Page link'),
				'name' => 'page_link',
				'type' => 'page_link',
				'instructions' => __('Select a page where you want this to link to'),
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_52cad7f2ed0b2',
				'label' => __('Slide support images'),
				'name' => 'slide_support_images',
				'type' => 'repeater',
				'instructions' => __('Add images that will be banked as a gallery.'),
				'sub_fields' => array (
					array (
						'key' => 'field_52cad844ed0b3',
						'label' => __('Gallery image'),
						'name' => 'gallery_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Image',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home-slider',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




// Register the options fields for category selection
if(function_exists("register_field_group"))
{
	
	/**
	 * Array of category names so we can rename in the future if required
	 * format: 'programmatical_name' => array( 'external_label' = > 'local_name', external_label => "Visual name");
	 * We'll rely on the programmatical name for retrieving values
	 */
	 
	$gm_category_names = array(
					'general_blog' => array(
						'internal_label' => 'general_blog',
						'external_label' => "General Blog",
						),
					'specialised_blog' => array(
						'internal_label' => 'specialised_blog',
						'external_label' => "Specialised Blog",
						),
				);
	
	
	register_field_group(array (
		'id' => 'acf_blog-categories',
		'title' => 'Blog categories',
		'fields' => array (
			array (
				'key' => 'field_52cc2c9670a96',
				'label' => __($gm_category_names['general_blog']['external_label']),
				'name' => $gm_category_names['general_blog']['internal_label'],
				'type' => 'taxonomy',
				'instructions' => __('Select a category to be used for the General Blog'),
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_52cc2d4af5fe0',
				'label' => __($gm_category_names['specialised_blog']['external_label']),
				'name' => $gm_category_names['specialised_blog']['internal_label'],
				'type' => 'taxonomy',
				'instructions' => __('Select a blog category for use as the Specialised Blog section'),
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	
	/**
	 * -----------------------------------------------------------------------------------
	 * Blog Category options and management
	 * 
	 * Create some default blog categories to begin with if options not set
	 * Once options are registered:
	 * 
	 * 1 Check if the options are set and not null.
	 * 2 If not set, check if default category names exist, if not, create them.
	 * 3 Produce category names (default or otherwise).
	 * 
	 * -----------------------------------------------------------------------------------*/
	function gm_create_default_cats() {
	
		global $gm_category_names;
	
		foreach( $gm_category_names as $array=>$cat_name ) {
		
			// check if category name already exists, if not create it
			if( !term_exists($cat_name['external_label'], 'category') ) {
				wp_insert_term($cat_name['external_label'], 'category');
			}
		
		}
	}
	add_action('init', 'gm_create_default_cats');
	
	
	/**
	 * -----------------------------------------------------------------------------------
	 * Get a list of 'Options' defined categories for front end output / testing
	 * 
	 * -----------------------------------------------------------------------------------*/
	function gm_get_assigned_options_categories( $field_name = "" ) {
		
		global $gm_category_names;
		
		$categories = false;
		
		if( $field_name ) {
			$blog_categories = get_field($field_name);
			
			return $categories[$field_name] = $blog_categories;
		}else {
			
			foreach( $gm_category_names as $cat_array=>$vals ) {
				
				// check of option is set
				if( $blog_cat_id = get_field($cat_array, 'option')) {
					
					// Assign category data to return value array
					$categories[$cat_array] = get_term_by('id', $blog_cat_id, 'category');
				}
			}
		}
		
		return $categories;
	}
	
	
	
}// end field register check for category setup




// STAFF PROFILES
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_staff-profiles',
		'title' => 'Staff Profiles',
		'fields' => array (
			array (
				'key' => 'field_52e8d55c21946',
				'label' => __('Add a new member of the team'),
				'name' => 'add_a_new_member_of_the_team',
				'type' => 'repeater',
				'instructions' => __('Create a new member of the team'),
				'sub_fields' => array (
					array (
						'key' => 'field_52e8d6927efc2',
						'label' => __('Profile Image'),
						'name' => 'profile_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_52e8d5a921947',
						'label' => __('Name'),
						'name' => 'name',
						'type' => 'text',
						'instructions' => __('Staff Members name'),
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52e8d5cb21948',
						'label' => __('Position'),
						'name' => 'position',
						'type' => 'text',
						'instructions' => __('Staff members job title'),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52e8d5ed21949',
						'label' => __('Department'),
						'name' => 'department',
						'type' => 'select',
						'instructions' => __('Select a department.'),
						'column_width' => '',
						'choices' => array (
							'Administration' => 'Administration',
							'Sales' => 'Sales',
							'Service' => 'Service',
							'Managers' => 'Managers',
						),
						'default_value' => 'Admin',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_52e8d6202194a',
						'label' => __('Sales Region'),
						'name' => 'sales_region',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_52e8d5ed21949',
									'operator' => '==',
									'value' => 'Sales',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52e8d661f2edd',
						'label' => __('Contact Number'),
						'name' => 'contact_number',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52b42691f2e1a',
						'label' => __('Bio'),
						'name' => 'bio',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '150',
						'formatting' => 'br',
					),
				),
				
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add another member',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-staff-profiles.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




// Staff profiles - select meet the team page
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_meet-the-team-page-show-staff-profiles',
		'title' => 'Meet the team page - show staff profiles',
		'fields' => array (
			array (
				'key' => 'field_52e8dd24bbc81',
				'label' => __('Staff profiles'),
				'name' => 'staff_profiles',
				'type' => 'page_link',
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



// Product Dimensions text field
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_dimensions',
		'title' => 'Dimensions',
		'fields' => array (
			array (
				'key' => 'field_52eb62153b31a',
				'label' => __('Product Dimensions'),
				'name' => 'dimensions',
				'type' => 'text',
				'instructions' => __('Add dimensions for this product in the WxHxD format'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product_variation',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	));
	
	
	register_field_group(array (
		'id' => 'acf_manufacturer',
		'title' => 'Manufacturer',
		'fields' => array (
			array (
				'key' => 'field_62eb62153b31b',
				'label' => __('Product Manufacturer'),
				'name' => 'manufacturer',
				'type' => 'text',
				'instructions' => __('Add manufacturer for this product'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product_variation',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	));
}

// BRAND

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_brand',
		'title' => 'Brand',
		'fields' => array (
			array (
				'key' => 'field_52e8d55c21946_brand',
				'label' => __('Add a new brand'),
				'name' => 'add_a_new_brand',
				'type' => 'repeater',
				'instructions' => __('Create a new brand'),
				'sub_fields' => array (
					array (
						'key' => 'field_52e8d6927efc2_brand',
						'label' => __('Profile Image'),
						'name' => 'profile_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_52e8d5a921947_brand',
						'label' => __('Brand Name'),
						'name' => 'name',
						'type' => 'text',
						'instructions' => __('Brand name'),
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52e8d5cb21948_brand',
						'label' => __('Products'),
						'name' => 'position',
						'type' => 'text',
						'instructions' => __('Supplied Products'),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52e8d5ed21949_brand',
						'label' => __('Exclusive'),
						'name' => 'department',
						'type' => 'select',
						'instructions' => __('Exclusivity'),
						'column_width' => '',
						'choices' => array (
							'Exclusive UK Suppliers of' => 'Exclusive UK Suppliers of',
							'Suppliers of' => 'Suppliers of',
						),
						'default_value' => 'Suppliers of',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_52b42691f2e1a_brand',
						'label' => __('Bio'),
						'name' => 'bio',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '150',
						'formatting' => 'br',
					),
				),
				
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add another brand',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-brand.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




// Brand - select our brands page
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_our-brands-page-show-brand',
		'title' => 'Our brands page - show brand',
		'fields' => array (
			array (
				'key' => 'field_52e8dd24bbc81_brand',
				'label' => __('Brand'),
				'name' => 'brand',
				'type' => 'page_link',
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>