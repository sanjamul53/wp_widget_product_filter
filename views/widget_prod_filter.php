<?php

$terms = get_terms( array(
  'taxonomy'   => $taxonomy,
  'hide_empty' => false,
  'number'     => $limit,
  'orderby'    => 'count',
  'order'      => 'DESC',
) );

$filter_key = 'wpfw_color';

if($taxonomy === 'pa_size') $filter_key = 'wpfw_size';

if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {

  echo '<form method="GET" action="">';
  echo "<select name='$filter_key' onchange='wpfw_prod_filter_form_handler(this)'>";

  echo '<option value="">' . __("$title", 'textdomain') . '</option>';

  foreach ($terms as $term) {
    $selected = (isset($_GET[$filter_key]) && $_GET[$filter_key] == $term->slug) ? ' selected="selected"' : '';
    echo '<option value="' . $term->slug . '"' . $selected . '>' . $term->name . '</option>';
  }

  echo '</select>';
  echo '</form>';

} 


?>