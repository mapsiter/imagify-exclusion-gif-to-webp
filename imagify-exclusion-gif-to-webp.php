<?php
/**
 * Plugin Name: Imagify (Exclude GIF from WEBP)
 * Description: Exclude GIF images from WEBP conversion.
 * Plugin URI: https://www.imagify.io
 * Author: Imagify
 * Version: 1.0.0
 */

add_filter('imagify_before_optimize_size', 'no_webp_for_gif', 10, 7);

function no_webp_for_gif( $response, $process, $file, $thumb_size, $optimization_level, $webp, $is_disabled ) {
	if ( ! $webp || $is_disabled || is_wp_error( $response ) ) {
		return $response;
	}

	if ( 'image/gif' !== $file->get_mime_type() ) {
		return $response;
	}

	return new \WP_Error( 'no_webp_for_gif', __( 'Webp version of gif is disabled by filter.' ) );
}
?>
