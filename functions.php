<?php



/**
 * Enable TinyMCE editor in bbPress
 */
function lab_enable_visual_editor( $args = array() ) {

	// add TinyMCE
	$args['tinymce'] = true;

	// --<
	return $args;

}

// add filter for the above
add_filter( 'bbp_after_get_the_content_parse_args', 'lab_enable_visual_editor' );



/**
 * Enable TinyMCE paste plugin
 */
function newwriting_add_paste_plugin( $args ) {
	if ( ! in_array( 'paste', $args ) ) array_push( $args, 'paste' );
	return $args;
}
add_filter( 'teeny_mce_plugins', 'newwriting_add_paste_plugin');



/**
 * Enable paste_sticky as default
 */
function newwriting_myformatTinyMCE( $in ) {
	$in['paste_text_sticky'] = true;
	$in['paste_text_sticky_default'] = true;
	return $in;
}
add_filter('teeny_mce_before_init', 'newwriting_myformatTinyMCE');



/**
 * Override output of breadcrumb trail - we don't need it
 *
 * @return void
 */
function vibe_breadcrumbs() {}



/**
 * Redirect to user's Profile
 *
 * @return void
 */
function newwriting_child_redirect() {

	// bail if not logged in
	if ( ! is_user_logged_in() ) return;

	// bail if not BP root site
	if ( ! bp_is_root_blog() ) return;

	// bail if POST
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) return;

	// if restricted pages requested
	if (
		bp_is_activity_directory() OR // activity directory
		bp_is_members_directory() // members directory
	) {

		// get profile URL
		$home = bp_core_get_user_domain( bp_loggedin_user_id() ) . 'groups/';

		// redirect to member's profile
		wp_redirect( $home );
		exit();

	}

	// groups directory
	if ( bp_is_groups_directory() ) {

		// bail if admin
		if ( ! is_super_admin() ) {

			// get profile URL
			$home = bp_core_get_user_domain( bp_loggedin_user_id() ) . 'groups/';

			// redirect to member's profile
			wp_redirect( $home );
			exit();

		}

	}

	// groups directory
	if ( is_front_page() ) {

		// bail if admin
		if ( ! is_super_admin() ) {

			// get profile URL
			$home = bp_core_get_user_domain( bp_loggedin_user_id() ) . 'groups/';

			// redirect to member's profile
			wp_redirect( $home );
			exit();

		}

	}

}

// add template redirect behaviour
//add_action( 'wp', 'newwriting_child_redirect' );



/**
 * Override styles by enqueueing as late as we can
 *
 * @return void
 */
function newwriting_wplms_enqueue_styles() {

	// add child theme's css file
	wp_enqueue_style(

		'newwriting_wplms_css',
		get_stylesheet_directory_uri() . '/assets/css/style-overrides.css',
		null, // deps
		'1.4', // version
		'all' // media

	);

}

// add a filter for the above
add_filter( 'wp_enqueue_scripts', 'newwriting_wplms_enqueue_styles', 998 );



/**
 * Do not show some Nav Items for Students
 *
 * @return void
 */
function newwriting_wplms_no_nav_item( $list_item_html, $list_item ) {

	// does the user have a cap that students do not?
	//if ( current_user_can( 'edit_posts' ) ) return $list_item_html;

	// --<
	return '';

}

// add filters for the above
add_filter( 'bp_get_displayed_user_nav_blogs', 'newwriting_wplms_no_nav_item', 10, 2 );
add_filter( 'bp_get_displayed_user_nav_invite-anyone', 'newwriting_wplms_no_nav_item', 10, 2 );



/**
 * Do not show some Nav Items for Students on Groups
 *
 * @return void
 */
function newwriting_wplms_no_group_nav_item( $list_item_html, $list_item ) {

	/*
	print_r( array(
		'list_item_html' => $list_item_html,
		'list_item' => $list_item
	) );
	print_r( '----------------------' );
	*/

	// is this a group?
	if ( ! bp_is_group() ) return $list_item_html;

	// does the user have a cap that students do not?
	if ( current_user_can( 'edit_posts' ) ) return $list_item_html;

	// --<
	return '';

}

add_filter( 'bp_get_options_nav_nav-invite-anyone', 'newwriting_wplms_no_group_nav_item', 10, 2 );



