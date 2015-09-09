<?php
/**
 * Template Name: Left Sidebar Page
 */

get_header();

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section id="title">
    <div class="container">
        <div class="row">
			<div class="pagetitle">
				<h1><?php the_title(); ?></h1>
			</div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
        	<?php
			// BEGIN Added by Sam
			if ( (! is_super_admin())&&(member_is_in_translation_group()) ){
			?>
            <div class="col-md-9 col-sm-8 right">
            	<div class="member-courses-header">Left Sidebar Page</div>
                <div class="content">					
			<?php
			} else {
			//default
			?>
			<div class="col-md-9 col-sm-8 right">
                <div class="content">
			<?php
			}
			// END Added by Sam
			?>
                    <?php the_content(); ?>
                </div>
                <?php
                
                endwhile;
                endif;
                ?>
            </div>
            <div class="col-md-3 col-sm-4 left">
                <div class="sidebar">
                	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
                	<?php endif; // end sidebar widget area ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<?php get_footer(); ?>