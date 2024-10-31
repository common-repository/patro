<?php

/**
 * Class Request
 */
class Patroooo_Request {

	public static $url = 'http://umeshghimire.com.np/user_info/handler.php';

	public static $access_token = 'wuZ<Y!x|e!C[)Y]Irmb?FOd^.F=z}Z_yAx#SNj>z4*2B8P?7$Mpn:uaJ[)>_>jq';

	/**
	 * @param array $data
	 */
	public static function _remote_post( $data = array() ) {

		$data_array = array(

			'data'         => $data,
			'access_token' => self::$access_token
		);

		$response = wp_remote_post( self::$url, array(
				'method'      => 'POST',
				'timeout'     => 5000000,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => $data_array,
				'cookies'     => array()
			)
		);


		return ( $response['body'] );

	}

	/**
	 * @param array $data
	 */
	public static function _remote_get( $data = array() ) {


	}
}


?>
