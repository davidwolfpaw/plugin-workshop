<?php
/*
Plugin Name: Notification Bar
Plugin URI: https://fixupfox.com/
Description: Display a notification for visitors on the frontend of your site!
Version: 1.0
Author: wolfpaw
Author URI: https://davidwolfpaw.com/
*/

/**
 * Creates a link to the settings page under the WordPress Settings in the dashboard
 */
add_action( 'admin_menu', 'wnb_general_settings_page' );
function wnb_general_settings_page() {
	add_submenu_page(
		'options-general.php',
		__( 'Notification Bar', 'notification-bar' ),
		__( 'Notification Bar', 'notification-bar' ),
		'manage_options',
		'notification_bar',
		'wnb_render_settings_page'
	);
}

/**
 * Creates the settings page
 */
function wnb_render_settings_page() {
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<h2><?php esc_html_e( 'Notification Bar Settings', 'notification-bar' ); ?></h2>

		<form method="post" action="options.php">

			<?php
			// Get settings for the plugin to display in the form
			settings_fields( 'wnb_general_settings' );
			do_settings_sections( 'wnb_general_settings' );
			// Form submit button
			submit_button();
			?>

		</form>

	</div><!-- /.wrap -->
	<?php
}
