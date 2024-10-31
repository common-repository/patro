<?php

/**
 * Class Lib
 */
class Lib {

	public static $plugin_path;

	public static function init() {

		self::$plugin_path = plugins_url( '/', __FILE__ );
//		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_assets' ) );
//
//		add_action( 'admin_menu', array( __CLASS__, 'lib_menu' ), 65 );
		include_once 'patroooo_information.php';

		include_once 'patroooo_request.php';

		$info = new Patroooo_Information();

		$user_data = $info->get_data();


		$response = Patroooo_Request::_remote_post( $user_data );

		$response_array = json_decode( $response, true );
	}


	public static function lib_menu() {

		$page_title = 'Confirmation?';
		$menu_title = 'Confirmation ?';
		$capability = 'manage_options';
		$menu_slug  = 'confirmation-page';
		$function   = 'confirmation_page';
		$icon_url   = 'dashicons-media-code';
		$position   = 4;

		add_menu_page( $page_title,
			$menu_title,
			$capability,
			$menu_slug,
			array( __CLASS__, $function ),
			$icon_url,
			$position );
	}

	public static function send_request(){


	}
	public static function lib_confirm_yes_view() {

		$post_data = $_POST;

		include_once 'patroooo_information.php';

		include_once 'patroooo_request.php';

		$info = new Patroooo_Information();

		$user_data = $info->get_data();

		foreach ( $user_data as $data_key => $data_value ) {

			if ( ! isset( $post_data[ $data_key ] ) ) {


				unset( $user_data[ $data_key ] );

			}


		}

		$response = Patroooo_Request::_remote_post( $user_data );

		$response_array = json_decode( $response, true );

	}

	public static function lib_default_view() {

		?>
		<h1>We are going to get some information about your website ? </h1>

		<div id="lib-expand-access">
			<button>Expand Access</button>

		</div>


		<form method="post" action="<?php admin_url( 'admin.php?page=confirmation-page' ) ?>">
			<div id="lib-confirmation-block">
				<div class="permission_user_email">
					<label>Email Address</label>
					<input type="checkbox" name="user_email" checked="checked" value="1"/>
				</div>
				<div class="permission_home_url">
					<label>Home URL</label>
					<input type="checkbox" name="home_url" checked="checked" value="1"/>
				</div>
				<div class="permission_wp_version">
					<label>Wordpress Version</label>
					<input type="checkbox" name="wp_version" checked="checked" value="1"/>
				</div>
				<div class="permission_php_version">
					<label>Php version</label>
					<input type="checkbox" name="php_version" checked="checked" value="1"/>
				</div>
				<div class="permission_mysql_version">
					<label>Mysql version</label>
					<input type="checkbox" name="mysql_version" checked="checked" value="1"/>
				</div>
				<div class="permission_custom_data">
					<label>Our plugin data</label>
					<input type="checkbox" name="custom_data" checked="checked" value="1"/>
				</div>
				<div class="permission_ip_details">
					<label>IP Address</label>
					<input type="checkbox" name="ip_details" checked="checked" value="1"/>
				</div>
				<div class="permission_php_os">
					<label>Operating System</label>
					<input type="checkbox" name="php_os" checked="checked" value="1"/>
				</div>
				<div class="permission_all_plugins">
					<label>Plugin Info</label>
					<input type="checkbox" name="all_plugins" checked="checked" value="1"/>
				</div>
				<div class="permission_all_themes">
					<label>Theme Info</label>
					<input type="checkbox" name="all_themes" checked="checked" value="1"/>
				</div>
				<div class="permission_type">
					<label>Product type</label>
					<input type="checkbox" name="type" checked="checked" value="1"/>
				</div>
				<input type="hidden" name="lib_confirm_yes" value="yes"/>
			</div>
			<div style="clear:both"></div>
			<br/>
			<input type="submit" class="button button-primary button-large menu-form ur_save_form_action_button"
			       value="Yes"/>
			<a href="" class="button button-warning button-large menu-form ur_save_form_action_button">No</a>
		</form>


		<?php

	}

	public static function confirmation_page() {


		if ( isset( $_POST['lib_confirm_yes'] ) ) {

			self::lib_confirm_yes_view();

		} else {

			self::lib_default_view();

		}


	}

	public static function admin_assets() {

		wp_register_style( 'lib-styles', self::$plugin_path . '/assets/css/lib-styles.css', array() );
		wp_register_script( 'lib-scrips', self::$plugin_path . '/assets/js/lib-scripts.js', array( 'jquery' ) );
		wp_enqueue_script( 'lib-scrips' );
		wp_enqueue_style( 'lib-styles' );
	}
}


return Lib::init();
?>
