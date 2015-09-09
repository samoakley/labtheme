<?php
/**
 * Template Name: Left Sidebar Home
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
			// add a shim to replicate missing #buddypress div
			?>			
			<div class="col-md-9 col-sm-8 right">
                <div class="fake-buddypress-shim"></div>
			<?php
			locate_template( array( 'translation-header.php' ), true );
			?>
				<div class="content trans-blog-content">	
			<?php
			} else {
			//default
			?>
			<div class="col-md-9 col-sm-8 right">
                <div class="content">
					<div class="member-courses-header"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/banners/banner-transparent.png" class="creative-writing-banner"></div>
                   
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