<?php

namespace WPFW\Inc;

class WC_Functions {

  public function __construct(){
  }

  public function filter_by_attr($q) {

    $tax_query = (array) $q->get('tax_query');

    // color attribute
    if (isset($_GET['wpfw_color']) && !empty($_GET['wpfw_color'])) {

      $tax_query[] = array(
        'taxonomy' => 'pa_color',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['wpfw_color']),
      );

    }

    // size attribute
    if (isset($_GET['wpfw_size']) && !empty($_GET['wpfw_size'])) {

      $tax_query[] = array(
        'taxonomy' => 'pa_size',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['wpfw_size']),
      );

    }

    $q->set('tax_query', $tax_query);
    
  }



}