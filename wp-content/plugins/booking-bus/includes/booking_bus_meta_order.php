<?php

add_action( 'init', 'booking_order_boxes_setup' );

function booking_order_boxes_setup() {
  add_action( 'add_meta_boxes', 'booking_order_add_metaboxes' );
}

function booking_order_add_metaboxes() {
  add_meta_box(
    'booking-bus-post-class',      // Unique ID
    esc_html__( 'Datos de Pasajero', 'example' ),    // Title
    'booking_order_metabox_template',   // Callback function
    array('shop_order'),         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
}

function booking_order_metabox_template( $post ) {
  global $wpdb;
  $table_reserves= $wpdb->prefix.'booking_bus_reserveds';
  $personales = $wpdb->get_results("SELECT * FROM $table_reserves WHERE order_id = $post->ID ;", OBJECT );
  require_once(dirname(__file__).'/../templates/metabox/booking_order_metabox.php');
}
