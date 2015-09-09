<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">
		<?php bp_displayed_user_avatar( 'type=full' ); ?>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h3><a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a></h3>

	<span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>

	<?php do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>

			<div id="latest-update">
				<?php

				if ( bp_is_active( 'xprofile' ) ) {

					$bio = bp_get_profile_field_data( array(
						'user_id' => bp_displayed_user_id(),
						'field' => 5
					));

					echo $bio;

				}

				?>
			</div>

		<?php endif; ?>

		<div id="item-buttons">

			<?php do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<?php
		/***
		 * If you'd like to show specific profile fields here use:
		 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		 */
		 do_action( 'bp_profile_header_meta' );

		 ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ); ?>

