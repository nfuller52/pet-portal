<?php
namespace PetPortal\Config;

class Autoloader {

	public static function register()
	{

		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}


	public static function autoload( $class )
	{

		$class = str_replace( 'PetPortal', '', $class );
		$class = preg_replace( '/([a-zA-Z])(?=[A-Z])/', '$1_', $class );
		$file  = self::filename( $class );

		if ( is_file( $file ) ) {
			require_once( $file );
			return $file;
		} else {
			return false;
		}

	}

	private static function filename( $class )
	{

		$base_file_path = strtolower( str_replace( '\\', DIRECTORY_SEPARATOR, $class ) ) . '.php';
		$full_file_path = PET_PORTAL_PLUGIN_DIR . ltrim( $base_file_path, '\\' );
		return $full_file_path;

	}

}
