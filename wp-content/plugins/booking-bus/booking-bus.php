<?php
/**
 * @package Booking Bus
 */
/*
Plugin Name: Booking Bus
Plugin URI: https://pintofrancisco.com/booking-bus
Description: Booking Bus
Version: 1.0
Author: Francisco Pinto
Author URI: https://pintofrancisco.com
*/

/*
Description
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define('TOTAL_ROW_FILAS',20);

$bus_configs = array(
	'rows' => 5,
	'plantas' => array(
		1 => 1,
		2 => 2,
	),
	'asientos' => array(),
	'filas' => array(),
	'hora' => array(
		0 => '00:00 AM',
		1 => '00:30',
		2 => '01:00',
		3 => '01:30',
		4 => '02:00',
		5 => '02:30',
		6 => '03:00',
		7 => '03:30',
		8 => '04:00',
		9 => '04:30',
		10 => '05:00',
		11 => '05:30',
		12 => '06:00',
		13 => '06:30',
		14 => '07:00',
		15 => '07:30',
		16 => '08:00',
		17 => '08:30',
		18 => '09:00',
		19 => '09:30',
		20 => '10:00',
		21 => '10:30',
		22 => '11:00',
		23 => '11:30',
		24 => '12:00',
		25 => '12:30',
		26 => '13:00',
		27 => '13:30',
		28 => '14:00',
		29 => '14:30',
		30 => '15:00',
		31 => '15:30',
		32 => '16:00',
		33 => '16:30',
		34 => '17:00',
		35 => '17:30',
		36 => '18:00',
		37 => '18:30',
		38 => '19:00',
		39 => '19:30',
		40 => '20:00',
		41 => '20:30',
		42 => '21:00',
		43 => '21:30',
		44 => '22:00',
		45 => '22:30',
		46 => '23:00',
		47 => '23:30',
		48 => '24:00',
	),
);

for ($i=1; $i<=75 ; $i++) {
	$bus_configs['asientos'][$i] = $i;
}

for ($i=1; $i<=TOTAL_ROW_FILAS ; $i++) {
	$bus_configs['filas'][$i] = $i;
}

include_once( 'includes/helper_html.php');

include_once( 'includes/booking_bus_assets.php');
include_once( 'includes/booking_bus_admin_actions.php');
include_once( 'includes/booking_bus_meta_bus.php');
include_once( 'includes/booking_bus_meta_bus_plants.php');
include_once( 'includes/booking_bus_functions.php');
include_once( 'includes/booking_bus_meta_order.php');

include_once( 'includes/booking_bus_wc.php');

$htmlHelper = new HtmlHelper('booking_bus');

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
		if ( ! session_id() ) @session_start();
		if ( ! isset($_SESSION['key_booking']) ) $_SESSION['key_booking'] = setIdent();
}

//CUSTOM PAGE TEMPLATE
function custom_single_to_product($single_template) {
  global $post;
  if ( $post->post_type == 'product' && is_single() ) {
		if ( wp_get_theme() == 'Orozco Viajes 2018' )
    	$single_template = dirname( __FILE__ ) . '/templates/orozco_woo.php';
		else
			$single_template = dirname( __FILE__ ) . '/templates/page_woocommerce.php';
  }
   return $single_template;
}
add_filter( 'single_template', 'custom_single_to_product');

function custom_template_to_product( $template ) {
		global $post;
    if ( $post->post_type == 'product' && is_single()  ) {
			if ( wp_get_theme() == 'Orozco Viajes 2018' )
      	$new_template = dirname( __FILE__ ) . '/templates/orozco_woo.php';
			else
				$new_template = dirname( __FILE__ ) . '/templates/page_woocommerce.php';
        if ( '' != $new_template ) {
            return $new_template ;
        }
    }
 return $template;
}
add_filter( 'template_include', 'custom_template_to_product', 99 );

function register_cpt_booking_bus() {

    $labels = array(
        'name' => _x( 'Modelo de Buses', 'booking_bus' ),
        'singular_name' => _x( 'Modelo de Bus', 'booking_bus' ),
        'add_new' => _x( 'Agregar Modelo Bus', 'booking_bus' ),
        'add_new_item' => _x( 'Agregar Nuevo Modelo Bus', 'booking_bus' ),
        'edit_item' => _x( 'Editar Modelo Bus', 'booking_bus' ),
        'new_item' => _x( 'Nuevo Modelo de Bus', 'booking_bus' ),
        'view_item' => _x( 'Ver Modelo de Bus', 'booking_bus' ),
        'search_items' => _x( 'Buscar Modelos de Buses', 'booking_bus' ),
        'not_found' => _x( 'No se han encontrado resultados', 'booking_bus' ),
        'not_found_in_trash' => _x( 'No se han encontrado resultados en la papelera', 'booking_bus' ),
        'parent_item_colon' => _x( 'Categoría de Modelos:', 'booking_bus' ),
        'menu_name' => _x( 'Modelo de Buses', 'booking_bus' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Modelos De Buses',
        'supports' => array( 'title', 'thumbnail', 'custom-fields' ),
        'public' => false,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-audio',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'show_in_menu' => 'booking-bus-plugin',
    );

    register_post_type( 'booking_bus', $args );
}

function register_cpt_city_bus() {

    $labels = array(
        'name' => _x( 'Ciudades', 'booking_city' ),
        'singular_name' => _x( 'Ciudad', 'booking_city' ),
        'add_new' => _x( 'Agregar Ciudad', 'booking_city' ),
        'add_new_item' => _x( 'Agregar Nueva Ciudad', 'booking_city' ),
        'edit_item' => _x( 'Editar Ciudad', 'booking_city' ),
        'new_item' => _x( 'Nueva Ciudad', 'booking_city' ),
        'view_item' => _x( 'Ver Ciudad', 'booking_city' ),
        'search_items' => _x( 'Buscar Ciudades', 'booking_city' ),
        'not_found' => _x( 'No se han encontrado resultados', 'booking_city' ),
        'not_found_in_trash' => _x( 'No se han encontrado resultados en la papelera', 'booking_city' ),
        'parent_item_colon' => _x( 'Categoría de Ciudades:', 'booking_city' ),
        'menu_name' => _x( 'Ciudades', 'booking_city' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Ciudades',
        'supports' => array( 'title'),
        'public' => false,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-audio',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'show_in_menu' => 'booking-bus-plugin',
    );

    register_post_type( 'booking_city', $args );
}

function booking_bus_options_install() {
	global $wpdb;

	$collate = '';
	if ( $wpdb->has_cap( 'collation' ) ) {
		$collate = $wpdb->get_charset_collate();
	}

  $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}booking_bus_reserveds" );

	//$sql = "DROP TABLE IF EXISTS {$wpdb->prefix}booking_bus_reserveds;";
	//$wpdb->query($sql);
	$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}booking_bus_reserveds (
		id int(11) NOT NULL,
	  name varchar(255) NOT NULL,
	  dni varchar(255) NOT NULL,
	  birthday date(255) NOT NULL,
	  phone varchar(255) NOT NULL,
	  domain varchar(255) NOT NULL,
	  postalcode varchar(255) NOT NULL,
	  locale text NOT NULL,
	  item_id int(11) NOT NULL,
	  order_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  value varchar(255) NOT NULL,
	  status varchar(30) NOT NULL,
	  date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  data varchar(255) NOT NULL
	) $collate;";
	$wpdb->query($sql);
	$sql = "ALTER TABLE {$wpdb->prefix}booking_bus_reserveds ADD PRIMARY KEY (id), ADD UNIQUE KEY id (id);";
	$wpdb->query($sql);
	$sql = "ALTER TABLE {$wpdb->prefix}booking_bus_reserveds MODIFY id int(11) NOT NULL AUTO_INCREMENT;";
	$wpdb->query($sql);

	if (! wp_next_scheduled ( 'my_booking_clean_tmp' )) {
			wp_schedule_event( time(), 'hourly', 'my_booking_clean_tmp' );
	}
}

add_action( 'my_booking_clean_tmp', 'fn_booking_clean_tmp', 10 );
function fn_booking_clean_tmp() {
	global $wpdb;
	$collate = '';
	if ( $wpdb->has_cap( 'collation' ) ) {
		$collate = $wpdb->get_charset_collate();
	}
	$sql = "DELETE FROM TABLE {$wpdb->prefix}booking_bus_reserveds WHERE DATE(or_booking_bus_reserveds.date) <= date(date(now())-1) AND or_booking_bus_reserveds.status = 'temp'";
	$wpdb->query($sql);
}

register_deactivation_hook( __FILE__, 'booking_bus_options_uninstall' );

function booking_bus_options_uninstall() {
    wp_clear_scheduled_hook( 'my_booking_clean_tmp' );
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'booking_bus_options_install');

add_action('woocommerce_add_to_cart', 'booking_add_to_cart');
function booking_add_to_cart() {
    global $woocommerce;
		global $wpdb;
		if ( ! session_id() ) @session_start();
		if ( ! isset($_SESSION['key_booking']) ) $_SESSION['key_booking'] = setIdent();
		$key_temp = $_SESSION['key_booking'];
		if($_POST) {
			$wpdb->insert(
				$wpdb->prefix.'booking_bus_reserveds', array(
	      'name'        => get_request('name'),
	      'dni'         => get_request('dni'),
	      'birthday'    => get_request('birthday'),
	      'phone'       => get_request('phone'),
	      'domain'      => get_request('domain'),
	      'postalcode'  => get_request('postalcode'),
	      'locale'      => get_request('locale'),
	      'item_id'     => 0,
	      'order_id'    => 0,
	      'product_id'  => get_request('product_id'),
	      'status'      => 'temp',
	      'value'       => get_request('value'),
				'data'				=> $key_temp,
	    ));
		}
}

add_action('woocommerce_remove_cart_item', 'booking_remove_to_cart');
function booking_remove_to_cart() {
    global $woocommerce;
		global $wpdb;
		$My_sess = new WC_Session_Handler();
		if(get_request('remove_item')){
			$sess_data = $My_sess->get('cart');
			$product_cart = $sess_data[get_request('remove_item')];
			$wpdb->delete( $wpdb->prefix.'booking_bus_reserveds', array( 'product_id' => $product_cart['product_id'], 'status' => 'temp' ) );
		}
}
add_action('woocommerce_add_order_item_meta', 'booking_checkout_to_cart',10,3);
function booking_checkout_to_cart($item_id,$meta_key,$meta_value) {
	global $woocommerce;
	global $wpdb;

	if ( ! session_id() ) @session_start();
	$key_temp = $_SESSION['key_booking'];

	$args = array(
		'numberposts' => 1,
		'post_type' => 'shop_order',
		'post_status'    => 'any',
	);
	$latest_posts = get_posts( $args , ARRAY_A );
	$wpdb->update(
		$wpdb->prefix.'booking_bus_reserveds',
		array(
			'status' =>   (($latest_posts->post_status=='wc-completed')?'buyed':'reserved'),
			'order_id' => $latest_posts[0]->ID,
			'data' => '',
		),
		array( 'data' => $key_temp )
	);
}
add_action('transition_post_status', 'booking_status_to_cart');
function booking_status_to_cart() {
	global $woocommerce;
	global $wpdb;
	if(get_request('status')=='completed'){
		$wpdb->update(
			$wpdb->prefix.'booking_bus_reserveds',
			array(
				'status' => 'buyed'
			),
			array( 'order_id' => get_request('order_id') )
		);
	}
}

add_action('delete_post', 'booking_delete',10);
function booking_delete($pid) {
	global $woocommerce;
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'booking_bus_reserveds', array( 'order_id' => $pid ) );
}

function setIdent(){
	return md5(time());
}

add_action("wp_ajax_clean_cache_book", "clean_cache_book");
add_action("wp_ajax_nopriv_clean_cache_book", "clean_cache_book");
function clean_cache_book() {
  global $wpdb;
  $row = $wpdb->get_results('SELECT * FROM or_booking_bus_reserveds bb  WHERE NOT EXISTS (SELECT * FROM or_posts WHERE ID = bb.order_id)',ARRAY_A);
	echo "<pre>";
	print_r($row);
	echo "</pre>";
	if (@$_REQUEST['band'] != '') {
		if( $wpdb->query($wpdb->prepare(
				"DELETE FROM or_booking_bus_reserveds  WHERE NOT EXISTS (SELECT * FROM or_posts WHERE ID = or_booking_bus_reserveds.order_id)"
			)
		) === false ){
			echo "error";
		}else{
			echo "success";
		}
	}
  die();
}
