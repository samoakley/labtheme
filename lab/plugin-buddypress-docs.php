<?php

/**
 * BuddyPress Docs single Doc
 *
 * @package BuddyPress_Docs
 * @since 1.2
 */

?>

<?php get_header(); ?>

<!-- plugin-buddypress-docs.php -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <?php the_content(); ?>
                    <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>