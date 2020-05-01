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

/**
 * Creates settings for the plugin
 */
add_action( 'admin_init', 'wnb_initialize_settings' );
function wnb_initialize_settings() {
	add_settings_section(
		'general_section',                                  // ID used to identify this section and with which to register options
		__( 'General Settings', 'notification-bar' ),   	// Title to be displayed on the administration page
		'general_settings_callback',                        // Callback used to render the description of the section
		'wnb_general_settings'                              // Page on which to add this section of options
	);
	add_settings_field(
		'notification_text',                                // ID used to identify this field
		__( 'Notification Text', 'notification-bar' ),  	// Title to be displayed for this field
		'text_input_callback',                              // The function that creates this field
		'wnb_general_settings',                             // The page that this setting goes under
		'general_section',                                  // The section that this setting goes under
		array(                                              // Arguments that describe this field
			'label_for'    => 'notification_text',
			'option_group' => 'nb_general_settings',
			'option_id'    => 'notification_text',
		)
	);
	add_settings_field(
		'display_location',
		__( 'Where will the notification bar display?', 'notification-bar' ),
		'radio_input_callback',
		'wnb_general_settings',
		'general_section',
		array(
			'label_for'          => 'display_location',
			'option_group'       => 'nb_general_settings',
			'option_id'          => 'display_location',
			'option_description' => 'Display notification bar on bottom of the site',
			'radio_options'      => array(
				'display_none'   => 'Do not display notification bar',
				'display_top'    => 'Display notification bar on the top of the site',
				'display_bottom' => 'Display notification bar on the bottom of the site',
			),
		)
	);
	add_settings_field(
		'display_sticky',
		__( 'Will the notificaton bar be sticky?', 'notification-bar' ),
		'radio_input_callback',
		'wnb_general_settings',
		'general_section',
		array(
			'label_for'          => 'display_sticky',
			'option_group'       => 'nb_general_settings',
			'option_id'          => 'display_sticky',
			'option_description' => 'Make display sticky or not',
			'radio_options'      => array(
				'display_sticky'   => 'Make the notification bar sticky',
				'display_relative' => 'Do not make the notification bar sticky',
			),
		)
	);
	register_setting(
		'wnb_general_settings',
		'nb_general_settings'
	);
}

/**
 * Displays the header of the general settings
 */
function general_settings_callback() {
	esc_html_e( 'Notification Bar Settings', 'notification-bar' );
}
