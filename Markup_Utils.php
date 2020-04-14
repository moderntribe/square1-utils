<?php

namespace Tribe\Libs\Utils;


class Markup_Utils {

	public static function concat_attrs( array $attrs = null, $prefix = '' ) {
		if ( empty( $attrs ) ) {
			return '';
		}
		$out = [ ];
		$prefix = empty( $prefix ) ? '' : rtrim( $prefix, '-' ) . '-';
		foreach ( $attrs as $key => $value ) {
			if ( is_array( $value ) ) {
				$out[] = self::concat_attrs( $value, $key );
			} else {
				$out[] = sprintf( '%s="%s"', $prefix . $key, esc_attr( $value ) );
			}
		}

		return implode( ' ', $out );
	}

	/**
	 * Convert an array into an HTML class attribute string
	 *
	 * @param array $classes
	 * @param bool  $attribute
	 *
	 * @return string
	 */
	public static function class_attribute( $classes, $attribute = true ) {
		if ( empty( $classes ) ) {
			return '';
		}

		$classes = array_unique( array_map( 'sanitize_html_class', $classes ) );

		return sprintf(
			'%s%s%s',
			$attribute ? ' class="' : '',
			implode( ' ', $classes ),
			$attribute ? '"' : ''
		);
	}
}
