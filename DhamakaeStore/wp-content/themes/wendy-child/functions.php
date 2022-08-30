<?php
/**
 * Road Themes functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
 
 function road_child_scripts_styles() {
	// Load main theme css style
	wp_enqueue_style( 'wendy-child', get_stylesheet_directory_uri() . '/css/child.css', array('roadthemes-css'), '1.0.0' );
	// Add child.js file
	wp_enqueue_script( 'wendychild-js', get_stylesheet_directory_uri() . '/js/wendychild.js', array('jquery'), '1.0.0', true );
add_action( 'wp_enqueue_scripts', 'road_child_scripts_styles' );
 }
// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
