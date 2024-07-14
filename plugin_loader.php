<?php

namespace WPFW;

if( !class_exists( 'WC_Prod_Filter_Widget' ) ){

  class WC_Prod_Filter_Widget{

    public static $wc_func;

    public function __construct() {

      $this->load_classes();

      $this->wc_func = new Inc\WC_Functions();

      add_filter('template_include', array($this, 'loadTemplate'));

      add_action(
        'woocommerce_product_query', 
        array($this->wc_func, 'filter_by_attr')
      );
        
    }

    // ================== load classes ==================
    public function load_classes() {
      $MVTestimonialsWidget = new Widget\Prod_Filter_BY_ATTR();
    }

    // ================== handle templates ==================
    public function loadTemplate($template){

      if (is_page('widget_test')) {
        return  WPFW_ROOTPATH . 'views/test.php';
      }

      return $template;
    }


  }

}

