<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 **/

/**
 * Constants
 */

include 'constants.php';

/**
 * Action for enqueing scripts
 */
if ( ! function_exists('chemexclub_enqueue_style')) {
	function chemexclub_enqueue_style() {
		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/dist/lib/css/bootstrap.min.css');
		wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
	}
}
if ( ! function_exists('chemexclub_enqueue_script')) {
	function chemexclub_enqueue_script() {
		wp_enqueue_script('jquery-js', get_template_directory_uri() . '/dist/lib/js/jquery-1.11.3.min.js');
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/dist/lib/js/bootstrap.min.js');
		wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js');
	}
}

add_action('wp_enqueue_scripts', 'chemexclub_enqueue_style');
add_action('wp_enqueue_scripts', 'chemexclub_enqueue_script');

add_theme_support('post-thumbnails', array(
	'post',
	'page',
	'custom-post-type-name',
));