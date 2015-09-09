<footer>
    <div class="container clearfix">
        <div class="row">
        	<?php
        	//BEGIN Added by Sam
        	
        	if ( (! is_super_admin())&&(member_is_in_translation_group()) ){
        	?>
        	<ul class="translation-logos">
        		<li><a href="http://www.selectcentre.org/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/select-centre.png" class="select-centre-logo"></a></li>
        		<li><a href="http://www.selectcentre.org/translatorslab.html"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/translators-lab.png" class="translators-lab-logo"></a></li>
        		<li><a href="http://www.writerscentrenorwich.org.uk/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/wcn.png" class="wcn"></a></li>
        	</ul>

        	
        	<?php
        	} else {
        	//default
        	?>
        	<ul class="lms-logos">
        		<li><a href="/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/creative-writing.png" class="creative-writing"></a></li>
        		<li><a href="https://www.uea.ac.uk/literature/creative-writing/about-uea-creative-writing"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/uea.png" class="uea"></a></li>
        		<li><a href="http://www.writerscentrenorwich.org.uk/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logos/wcn.png" class="wcn"></a></li>
        	</ul>
        	<?php
        	
        	}
        	//END Added by Sam
        	?>		

        </div>
    </div>
    <div id="scrolltop">
        <a><i class="icon-arrow-1-up"></i><span><?php _e('top','vibe'); ?></span></a>
    </div>
</footer>

<div id="footerbottom">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 id="footerlogo"><a href="/"><img src="/wp-content/uploads/2014/09/uea-wplms-logo.png" alt="New Writing Lab"></a></h2>
            </div>
            <div class="col-md-9">
            	<div id="footermenu"></div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<?php wp_footer(); ?>

</body>
</html>