<?php

class _OWPST_jdvu__Front {

	private function __construct( $params ) {
		//global _OWPST_jdvu__Conf::$added_PHP_Front_Files;

		if ( is_array( _OWPST_jdvu__Conf::$added_PHP_Front_Files ) ) {
			foreach ( _OWPST_jdvu__Conf::$added_PHP_Front_Files as $filePath ) {
				include_once( $filePath );
			}
		}

		$PHP_ToLoad = scandir( __OWPST_jdvu__THIS_PLUGIN__FRONT_DIR_ . 'controller/' );
		$PHP_ToLoad = preg_grep( '/-ToLoad\.php$/i' , $PHP_ToLoad );
		sort ( $PHP_ToLoad , SORT_STRING );

		foreach ( $PHP_ToLoad as $key => $fileName ) {
			include( __OWPST_jdvu__THIS_PLUGIN__FRONT_DIR_ . 'controller/' . $fileName );
		}
/*
		$directory = new RecursiveDirectoryIterator( __OWPST_jdvu__THIS_PLUGIN__FRONT_DIR_ . 'controller/' );
		$recIterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($recIterator, '/-ToLoad\.php$/i');

		foreach($regex as $item) {
			include $item->getPathname();
		}
*/	
		add_action( 'wp_enqueue_scripts', array( $this , 'addAddedScriptsAndStyles' ) );
	}

	public static function init( $params ) {
		return new _OWPST_jdvu__Front( $params );
	}

	public function addAddedScriptsAndStyles( $hook ) {
		//global _OWPST_jdvu__Conf::$added_SCRIPT_Front_Files , _OWPST_jdvu__Conf::$added_STYLE_Front_Files;

		if ( is_array( _OWPST_jdvu__Conf::$added_SCRIPT_Front_Files ) ) {
			foreach ( _OWPST_jdvu__Conf::$added_SCRIPT_Front_Files as $script ) {
				if ( isset( $script[ 'hook_deps' ] ) ) {
					if ( is_string( $script[ 'hook_deps' ] ) ) {
						if ( strpos( $hook , trim( $script[ 'hook_deps' ] ) ) ) {
							_OWPST_jdvu__Main::addScript( $script );
						}
					} else if ( is_array( $script[ 'hook_deps' ] ) ) {
						foreach ( $script[ 'hook_deps' ] as $value ) {
							if ( strpos( $hook , trim( $value ) ) !== false ) {
								_OWPST_jdvu__Main::addScript( $script );
								break;
							}
						}
					}
				} else {
					_OWPST_jdvu__Main::addScript( $script );
				}
			}
		};

		if ( is_array( _OWPST_jdvu__Conf::$added_STYLE_Front_Files ) ) {
			foreach ( _OWPST_jdvu__Conf::$added_STYLE_Front_Files as $style ) {
				if ( isset( $style[ 'hook_deps' ] ) ) {
					if ( is_string( $style[ 'hook_deps' ] ) ) {
						if ( strpos( $hook , trim( $style[ 'hook_deps' ] ) ) ) {
							_OWPST_jdvu__Main::addStyle( $style );
						}
					} else if ( is_array( $style[ 'hook_deps' ] ) ) {
						foreach ( $style[ 'hook_deps' ] as $value ) {
							if ( strpos( $hook , trim( $value ) ) !== false ) {
								_OWPST_jdvu__Main::addStyle( $style );
								break;
							}
						}
					}
				} else {
					_OWPST_jdvu__Main::addStyle( $style );
				}
			}
		};
	}

}