<?php

add_action( 'init', 'bbwc_boxes_setup' );

function bbwc_boxes_setup() {
  add_action( 'add_meta_boxes', 'bbwc_add_metaboxes' );
  add_action( 'save_post', 'bbwc_save_meta' );
}

function bbwc_add_metaboxes() {
  add_meta_box(
    'booking-bus-post-class',      // Unique ID
    esc_html__( 'Datos del Bus', 'example' ),    // Title
    'bbwc_metabox_template',   // Callback function
    array('product'),         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
}

function bbwc_metabox_template( $post ) {
  $cities = get_posts(array('post_type'=>'booking_city', 'orderby'=>'post_title', 'order'=>'ASC', 'numberposts' => -1));
  $buses = get_posts(array('post_type'=>'booking_bus', 'orderby'=>'post_title', 'order'=>'ASC', 'numberposts' => -1));

  require_once(dirname(__file__).'/../templates/metabox/bbwoo.php');
}

function bbwc_save_meta() {
  $post = get_post();
  $post_id = $post->ID;
  $new_values = ( isset( $_POST['bbwc'] ) ? $_POST['bbwc'] : array() );
  $meta_class = 'bbwc';
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
