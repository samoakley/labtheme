<?php



/*
// FIX : COOKIE LOGIN FIX
// @jpmcafee: http://vibethemes.com/forums/forum/wordpress-html-css/wordpress-themes/wplms/7857-problem-with-user-login
function set_wp_test_cookie() {
	setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
	if ( SITECOOKIEPATH != COOKIEPATH )
		setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);
}
add_action( 'after_setup_theme', 'set_wp_test_cookie', 101 );
*/



// FIX : BP DEFAULT AVATAR FIX
// Refer : https://buddypress.trac.wordpress.org/ticket/4571
add_filter( 'bp_core_fetch_avatar_no_grav', '__return_true' );
add_filter( 'bp_core_default_avatar_user', 'vibe_custom_avatar' );
function vibe_custom_avatar($avatar){
	$avatar = VIBE_URL.'/images/avatar.jpg';
	return $avatar;
}



// Fix for Member/Settings/Profile => 1.5 hrs of reading BuddyPress core code just to find the hook :D
add_filter( 'bp_settings_screen_xprofile', 'bp_settings_custom_profile', 1, 1 );
function bp_settings_custom_profile( $profile ){
  return '/members/single/settings/profile';
}



/*
// Temporary Fix to the WordPress Bug : https://core.trac.wordpress.org/ticket/11330
add_filter( 'request', 'my_request_filter' );
function my_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
*/



add_filter( 'get_avatar', 'change_avatar_css' );
function change_avatar_css( $class ) {
	$class = str_replace("class='avatar", "class='retina_avatar zoom animate", $class) ;
	return $class;
}



function change_wp_login_title() {
  //echo get_option('blogname');
}
//add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');