/**
 * Do not show some Nav Items for Students on Groups
 *
 * @return void
 */
function newwriting_register_bp_buttons() {

	// Friends button
	if ( bp_is_active( 'friends' ) )
		add_action( 'bp_member_header_actions',    'bp_add_friend_button',           15 );

	/*
	// Activity button
	if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() )
		add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );
	*/

	// Messages button
	if ( bp_is_active( 'messages' ) )
		add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

}

// add an action to enable compatibility with BuddyPress
add_action( 'after_setup_theme', 'newwriting_register_bp_buttons', 100 );



/**
 * Replacement for bp_docs_tabs()
 *
 * Outputs the tabs at the top of the Docs view (All Docs, New Doc, etc)
 *
 * At the moment, the group-specific stuff is hard coded in here.
 * @todo Get the group stuff out
 */
function newwriting_bp_docs_tabs( $show_create_button = true ) {
	$current_view = '';

	?>

	<ul id="bp-docs-all-docs">

		<?php if ( is_user_logged_in() ) : ?>

			<?php if ( function_exists( 'bp_is_group' ) && bp_is_group() ) : ?>

				<li<?php if ( bp_is_current_action( 'docs' ) ) : ?> class="current"<?php endif ?>><a href="<?php bp_group_permalink( groups_get_current_group() ) ?><?php bp_docs_slug() ?>"><?php printf( __( "Assignments in %s", 'bp-docs' ), bp_get_current_group_name() ) ?></a></li>

				<?php if ( $show_create_button ) : ?>
					<?php bp_docs_create_button() ?>
				<?php endif ?>

			<?php else : ?>

				<li><a href="<?php bp_docs_mydocs_started_link() ?>"><?php _e( 'Started By Me', 'bp-docs' ) ?></a></li>
				<li><a href="<?php bp_docs_mydocs_edited_link() ?>"><?php _e( 'Edited By Me', 'bp-docs' ) ?></a></li>

				<?php if ( bp_is_active( 'groups' ) ) : ?>
					<li<?php if ( bp_docs_is_mygroups_docs() ) : ?> class="current"<?php endif; ?>><a href="<?php bp_docs_mygroups_link() ?>"><?php _e( 'My Groups', 'bp-docs' ) ?></a></li>
				<?php endif ?>

			<?php endif ?>

		<?php endif ?>

	</ul>
	<?php
}



/**
 * Override Create New Doc link
 */
function newwriting_bp_docs_create_button( $link ) {
	if ( bp_is_group() ) {
		return str_replace( 'Create New Doc', 'Upload your work', $link );
	}
	return '';
}
add_filter( 'bp_docs_create_button', 'newwriting_bp_docs_create_button', 20, 1 );



/**
 * Sort the navigation items on a group's menu
 */
function newwriting_sort_subnav_items() {
	global $bp;

	if ( ! isset( $bp->groups->current_group->slug ) ) return;
	if ( ! isset( $bp->bp_options_nav[$bp->groups->current_group->slug] ) ) return;
	if ( empty( $bp->bp_options_nav[$bp->groups->current_group->slug] ) ) return;

	// init new list
	$new = array();
	$unset = array();

	foreach( $bp->bp_options_nav[$bp->groups->current_group->slug] AS $key => $item ) {

		switch( $item['slug'] ) {
			case 'home':
				$home = $item['position'];
				break;
			case 'documents':
				$unset[] = $item['position'];
				$item['position'] = 11;
				break;
			case 'assignments':
				$unset[] = $item['position'];
				$item['position'] = 21;
				break;
			case 'workshop':
				$unset[] = $item['position'];
				$item['position'] = 31;
				break;
			case 'forum':
				$unset[] = $item['position'];
				$item['position'] = 35;
				break;
			case 'calendar':
				$unset[] = $item['position'];
				$item['position'] = 41;
				break;
			case 'wpmudev-chat-bp-group':
				$unset[] = $item['position'];
				$item['position'] = 51;
				break;
		}
		//print_r( array( $key, $item['name'], $item['slug'], $item['position'] ) );

		// add to new
		$new[$item['position']] = $item;

	}
	//die();

	foreach( $unset AS $key ) {
		unset( $bp->bp_options_nav[$bp->groups->current_group->slug][$key] );
	}

	foreach( $new AS $key => $item ) {
		$bp->bp_options_nav[$bp->groups->current_group->slug][$key] = $item;
	}

	// rename "activity" to "newsfeed"
	if ( isset( $home ) ) {
		$bp->bp_options_nav[$bp->groups->current_group->slug][$home]['name'] = __( 'Newsfeed', 'buddypress' );
	}

	ksort( $bp->bp_options_nav[$bp->groups->current_group->slug] );

}
add_action( 'wp_head', 'newwriting_sort_subnav_items' );



