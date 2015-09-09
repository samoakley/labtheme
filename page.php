<?php get_header(); ?>

<!-- page.php -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section id="title">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="pagetitle">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>