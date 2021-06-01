<?php

add_action( 'init', 'booking_bus_plants_boxes_setup' );

function booking_bus_plants_boxes_setup() {
  add_action( 'add_meta_boxes', 'booking_bus_plants_add_metaboxes' );
  add_action( 'save_post', 'booking_bus_plants_save_meta' );
}

function booking_bus_plants_add_metaboxes() {
  add_meta_box(
    'booking-bus-plants-post-class',      // Unique ID
    esc_html__( 'Plano de Plantas', 'example' ),    // Title
    'booking_bus_plants_metabox_template',   // Callback function
    array('booking_bus'),         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
}

function booking_bus_plants_metabox_template( $post ) {
  require_once(dirname(__file__).'/../templates/metabox/booking_plants_metabox.php');
}

function booking_bus_plants_save_meta() {
  $post = get_post();
  $post_id = $post->ID;
  $new_values = ( isset( $_POST['booking_plants'] ) ? $_POST['booking_plants'] : array() );
  $meta_class = 'booking_plants';

  foreach ($new_values as $post_meta_key => $new_meta_value) {
    $meta_key = $meta_class.'_'.$post_meta_key;
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    if ( $new_meta_value && '' == $meta_value ){
      add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    }
    elseif ( $new_meta_value && $new_meta_value != $meta_value ){
      update_post_meta( $post_id, $meta_key, $new_meta_value );
    }
    elseif ( '' == $new_meta_value && $meta_value ){
      delete_post_meta( $post_id, $meta_key, $meta_value );
    }
  }
}
