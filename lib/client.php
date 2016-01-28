<?php
namespace PetPortal\Lib;

class Client {

	/**
	 * Make a POST request to a specified URL
	 *
	 * @param  $url the complete url of the endpoint you're calling
	 * @param  $options the options array
	 * @return array|WP_Error returns either a JSON payload as an array, or a WordPress error
	 */
	public function post( $url, $options = array() )
	{

		return $this->request( 'POST', $url, $options );

	}

	/**
	 * Make a GET request to a specified URL
	 *
	 * @param  string $url     The URL to call out to
	 * @param  array  $options The client defined options array
	 * @return array|WP_Error  Upon success, returns an array else a WP_Error
	 */
	public function get( $url, $options = array() )
	{

		return $this->request( 'GET', $url, $options );

	}

	/**
	 * Make a DELETE request to a specified URL
	 *
	 * @param  string $url     The URL to call out to
	 * @param  array  $options The client defined options array
	 * @return array|WP_Error  Upon success, returns an array else a WP_Error
	 */
	public function delete( $url, $options = array() )
	{

		return $this->request( 'DELETE', $url, $options );

	}

	/**
	 * Make a PUT request to a specified URL
	 *
	 * @param  string $url     The URL to call out to
	 * @param  array  $options The client defined options array
	 * @return array|WP_Error  Upon success, returns an array else a WP_Error
	 */
	public function put( $url, $options = array() )
	{

		return $this->request( 'PUT', $url, $options );

	}

	/**
	 * Make a PATCH request to a specified URL
	 *
	 * @param  string $url     The URL to call out to
	 * @param  array  $options The client defined options array
	 * @return array|WP_Error  Upon success, returns an array else a WP_Error
	 */
	public function patch( $url, $options = array() )
	{

		return $this->request( 'PATCH', $url, $options );

	}

	// Private Methods
	/////////////////////////////////////////////

	/**
	 * A base method which uses the built in wp_remote_request function
	 * to call an external API.
	 * This method actually makes the outbound call and parses the response
	 * into an array.
	 *
	 * @param  string $method  The HTTP method being used
	 * @param  string $url     The URL to call out to
	 * @param  array  $options The client defined options array
	 * @return array|WP_Error  Upon success, returns an array else a WP_Error
	 */
	private function request( $method, $url, $options )
	{

		$merged_options = $this->merge_connection_options( $method, $options );
		$response = wp_remote_request( $url, $merged_options );

		if ( ! is_wp_error( $response ) && is_array( $response ) ) {
			return array(
				'message' => $response['response']['message'],
				'code'    => $response['response']['code'],
				'body'    => json_decode( $response['body'], true ),
			);
		} else {
			return $response;
		}

	}

	/**
	 * Takes the class default options array and merges it with the client
	 * defined options array. The client options will take presidence over
	 * the class defaults.
	 *
	 * @param  string $method  The HTTP method being used
	 * @param  array  $options The client defined options
	 * @return array           The merged options array
	 */
	private function merge_connection_options( $method, $options )
	{

		$default_options = $this->default_connection_options( $method );

		if ( array_key_exists( 'headers', $options ) ) {
			$headers = array_merge(
				$default_options['headers'],
				$options['headers']
			);

			$default_options['headers'] = $headers;
		}

		if ( array_key_exists( 'body', $options ) ) {
			$body = array_merge(
				$default_options['body'],
				$options['body']
			);

			$default_options['body'] = $body;
		}

		return $default_options;

	}

	/**
	 * The default values for the API request
	 *
	 * @param  string $method The HTTP method being used
	 * @return array          The default options array
	 */
	private function default_connection_options( $method )
	{

		return array(
			'httpversion' => '1.1',
			'timeout'     => 6,
			'method'      => $method,
			'body'        => array(),
			'headers'     => array(),
		);

	}

}
