<?php
/*
Template Name: Staff Profiles
*/

the_post();

$team_members = get_field('add_a_new_member_of_the_team');


function PJ_profiles_by_department($department, $team){
	?>
	<div class="profilecontainer">
		<?php
		foreach($team as $entry){
			if($entry["department"] == $department){
		?>
		<div class="profile">
			<img height="100%" src="<?php echo $entry["profile_image"]["sizes"]["thumbnail"]; ?>" /><br />
			<div class="name">
				<strong><?php echo $entry["name"]; ?></strong><br />
				<?php echo $entry["position"]; ?>
			</div><br />
			<div class="desc">
				<?php echo $entry["bio"]; ?>
			</div>
		</div>
		<?php 
			}
		} ?>
		<div class="clearfix"></div>
	</div>
	
	<?php
}


?>


<?php get_header(); ?>

	<div class="container style-2 profilepage">

		<div class="block">
			<?php woo_breadcrumbs(); ?>
			<?php get_template_part("partials/pj", "banner"); ?>

			<div class="el_side">
				<?php get_template_part("partials/pj", "sidebar-nav"); ?>
				<?php get_template_part("partials/pj", "sidebar-region"); ?>
				<?php get_template_part("partials/pj", "sidebar-tel2"); ?>
			</div>

			<div class="el_content">
				<?php
				the_content();
				?>
				
				<div class="department">
					<!-- Managers -->
					<div class="title">Managers</div>
					<?php PJ_profiles_by_department("Managers", $team_members); ?>

					<!-- Sales -->
					<div class="title">Sales</div>
					<?php PJ_profiles_by_department("Sales", $team_members); ?>
					
					<!-- Administration -->
					<div class="title">Administration</div>
					<?php PJ_profiles_by_department("Administration", $team_members); ?>
					
					<!-- Service -->
					<div class="title">Service</div>
					<?php PJ_profiles_by_department("Service", $team_members); ?>
					
				</div>
				
				
			</div>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
