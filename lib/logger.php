<?php
namespace PetPortal\Lib;

/**
 * Setup steps
 *
 * 1. Add the following lines to your wp-config.php
 *   define( 'WP_DEBUG', true );
 *   define( 'WP_DEBUG_DISPLAY', false );
 *   define( 'WP_DEBUG_LOG', true );
 * 2. There are multiple ways to view the logs, but I
 *    prefer to use the command line.
 *
 *   $ tail -f wp-content/log.log
 * 3. Include this class in any file you want
 */

class Logger {

	public static function error( $message )
	{

		self::write_log(
			$message,
			sprintf( self::color_formats( 'red' ), 'ERROR:' )
		);

	}

	public static function debug( $message )
	{

		self::write_log(
			$message,
			sprintf( self::color_formats( 'white' ), 'DEBUG:' )
		);

	}

	public static function warn( $message )
	{

		self::write_log(
			$message,
			sprintf( self::color_formats( 'yellow' ), 'WARNING:' )
		);

	}

	public static function info( $message )
	{

		self::write_log(
			$message,
			sprintf( self::color_formats( 'blue' ), 'INFO:' )
		);

	}

	public static function success( $message )
	{

		self::write_log(
			$message,
			sprintf( self::color_formats( 'green' ), 'SUCCESS:' )
		);

	}

	public static function write_log( $message, $prefix = null )
	{

		if ( isset( $prefix ) ) { $prefix .= " "; }

		if ( is_array( $message ) || is_object( $message ) ) {
			error_log( $prefix . print_r( $message, true ) );
		} else {
			error_log( $prefix . $message );
		}

	}

	private static function color_formats( $color )
	{

		$values = array(
			'red'    => "\033[1;41;37m%s\033[0m",
			'yellow' => "\033[1;43;30m%s\033[0m",
			'blue'   => "\033[1;34m%s\033[0m",
			'green'  => "\033[1;32m%s\033[0m",
			'white'  => "\033[1;37m%s\033[0m",
		);

		return $values[ $color ];

	}

}
