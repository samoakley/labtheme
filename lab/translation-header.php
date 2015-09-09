 <!-- translation-header.php -->
 	<?php
 		if ( (bp_is_group()) || (bp_is_user()) ){
 		// allow for different structure of home & help pages
 	?>
 		 	<div class="col-md-9 col-sm-8">
 	<?php	
 		}
 	?>            
					<div class="member-courses-header"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/banners/translation-banner-transparent.png" class="creative-writing-banner"></div>
							
					<?php
					//$lab_home_link = get_site_url();
					$lab_home_link = get_translation_home(); // translation redirection function may mean we can revert to get_site_url();	
					$user_profile_link = bp_core_get_user_domain( bp_loggedin_user_id() );			
					$user_courses_link = $user_profile_link.'groups/';

					?>
					<div class="trans-subheader container clearfix">
						<?php
						$home_active_class = '';
						$profile_active_class = '';
						$group_active_class = '';
						if((is_front_page())||(is_translation_home())){
						echo "<h2>Welcome!</h2>";
						$home_active_class = 'trans-active';
						} elseif (bp_is_group()){
						echo "<h2>Your Courses</h2>";
						$group_active_class = 'trans-active';
						} elseif (bp_is_user()){
						echo "<h2>Your Profile</h2>";
						$profile_active_class = 'trans-active';
						} elseif (is_help_page()){
						echo "<h2>Help</h2>";
						} elseif (is_translation_help_page()){
						echo "<h2>Help</h2>";
						} else {
						echo "Unassigned";
						}
					
						?>
					
						<ul class="trans-subheader-nav clearfix">
							<li class="trans-nav-link"><a class="trans-nav-home <?php echo $home_active_class; ?>" href="<?php echo $lab_home_link; ?>">Home</a></li>
							<li class="trans-nav-link"><a class="trans-nav-profile <?php echo $profile_active_class; ?>" href="<?php echo $user_profile_link; ?>">Your Profile</a></li>
							<?php if (member_is_in_single_group()){
							//get the group slug
							
							?>
							<li class="trans-nav-link"><a class="trans-nav-courses <?php echo $group_active_class; ?>" href="<?php echo $user_courses_link; ?>">Your Courses</a></li>
							<?php } else { 
							?>
							<li class="trans-nav-link"><a class="trans-nav-courses <?php echo $group_active_class; ?>" href="<?php echo $user_courses_link; ?>">Your Courses</a></li>
							<?php } ?>
						</ul>
					</div>		
 	<?php
 		if ( (bp_is_group()) || (bp_is_user()) ){
 	?>
 		 	</div>
 	<?php	
 		}
 	?>