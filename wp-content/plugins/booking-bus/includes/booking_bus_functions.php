<?php

function get_request($item = null) {
  if($item==null||$item=='')
    return '';
  if($_REQUEST&&isset($_REQUEST[$item]))
    return $_REQUEST[$item];
}

function convert_status($status){
	switch ($status) {
	  case 'buyed':
	    return "<mark class='buyed'>Vendido</mark>";
	    break;
	  case 'reserved':
	    return "<mark class='reserved'>Reservado</mark>";
	    break;
	  case 'temp':
	    return "<mark class='temp'>Temporal</mark>";
	    break;
	}
}
function convert_status_simple($status){
	switch ($status) {
	  case 'buyed':
	    return "Vendido";
	    break;
	  case 'reserved':
	    return "Reservado";
	    break;
	  case 'temp':
	    return "Temporal";
	    break;
	}
}

add_action( 'booking_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'booking_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'booking_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'booking_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'booking_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'booking_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'booking_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'booking_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'booking_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter( 'woocommerce_product_tabs', 'woo_booking_tab' );
function woo_booking_tab( $tabs ) {
	$tabs['test_tab'] = array(
		'title' 	=> __( 'Reservas', 'woocommerce' ),
		'priority' 	=> 20,
		'callback' 	=> 'woo_booking'
	);
	return $tabs;
}
function woo_booking() {
  $meta = get_post_meta( get_the_id());
  global $bus_configs;
  include_once(dirname(__file__).'../../templates/booking-bus.php');
}