/**
 * Sort the navigation items on a user's profile menu
 */
function newwriting_sort_profile_nav_items() {

	global $bp;
	if ( ! isset( $bp->bp_nav ) ) return;

	foreach( $bp->bp_nav AS $key => &$item ) {

		switch( $item['slug'] ) {
			case 'activity':
				$item['name'] = __( 'Newsfeed' );
				break;
			case 'groups':
				$item['name'] = __( 'Courses' );
				break;
		}
		//print_r( array( $key, $item['name'], $item['slug'], $item['position'] ) );

		// add to new
		$new[$item['position']] = $item;

	}

	//print_r( $bp->bp_nav ); die();

	// bail if we have enough privileges
	if ( current_user_can( 'edit_posts' ) ) return;

	// bail if it's not a profile view
	if ( ! bp_is_user() ) return;

	// bail if it's our profile
	if ( bp_displayed_user_id() == bp_loggedin_user_id() ) return;

	// init new list
	$new = array();
	$unset = array();

	foreach( $bp->bp_nav AS $key => &$item ) {

		switch( $item['slug'] ) {
			case 'assignments':
			case 'forums':
			case 'groups':
				$item['show_for_displayed_user'] = 0;
				break;
		}
		//print_r( array( $key, $item['name'], $item['slug'], $item['position'] ) );

		// add to new
		$new[$item['position']] = $item;

	}

	//print_r( $bp->bp_nav ); die();

}
add_action( 'wp_head', 'newwriting_sort_profile_nav_items' );



/**
 * Add an activity nav item
 */
function newwriting_add_activity_tab() {

	global $bp;

	if ( bp_is_group() ) {

		//die('yep');

		bp_core_new_subnav_item(
			array(
				'name' => 'Newsfeed',
				'slug' => 'activity',
				'parent_slug' => $bp->groups->current_group->slug,
				'parent_url' => bp_get_group_permalink( $bp->groups->current_group ),
				'position' => 11,
				'item_css_id' => 'nav-activity',
				'screen_function' => create_function('',"bp_core_load_template( apply_filters( 'groups_template_group_home', 'groups/single/home' ) );"),
				'user_has_access' => 1
			)
		);

		if ( bp_is_current_action( 'activity' ) ) {
			add_action( 'bp_template_content_header', create_function( '', 'echo "' . esc_attr( 'Newsfeed' ) . '";' ) );
			add_action( 'bp_template_title', create_function( '', 'echo "' . esc_attr( 'Newsfeed' ) . '";' ) );
		}

	}
}

//add_action( 'bp_actions', 'newwriting_add_activity_tab', 8 );



/**
 * Sort the navigation items on a group's menu
 */
function newwriting_sort_user_subnav_items() {

	global $bp;

	// bail if it's not a profile view
	if ( ! bp_is_user() ) return;

	//print_r( $bp ); die();

	if ( ! isset( $bp->bp_options_nav ) ) return;
	if ( ! isset( $bp->bp_options_nav['activity'] ) ) return;

	foreach( $bp->bp_options_nav['activity'] AS $key => $item ) {

		switch( $item['slug'] ) {
			case 'groups':
				$groups = $item['position'];
				break;
		}
		//print_r( array( $key, $item['name'], $item['slug'], $item['position'] ) );

	}
	//die();

	// rename "groups" to "courses"
	if ( isset( $groups ) ) {
		$bp->bp_options_nav['activity'][$groups]['name'] = __( 'Courses', 'buddypress' );
	}

}
add_action( 'wp_head', 'newwriting_sort_user_subnav_items' );



/**
 * Register sidebars and widgetized areas.
 */
function newwriting_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Homepage Sidebar' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'newwriting_widgets_init' );



/**
 * Check if use has role...
 */
