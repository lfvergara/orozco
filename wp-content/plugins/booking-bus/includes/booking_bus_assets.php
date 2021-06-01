<?php

/*ADDS STYLESHEET ON WP-ADMIN*/
add_action( 'admin_enqueue_scripts', 'booking_bus_enqueue_styles' );
function booking_bus_enqueue_styles() {
  wp_enqueue_style( 'booking_bus_css_fix', plugins_url('../assets/style.css', __FILE__) );
  wp_enqueue_style( 'booking_bus_wc_css_fix', plugins_url('../assets/admin.css', __FILE__) );
  wp_enqueue_style( 'booking_bus_fontawesome', plugins_url('../assets/font-awesome/css/font-awesome.min.css', __FILE__) );
  wp_enqueue_script('jquery-autocomplete',plugins_url('../assets/js/jquery.autocomplete.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'front_enqueue_scripts');
function front_enqueue_scripts() {
  wp_enqueue_style( 'booking_bus_css_fix', plugins_url('../assets/assets.css', __FILE__) );
  wp_enqueue_style( 'booking_bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
  wp_enqueue_script('jquery','https://code.jquery.com/jquery-3.2.1.min.js');
  wp_enqueue_script('jquery-autocomplete',plugins_url('../assets/js/jquery.autocomplete.js', __FILE__));

}
