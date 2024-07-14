<?php

namespace WPFW\Widget;
// use WP_Widget;


class Prod_Filter_BY_ATTR extends \WP_Widget {

  private $attr_list;

  public function __construct(){

    $this->attr_list = [
      'color' => 'pa_color',
      'size' => 'pa_size'
    ];

    $widget_options = array(
      'description'   => __( 'WC Prod Filter - 01', WPFW_PLNAME )
    );

    parent::__construct(
      WPFW_PLNAME, // Base ID
      'WC Prod Filter - me', // Widget name
      $widget_options
    );

    add_action(
      'widgets_init', function(){
          register_widget(
              'WPFW\Widget\Prod_Filter_BY_ATTR'
          );
      }
    );

    if( is_active_widget( false, false, $this->id_base ) ){
      add_action( 'wp_enqueue_scripts', array( $this, 'script_handler' ) );
    }

  }


  public function script_handler() {

    wp_enqueue_script(
      'wpfw-prod-filter-widget-script',
      WPFW_ROOTURL . 'assets/js/widget_prod_filter.js',
      array(),
    );
  }


  // =============================================================================================
  // Function to handle the back-end widget form
  public function form( $instance ){

    $attr_color = $this->attr_list['color'];
    $attr_size = $this->attr_list['size'];

    $title = isset( $instance['title'] ) ? $instance['title'] : '';
    $max_item = isset( $instance['max_item'] ) ? (int) $instance['max_item'] : 0;
    $type = isset( $instance['type'] ) ? $instance['type'] : $attr_color;

    ?>

      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">
          <?php esc_html_e( 'Title', WPFW_PLNAME ); ?>:
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
          name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"
        >
      </p>


      <p>
        <label for="<?php echo $this->get_field_id( 'max_item' ); ?>">
          <?php esc_html_e( 'Max item to show', WPFW_PLNAME ); ?>:
        </label>
        <input type="number" class="tiny-text" 
          id="<?php echo $this->get_field_id( 'max_item' ); ?>" 
          name="<?php echo $this->get_field_name( 'max_item' ); ?>" 
          step="1" min="0"
          value="<?php echo $max_item; ?>"
          placeholder="insert 0 for all item"
        >
      </p>

      <div style="margin: 20px 0;">

        <p style="font-size: 12px;" > Filter by? </p>

        <input type="radio" class="radio" 
          id="<?php echo $this->get_field_id( 'type_color' ); ?>" 
          name="<?php echo $this->get_field_name( 'type' ); ?>" 
          value="<?= $attr_color; ?>" <?php checked( $type, $attr_color ); ?>
        >
        <label for="<?php echo $this->get_field_id( 'type_color' ); ?>">
          <?php esc_html_e( $attr_color, WPFW_PLNAME ); ?>
        </label>

        <input type="radio" class="radio" 
          id="<?php echo $this->get_field_id( 'type_size' ); ?>" 
          name="<?php echo $this->get_field_name( 'type' ); ?>" 
          value="<?= $attr_size; ?>" <?php checked( $type, $attr_size ); ?>
        >
        <label for="<?php echo $this->get_field_id( 'type_size' ); ?>">
          <?php esc_html_e( $attr_size, WPFW_PLNAME ); ?>
        </label>

      </div>

    <?php
  }

  // =============================================================================================
  // Function to save the widget settings
  public function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['max_item'] = (int) $new_instance['max_item'];

    if($instance['max_item'] < 0) $instance['max_item'] = 0;

    $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? 
    sanitize_text_field( $new_instance['type'] ) : $this->attr_list['color'];

    // if(!in_array(
    //     [$this->attr_list['color'], $this->attr_list['size']], 
    //     $instance['type']
    //   )
    // ) {
    //   $instance['type'] = $this->attr_list['color'];
    // }


    return $instance;
  }


  // =============================================================================================
  // Function to display the widget on the front-end
  public function widget( $args, $instance ) {

    $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Select Attribute';
    $taxonomy = ! empty( $instance['type'] ) ? $instance['type'] : $this->attr_list['color'];
    $limit = ! empty( $instance['max_item'] ) ? intval($instance['max_item']) : 0;

    echo $args['before_widget'];
    echo $args['before_title'] . $title . $args['after_title'];

    require( WPFW_ROOTPATH . 'views/widget_prod_filter.php' );
    
    echo $args['after_widget'];

  }





}