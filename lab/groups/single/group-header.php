<!-- groups/single/group-header.php -->
<?php do_action( 'bp_before_group_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_avatar(); ?></a>
</div><!-- #item-header-avatar -->
<div id="item-header-content">
	<h3><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h3>

	<?php do_action( 'bp_before_group_header_meta' ); ?>

	<div id="item-meta">

		<?php do_action( 'wcn_group_meta' ); ?>

		<?php bp_group_description(); ?>

		<div id="item-buttons">
			<?php do_action( 'bp_group_header_actions' ); ?>
		</div><!-- #item-buttons -->

		<?php do_action( 'bp_group_header_meta' ); ?>

	</div>
</div><!-- #item-header-content -->

<div id="item-actions">

	<?php if ( bp_group_is_visible() ) : ?>

		<h3><?php _e( 'Tutors', 'vibe' ); ?></h3>

		<?php bp_group_list_admins();

		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :
			do_action( 'bp_before_group_menu_mods' ); ?>

			<h3><?php _e( 'Moderators' , 'vibe' ); ?></h3>

			<?php bp_group_list_mods();

			do_action( 'bp_after_group_menu_mods' );

		endif;

	endif; ?>

</div><!-- #item-actions -->

<?php do_action( 'bp_after_group_header' ); ?>


