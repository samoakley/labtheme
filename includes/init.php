<?php
/**
 * Initialization functions
 */

if ( ! isset( $content_width ) ) $content_width = 1170;



function newwriting_after_setup_theme() {

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'buddypress' );
	add_action( 'wp_head', 'bp_head' );
	add_theme_support( 'bp-default-responsive' );
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	add_theme_support( 'post-formats', array( 'aside','image','quote','status','video','audio','chat','gallery' ) );

}
add_action( 'after_setup_theme', 'newwriting_after_setup_theme' );




function vibe_get_option( $field, $compare = NULL) {

	$option = get_option('wplms');
    $return = isset($option[$field]) ? $option[$field] : NULL;
    if(isset($return)){
        if(isset($compare)){
			if($compare === $return){
				return true;
			} else {
				return false;
			}
		}
        return $return;
    } else {
	    return NULL;
	}

}



// Restrict Excerpt Length
if(!function_exists('new_excerpt_length')){
	function new_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
}

if(!function_exists('trim_excerpt')){
	function trim_excerpt($text) {
		$text = str_replace('[', '', $text);
		$text = str_replace(']', '', $text);
		return $text;
		//return rtrim($text,'[...]');
	}
	add_filter('get_the_excerpt', 'trim_excerpt');
}



/*
if(!function_exists('ajaxify_comments')){
	add_action('comment_post', 'ajaxify_comments',20, 2);
	function ajaxify_comments($comment_ID, $comment_status){

		//If AJAX Request Then
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			switch($comment_status){
				case '0':
					//notify moderator of unapproved comment
					wp_notify_moderator($comment_ID);
				case '1': //Approved comment
					echo "success";
					$commentdata=&get_comment($comment_ID, ARRAY_A);
					$post=&get_post($commentdata['comment_post_ID']);
					//wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
					break;
				default:
					echo "error";
			}
			exit;
		}
	}

}
*/



function vibe_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'vibe' ), max( $paged, $page ) ) . " $sep $title";
	} // end if

	return $title;

} // end vibe_wp_title
add_filter( 'wp_title', 'vibe_wp_title', 10, 2 );



if ( ! function_exists( 'newwriting_login_logo' ) ) {
	function newwriting_login_logo() {

		?>
		<style type="text/css">
			body.login div#login h1 a {
				background-image: url(/wp-content/uploads/2014/09/uea-wplms-logo.png);
			}
			.login h1 a {
				width:160px;
				background-size: 100%;
			}
			html,body.login {
				background: #313b3d;
			}
			body:before{
				content: '';
				background: rgba(0,0,0,0.1);
				width: 100%;
				height: 10px;
				position: absolute;
				top: 0;
				left: 0;
			}
			.login label{
				color: #fff;
				font-size: 11px;
				text-transform: uppercase;
				font-weight: 600;
				opacity: 0.8;
			}
			.login form{
				background: none;
				box-shadow: none;
				border-radius: 2px;
				margin: 0;
			}
			.login form .input, .login input[type=text], .login form input[type=checkbox]{
				background: #232b2d;
				border-color: rgba(255,255,255,0.1);
				border-radius: 2px;
				color: #fff;
			}
			.login #nav a, .login #backtoblog a{
				color: #fff;
				text-transform: uppercase;
				font-size: 11px;
				opacity: 0.8;
			}
			div.error, .login #login_error{
				border-radius: 2px;
			}
			#login form p.indicator-hint {
				color: #fff;
			}
			.login #backtoblog a:focus,
			.login #nav a:focus,
			.login h1 a:focus {
				color: #eee;
			}
		</style>
		<?php
	}
}
add_action( 'login_enqueue_scripts', 'newwriting_login_logo' );