function newwriting_is_lurker() {

	// super admins are never lurkers
	if ( is_super_admin() ) return false;

	// init return
	$is_lurker = false;

	// get user
	$user = wp_get_current_user();

	// if our user has the lurk capability...
	if ( $user->has_cap( 'bp_lurker' ) ) $is_lurker = true;

	// --<
	return $is_lurker;

}



/**
 * Filter the search string
 *
 * @since 0.1
 * @return void
 */
function newwriting_search_string( $default_text, $component ) {

	// bail if not groups component
	if ( $component != 'groups' ) return $default_text;

	// fallback
	return __( 'Search Courses...' );

}

// filter search string
add_filter( 'bp_get_search_default_text', 'newwriting_search_string', 20, 2 );




// Essentials
include_once 'includes/config.php';
include_once 'includes/init.php';

// Register & Functions
include_once 'includes/register.php';
include_once 'includes/func.php';


include_once '_inc/ajax.php';

// BEGIN Added by Sam Oakley

/*
// use 'wp_before_admin_bar_render' hook to also get nodes produced by plugins.
add_action( 'wp_before_admin_bar_render', 'add_all_node_ids_to_toolbar' );

https://codex.wordpress.org/Function_Reference/get_nodes#Display_all_Node_ID.27s_of_the_Current_Page_in_the_Toolbar
function add_all_node_ids_to_toolbar() {

	global $wp_admin_bar;
	$all_toolbar_nodes = $wp_admin_bar->get_nodes();

	if ( $all_toolbar_nodes ) {

		// add a top-level Toolbar item called "Node Id's" to the Toolbar
		$args = array(
			'id'    => 'node_ids',
			'title' => 'Node ID\'s'
		);
		$wp_admin_bar->add_node( $args );

		// add all current parent node id's to the top-level node.
		foreach ( $all_toolbar_nodes as $node  ) {
			if ( isset($node->parent) && $node->parent ) {

				$args = array(
					'id'     => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
					'title'  => $node->id,
					'parent' => 'node_ids'
					// 'href' => $node->href,
				);
				// add parent node to node "node_ids"
				$wp_admin_bar->add_node($args);
			}
		}

		// add all current Toolbar items to their parent node or to the top-level node
		foreach ( $all_toolbar_nodes as $node ) {

			$args = array(
				'id'      => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
				'title'   => $node->id,
				// 'href' => $node->href,
			);

			if ( isset($node->parent) && $node->parent ) {
				$args['parent'] = 'node_id_'.$node->parent;
			} else {
				$args['parent'] = 'node_ids';
			}

			$wp_admin_bar->add_node($args);
		}
	}
}
*/


/*
TRANSLATION GROUP MEMBERSHIP
*/

// are we in a translation group?
function is_translation_group(){
	global $bp;
	$group_id = bp_get_current_group_id();
	//echo $group_id;
	$groupblogtype = groups_get_groupmeta( $group_id, 'groupblogtype' );
	if ($groupblogtype=='groupblogtype-2'){
	return true;
	} else {
	return false;
	}
}

// is member in at least one translation group?
function member_is_in_translation_group(){
	global $bp;
	$user_id = bp_loggedin_user_id();
	$members_groups_array = groups_get_user_groups( $user_id );
	$members_groups = ($members_groups_array[groups]);
	
	$group_check = 0;
	foreach ($members_groups as $key => $group_id){
		$groupblogtype = groups_get_groupmeta( $group_id, 'groupblogtype' );
			if ($groupblogtype=='groupblogtype-2'){
			$group_check++;
			} else{
			
			}
	
	}
	//echo $group_check;
	if ($group_check > 0){
		return true;
	} else {
		return false;
	}
}

// is member *only* in one group?
//  couple with the above to determine membership of one group (that group being a translation group)
function member_is_in_single_group(){
	global $bp;
	$user_id = bp_loggedin_user_id();
	$members_groups_array = groups_get_user_groups( $user_id );
	$members_groups = ($members_groups_array[groups]);
	 if (count($members_groups) == 1){
	 return true;
	 } else{
	 return false;
	 }
}

/*
PAGE DETECTION
*/

// detect the main site help page by slug
function is_help_page(){
	if( is_page( 'help' ) ) {
		 	return true;
			} else {
			return false;
			}
}

// detect the translation group help page by slug
function is_translation_help_page(){
	if( is_page( 'translation-help' ) ) {
		 	return true;
			} else {
			return false;
			}
}		

