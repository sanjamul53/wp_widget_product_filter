<?php

/**
* Plugin Name: Widget - WC product filter
* prefix: WPFW
*/



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define ( 'WPFW_ROOTPATH', plugin_dir_path( __FILE__ ) );
define ( 'WPFW_ROOTURL', plugin_dir_url( __FILE__ ) );
define ( 'WPFW_PLNAME', 'wpfw-filter-widget' );

// require
require_once(WPFW_ROOTPATH."plugin_loader.php");

// widget
require_once(WPFW_ROOTPATH."widgets/product_filter_by_attr.php");

// inc
require_once(WPFW_ROOTPATH."inc/wc_functions.php");




if( class_exists( 'WPFW\WC_Prod_Filter_Widget' ) ){
  $wc_prod_filter_widget = new WPFW\WC_Prod_Filter_Widget();
}

