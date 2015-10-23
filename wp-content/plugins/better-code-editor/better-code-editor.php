<?php
/*
Plugin Name: Better Code Editor
Plugin URI: http://www.SuperbCodes.com/
Description: Make you WordPress code editor with "Better Code Editor".Using this plugin you can modify your code editor.You can see line numbers,detect error in your codes.You can chose 28 different themes for your editor.
Tags: code,codes,editor,wp-admin,plugin-editor.php,theme-editor.php
Version: 1.0
Author:	Nazmul Hossain Nihal
Author URI: http://www.SuperbCodes.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
	
	$nhnbe_options = get_option('nhnbe_settings');
	
	function nhnbe_options_page() {

		global $nhnbe_options;

		ob_start(); ?>
			<div class="wrap">
				<h2>Code Editor</h2>
				<form method="post" action="options.php">
					<?php settings_fields('nhnbe_settings_group'); ?>
					<label for="nhnbe_settings[theme]"><b>Chose a theme for code editor : </b></label><br />
					<?php 
						$options = array(
							array("name"=>"ambiance","value"=>"Ambiance"),
							array("name"=>"chaos","value"=>"Chaos"),
							array("name"=>"chrome","value"=>"Chrome"),
							array("name"=>"clouds","value"=>"Clouds"),
							array("name"=>"clouds_midnight","value"=>"Clouds Midnight"),
							array("name"=>"cobalt","value"=>"Cobalt"),
							array("name"=>"crimson_editor","value"=>"Crimson Editor"),
							array("name"=>"dawn","value"=>"Dawn"),
							array("name"=>"dreamweaver","value"=>"Dreamweaver"),
							array("name"=>"eclipse","value"=>"Eclipse"),
							array("name"=>"github","value"=>"Github"),
							array("name"=>"idle_fingers","value"=>"Idle Fingers"),
							array("name"=>"kr","value"=>"Kr"),
							array("name"=>"merbivore","value"=>"Merbivore"),
							array("name"=>"merbivore_soft","value"=>"Merbivore Soft"),
							array("name"=>"mono_industrial","value"=>"Mono Industrial"),
							array("name"=>"monokai","value"=>"Monokai"),
							array("name"=>"pastel_on_dark","value"=>"Pstel On Dark"),
							array("name"=>"solarized_dark","value"=>"Solarized Dark"),
							array("name"=>"solarized_light","value"=>"Solarized Light"),
							array("name"=>"textmate","value"=>"Textmate"),
							array("name"=>"tomorrow","value"=>"Tomorrow"),
							array("name"=>"tomorrow_night","value"=>"Tomorrow Night"),
							array("name"=>"tomorrow_night_blue","value"=>"Tomorrow Tight Blue"),
							array("name"=>"tomorrow_night_bright","value"=>"Tomorrow Tight Bright"),
							array("name"=>"tomorrow_night_eighties","value"=>"Tomorrow Tight Eighties"),
							array("name"=>"twilight","value"=>"Twilight"),
							array("name"=>"vibrant_ink","value"=>"Vibrant Ink")
						);
					?>
					<select id="nhnbe_settings[theme]" name="nhnbe_settings[theme]" style="height:400px;width:300px;" size="5">
						<?php foreach($options as $option): ?>
							<option value="<?php echo $option["name"]; ?>"<?php if($nhnbe_options["theme"]==$option["name"]){echo' selected="true"';}elseif($nhnbe_options["theme"]==""&$option["name"]=="tomorrow"){{echo' selected="true"';}} ?>><?php echo $option["value"]; ?></option>
						<?php endforeach; ?>						
					</select>
					<br /><br />
					<iframe src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fnazmul.hossain.nihal&amp;width&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;show_faces=false&amp;appId=715408735224516" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
					<br />
					If you find this plugin useful then please rate this plugin <a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/better-code-editor/" target="_blank">here</a> <br /> and don't forget to visit my website <a style="text-decoration:none;" href="http://www.SuperbCodes.com/" target="_blank">SuperbCodes.com</a>.
					<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FYMPLJ69H9EM6" target="_blank"><img style="width:100px;height:30px;" alt="Donate" src="<?php echo plugin_dir_url( __FILE__ ); ?>images/donate.gif" /></a></p>
					<br />
					<input type="submit" class="button-primary" value="Save Your Settings" />
				</form>
			</div>
		<?php
		echo ob_get_clean();
	}

	function nhnbe_add_options_link() {
		add_options_page('Code Editor', 'Code Editor', 'manage_options', 'nhnbe-options', 'nhnbe_options_page');
	}
	add_action('admin_menu', 'nhnbe_add_options_link');

	function nhnbe_register_settings() {
		register_setting('nhnbe_settings_group', 'nhnbe_settings');
	}
	add_action('admin_init', 'nhnbe_register_settings');
	
	function nhnbe_scripts_method() {
		if(is_admin()){
			wp_enqueue_script('custom_admin_script_1',  plugins_url('/js/jquery.js', __FILE__), array('scriptaculous'));
			wp_enqueue_script('custom_admin_script_2',  plugins_url('/js/ace.js', __FILE__), array('scriptaculous'));
			wp_enqueue_script('custom_admin_script_3',  plugins_url('/js/jquery-ace.min.js', __FILE__), array('scriptaculous'));
			wp_enqueue_script('custom_admin_script_4',  plugins_url('/js/mode-css.js', __FILE__), array('scriptaculous'));
			wp_enqueue_script('custom_admin_script_5',  plugins_url('/js/mode-php.js', __FILE__), array('scriptaculous'));
			wp_enqueue_script('custom_admin_script_6',  plugins_url('/js/mode-javascript.js', __FILE__), array('scriptaculous'));
		}
	}    

	add_action('init', 'nhnbe_scripts_method');
	
	function nhnbe_admin() {
	ob_start(); ?>
		<style type="text/css">
			.ace_gutter{
				max-width:50px!important;	
			}
			#newcontent,#template{
				min-width:750px!important;
			}
			.ace_scrollbar,.ace_scrollbar-inner{
				max-width:50px!important;
				padding-right:0px!important;
			}
			#templateside{
				text-align:right!important;
			}
		</style>
	<?php
		echo ob_get_clean();
	}
	add_action('admin_head', 'nhnbe_admin');
	
	function nhnbe_footer() {
	ob_start(); ?>
		<?php
			if(isset($_GET["file"])){
				$file = $_GET["file"];
				$file = explode(".",$file);
				$file_count = count($file)-1;
				if($file[$file_count]=="php"){
					$file_type = "php";
				}elseif($file[$file_count]=="js"){
					$file_type = "javascript";
				}elseif($file[$file_count]=="css"){
					$file_type = "css";
				}else{
					$file_type = "php";
				}
			}else{
				if(basename($_SERVER['PHP_SELF'])=="theme-editor.php"){
					$file_type = "css";
				}else{
					$file_type = "css";
				}
			}
			global $nhnbe_options;
			if(isset($nhnbe_options) and $nhnbe_options["theme"] <> ""){
				$theme = $nhnbe_options["theme"];				
			}else{
				$theme = "tomorrow";
			}
		?>
		<script>
		  $('#newcontent').ace({ theme: '<?php echo $theme; ?>', lang: '<?php echo $file_type; ?>' })
		</script>
	<?php
		echo ob_get_clean();
	}
	
	add_filter('admin_footer_text', 'nhnbe_footer');
	
?>