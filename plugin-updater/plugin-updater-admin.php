<?php
/**
 * Plugin updater admin page and functions.
 *
 * @package EDD Plugin Updater
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class EDD_Plugin_Updater_Admin {

	/**
	 * Variables required for the plugin updater
	 *
	 * @since 1.0.0
	 * @type string
	 */
	 protected $remote_api_url = null;
	 protected $plugin_slug    = null;
	 protected $version        = null;
	 protected $author         = null;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'remote_api_url' => 'http://easydigitaldownloads.com',
			'plugin_slug'    => get_template(),
			'item_name'      => '',
			'license'        => '',
			'version'        => '',
			'author'         => ''
		) );
		extract( $args );

		// Set args
		$this->remote_api_url = $remote_api_url;
		$this->item_name      = $item_name;
		$this->plugin_slug    = sanitize_key( $plugin_slug );
		$this->version        = $version;
		$this->author         = $author;

		add_action( 'admin_menu', array( $this, 'license_menu' ) );
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_init', array( $this, 'license_action' ) );
		add_action( 'update_option_' . $this->plugin_slug . '_license_key', array( $this, 'activate_license' ), 10, 2 );

	}

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 *
	 * since 1.0.0
	 */
	function license_menu() {

		add_theme_page(
			esc_html__( 'Checathlon Plus License', 'checathlon-plus' ),
			esc_html__( 'Checathlon Plus License', 'checathlon-plus' ),
			'manage_options',
			$this->plugin_slug . '-license',
			array( $this, 'license_page' )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	function license_page() {

		$license = trim( get_option( $this->plugin_slug . '_license_key' ) );
		$status  = get_option( $this->plugin_slug . '_license_key_status', false );

		// Checks license status to display under license key
		if ( ! $license ) {
			$message = __( 'Enter your plugin license key.', 'checathlon-plus' );
		} else {
			// delete_transient( $this->plugin_slug . '_license_message' );
			if ( ! get_transient( $this->plugin_slug . '_license_message', false ) ) {
				set_transient( $this->plugin_slug . '_license_message', $this->check_license(), ( 60 * 60 * 24 ) );
			}
			$message = get_transient( $this->plugin_slug . '_license_message' );
		}
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Plugin License', 'checathlon-plus' ); ?></h2>
			<form method="post" action="options.php">

				<?php settings_fields( $this->plugin_slug . '-license' ); ?>

				<table class="form-table">
					<tbody>

						<tr valign="top">
							<th scope="row" valign="top">
								<?php esc_html_e( 'License Key', 'checathlon-plus' ); ?>
							</th>
							<td>
								<input id="<?php echo $this->plugin_slug; ?>_license_key" name="<?php echo $this->plugin_slug; ?>_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
								<label class="description" for="<?php echo $this->plugin_slug; ?>_license_key"><?php echo $message; ?></label>
							</td>
						</tr>

						<?php if ( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php esc_html_e( 'License Action', 'checathlon-plus' ); ?>
							</th>
							<td>
								<?php
								wp_nonce_field( $this->plugin_slug . '_nonce', $this->plugin_slug . '_nonce' );
								if ( false !== $status && 'valid' == $status ) { ?>
									<input type="submit" class="button-secondary" name="<?php echo $this->plugin_slug; ?>_license_deactivate" value="<?php esc_html_e( 'Deactivate License', 'checathlon-plus' ); ?>"/>
								<?php } else { ?>
									<input type="submit" class="button-secondary" name="<?php echo $this->plugin_slug; ?>_license_activate" value="<?php esc_html_e( 'Activate License', 'checathlon-plus' ); ?>"/>
								<?php }
								?>
							</td>
						</tr>
						<?php } ?>

					</tbody>
				</table>
				<?php submit_button(); ?>
			</form>
		<?php
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 *
	 * since 1.0.0
	 */
	function register_option() {
		register_setting(
			$this->plugin_slug . '-license',
			$this->plugin_slug . '_license_key',
			array( $this, 'sanitize_license' )
		);
	}

	/**
	 * Sanitizes the license key.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	function sanitize_license( $new ) {

		$old = get_option( $this->plugin_slug . '_license_key' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->plugin_slug . '_license_key_status' );
			delete_transient( $this->plugin_slug . '_license_message' );
		}

		return $new;
	}

	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	 function get_api_response( $api_params ) {

		 // Call the custom API.
		$response = wp_remote_post(
			add_query_arg( $api_params, $this->remote_api_url ),
			array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params )
		);

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );

		return $response;
	 }

	/**
	 * Activates the license key.
	 *
	 * @since 1.0.0
	 */
	function activate_license() {

		$license = trim( get_option( $this->plugin_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url(),
		);

		$license_data = $this->get_api_response( $api_params );

		// $license_data->license will be either "valid" or "invalid".
		if ( $license_data && isset( $license_data->license ) ) {
			update_option( $this->plugin_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->plugin_slug . '_license_message' );
		}

	}

	/**
	 * Deactivates the license key.
	 *
	 * @since 1.0.0
	 */
	function deactivate_license() {

		// Retrieve the license from the database.
		$license = trim( get_option( $this->plugin_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url(),
		);

		$license_data = $this->get_api_response( $api_params );

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data && ( $license_data->license == 'deactivated' ) ) {
			delete_option( $this->plugin_slug . '_license_key_status' );
			delete_transient( $this->plugin_slug . '_license_message' );
		}
	}

	/**
	 * Checks if a license action was submitted.
	 *
	 * @since 1.0.0
	 */
	function license_action() {

		if ( isset( $_POST[ $this->plugin_slug . '_license_activate' ] ) ) {
			if ( check_admin_referer( $this->plugin_slug . '_nonce', $this->plugin_slug . '_nonce' ) ) {
				$this->activate_license();
			}
		}

		if ( isset( $_POST[$this->plugin_slug . '_license_deactivate'] ) ) {
			if ( check_admin_referer( $this->plugin_slug . '_nonce', $this->plugin_slug . '_nonce' ) ) {
				$this->deactivate_license();
			}
		}

	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	function check_license() {

		$license = trim( get_option( $this->plugin_slug . '_license_key' ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url(),
		);

		$license_data = $this->get_api_response( $api_params );

		// If response doesn't include license data, return
		if ( ! isset( $license_data->license ) ) {
			$message = esc_html__( 'License status is unknown.', 'checathlon-plus' );
			return $message;
		}

		// Get expire date
		$expires = false;
		if ( isset( $license_data->expires ) ) {
			$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
			$renew_link = '<a href="' . esc_url( $this->remote_api_url) . '">' . esc_html__( 'Renew?', 'checathlon-plus' ) . '</a>';
		}

		// Get site counts
		$site_count    = $license_data->site_count;
		$license_limit = $license_data->license_limit;

		// If unlimited
		if ( 0 == $license_limit ) {
			$license_limit = esc_html__( 'unlimited', 'checathlon-plus' );
		}

		if ( $license_data->license == 'valid' ) {
			$message = esc_html__( 'License key is active.', 'checathlon-plus' ) . ' ';
			if ( $expires ) {
				$message .= sprintf( esc_html__( 'Expires %s.', 'checathlon-plus' ), $expires ) . ' ';
			}
			if ( $site_count && $license_limit ) {
				$message .= sprintf( esc_html__( 'You have %1$s / %2$s sites activated.', 'checathlon-plus' ), $site_count, $license_limit );
			}
		} else if ( $license_data->license == 'expired' ) {
			if ( $expires ) {
				$message = sprintf( esc_html__( 'License key expired %s.', 'checathlon-plus' ), $expires );
			} else {
				$message = esc_html__( 'License key has expired.', 'checathlon-plus' );
			}
			if ( $renew_link ) {
				$message .= ' ' . $renew_link;
			}
		} else if ( $license_data->license == 'invalid' ) {
			$message = esc_html__( 'License keys do not match.', 'checathlon-plus' );
		} else if ( $license_data->license == 'inactive' ) {
			$message = esc_html__( 'License is inactive.', 'checathlon-plus' );
		} else if ( $license_data->license == 'disabled' ) {
			$message = esc_html__( 'License key is disabled.', 'checathlon-plus' );
		} else if ( $license_data->license == 'site_inactive' ) {
			// Site is inactive
			$message = esc_html__( 'Site is inactive.', 'checathlon-plus' );
		} else {
			$message = esc_html__( 'License status is unknown.', 'checathlon-plus' );
		}

		return $message;
	}

}
