<?php

namespace RE;
class Functions{
	use Singleton;

	function require_all( $dir ) {
		if ( ! is_dir( $dir ) ) return false;

		$opened_dir = opendir( $dir );
		$files      = [];

		while ( false !== ( $element = readdir( $opened_dir ) ) ) :
			if ( ! is_file( $dir . $element ) ) {
				continue;
			}
			$info = pathinfo( $element, PATHINFO_EXTENSION );

			if ( in_array( $info, ['php'] ) ) {
				$files[] = $element;
			}
		endwhile;
		closedir( $opened_dir );

		foreach ( $files as $file ) {
			require_once( $dir . $file );
		}

		return $files;
	}
}