// return the translation group home page by slug
// returns page link
function get_translation_home(){
		$lab_home_slug = 'translation-home';
		$lab_home_page = get_page_by_path($lab_home_slug);
		$lab_home_id = $lab_home_page->ID;
		$lab_home_page_link = get_page_link($lab_home_id);
		
		return $lab_home_page_link;
}

// detect the translation group home page
function is_translation_home(){
	global $post;
	$this_page = get_page_link($post->id);
	$translation_home = get_translation_home();
	if ($this_page == $translation_home){
		return true;
	}else{
		return false;
	}
}

/*
ADD BODY CLASSES
*/

// add body class to profile pages if member is in a translation group
function add_translation_profile_class($classes){
if ( (! is_super_admin())&&(bp_is_user()) ){
					if (member_is_in_translation_group()){
						 $classes[] = 'translation-member-profile';
						 
						} else {
							//do nothing				
						}
					
				}
	return $classes;
}
add_filter( 'body_class', 'add_translation_profile_class' );

// add body class to group pages if we're in a translation group
function add_translation_group_class($classes){
if ( (! is_super_admin())&&(bp_is_group()) ){
					if (is_translation_group()){
						 $classes[] = 'translation-group';
						 
						} else {
							//do nothing				
						}
					
				}
	return $classes;
}
add_filter( 'body_class', 'add_translation_group_class' );

// add body class to translation home page
function add_translation_home_class($classes){
if  (! is_super_admin()) {
					if (is_translation_home()){
						 $classes[] = 'translation-home';
						 
						} else {
							//do nothing				
						}
					
				}
	return $classes;
}
add_filter( 'body_class', 'add_translation_home_class' );

/*
REDIRECT ON LOGIN
*/

// redirect translation group members to translation group home page
function translation_user_login_redirect(){
	global $bp;
	if( is_user_logged_in() && bp_is_front_page() ) {
			if ((! is_super_admin())&&(member_is_in_translation_group())){
				$redirect_page = get_translation_home();
				bp_core_redirect( $redirect_page );
			} else {}
	}

}
add_action( 'get_header', 'translation_user_login_redirect',1);


/*
REORGANISE BLACK WP ADMIN BAR CONTENTS
*/
//alter for non Super-Admins only

function translation_group_admin_bar_tweaks(){
if	( (! is_super_admin()) &&( (is_translation_group())|| (member_is_in_translation_group()) ) ){
	
		global $wp_admin_bar;
		// add WordPress logo
		$wp_admin_bar->remove_menu( 'my-sites' );
		$wp_admin_bar->remove_menu( 'site-name' );
		$wp_admin_bar->remove_menu( 'updates' );
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-content' );
		$wp_admin_bar->remove_menu( 'group-admin' );
			
		$args = array(
		'id' => 'wcn-help',
		'title' => __( 'Help', 'wcn' ),
		'href' => '/translation-help/',
		'parent' => 'top-secondary'
		);
		$wp_admin_bar->add_menu( $args );		
		
		$args = array(
		'id' => 'wpmudev-chat-container',
		'parent' => 'top-secondary',
		);
		$wp_admin_bar->add_menu( $args );
		
			
		}

}
add_action( 'wp_before_admin_bar_render', 'translation_group_admin_bar_tweaks', 2000); // trump the similar function in writers-centre.php (1000)

/*
REORGANISE GROUP & PROFILE SIDEBARS
*/

//NOT WORKING - remove before launch
/*
function translation_group_subnav_items() {

	if (is_translation_group()){
		global $bp;
		//unset($bp->bp_nav['groups']);
		$slug = $bp->groups->current_group->slug;
		$bp->bp_options_nav[$slug]['documents']['position'] = 200;
		}

}
add_action( 'wp_head', 'translation_group_subnav_items' );
*/

//NOT WORKING - remove before launch
/*
function in_translation_profile_subnav_items() {
		global $bp;
	if (member_is_in_translation_group()){	

		//bp_core_remove_subnav_item( ‘forums’ );
		//$slug = $bp->groups->current_group->slug;
		//$bp->bp_options_nav[$slug]['groups']['position'] = 200;
		}

}
add_action( 'bp_setup_nav’', 'in_translation_profile_subnav_items', 9999);
*/