<?php

/**
 * Class Information
 */
class Patroooo_Information {


	/**
	 * @return array
	 */
	public function get_data() {

		$user_id = get_current_user_id();

		$user = get_userdata( $user_id );

		global $wp_version;
		global $wpdb;

		$result = $wpdb->get_results( 'SELECT VERSION() as version;' );

		$mysql_version = isset( $result[0]->version ) ? $result[0]->version : 'N/A';

		$plugin_info = get_plugin_data( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '../patro.php' );

		$plugin_data = array();

		$all_plugins = get_plugins();

		$theme_data = array();

		$all_theme = wp_get_themes();

		$current_theme = wp_get_theme();

		$type = 'plugin';

		$custom_data = array(

			'url' => isset( $plugin_info['PluginURI'] ) ? $plugin_info['PluginURI'] : 'N/A',

			'version' => isset( $plugin_info['Version'] ) ? $plugin_info['Version'] : 'N/A',

			'name' => isset( $plugin_info['Name'] ) ? $plugin_info['Name'] : 'N/A',

			'type' => $type,
		);

		foreach ( $all_theme as $theme_index => $single_theme ) {


			$theme_data[ $theme_index ] = array(

				'url'       => $single_theme->get( 'ThemeURI' ),
				'version'   => $single_theme->get( 'Version' ),
				'name'      => $single_theme->get( 'Name' ),
				'is_active' => 0

			);
			if ( $current_theme->get( 'TextDomain' ) === $single_theme->get( 'TextDomain' ) ) {

				$theme_data[ $theme_index ]['is_active'] = 1;
			}
		}


		foreach ( $all_plugins as $plugin_index => $plugin ) {


			$plugin_data[ $plugin_index ] = array(

				'url'         => $plugin['PluginURI'],
				'version'     => $plugin['Version'],
				'name'        => $plugin['Name'],
				'is_activate' => is_plugin_active( $plugin_index )
			);
		}

		$user_data = array(

			'user_email' => $user->get( 'user_email' ),

			'home_url' => home_url(),

			'wp_version' => $wp_version,

			'php_version' => phpversion(),

			'mysql_version' => $mysql_version,

			'custom_data' => $custom_data,

			'ip_details' => self::ip_details(),

			'php_os' => PHP_OS,

			'all_plugins' => $plugin_data,

			'all_themes' => $theme_data,

			'type' => $type


		);

		return $user_data;
	}

	/**
	 * @return array|mixed|null|object
	 */
	public static function ip_details() {
		$response = wp_remote_get( "http://ipinfo.io/json" );
		if ( is_array( $response ) ) {
			$header = $response['headers']; // array of http header lines
			$body   = $response['body']; // use the content

			return json_decode( $body, true );
		}

		return 'N/A';

	}

}

?>
