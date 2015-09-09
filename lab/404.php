<?php get_header(); ?>

<!-- 404.php -->

<section id="title">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="pagetitle">
                    <h1><?php _e( 'Not found' ); ?></h1>
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
                    <?php _e( 'Sorry, but this content could not be found' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<?php get_footer(); ?>