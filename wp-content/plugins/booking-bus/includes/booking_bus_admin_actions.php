<?php

add_action('admin_menu', 'booking_bus_setup_menu', 58);
add_action( 'init', 'register_cpt_booking_bus' );
add_action( 'init', 'register_cpt_city_bus' );


function mysql_a_espanol($fecha,$extended=false){
    //@ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);

    $mifecha = explode('-', $fecha);
    $anio = $mifecha[0];
    $mes = $mifecha[1];
    $dia = $mifecha[2];

    if($extended) {
        $lafecha=$dia." de ".$this->meses[$mes]." de ".$anio;
    } else {
        $lafecha=$dia."-".$mes."-".$anio;
    }
    return $lafecha;
}

function mysql_espanol($fecha){
    $str = strtotime($fecha);
    $str = date('d-m-Y',$str);
    return $str;
}

function booking_bus_setup_menu(){
        add_menu_page( 'Booking Bus Plugin', 'Booking Bus', 'manage_options', 'booking-bus-plugin', 'booking_bus_init','dashicons-calendar-alt',57 );
				$option_page = add_submenu_page(
					'booking-bus-plugin',
					('Reservas'),
					('Reservas'),
					apply_filters( 'booking_bus_reservas_capability', 'manage_options' ),
					'booking_bus_reservas',
					'booking_reservas_init'
				);
        $option_page = add_submenu_page(
					'booking-bus-plugin',
					('Reporte'),
					('Reporte'),
					apply_filters( 'booking_bus_reservas_capability', 'manage_options' ),
					'booking_bus_report',
					'booking_report_init'
				);
        $option_page = add_submenu_page(
					'booking-bus-plugin',
					('Administrar Habitaciones'),
					('Administrar Habitaciones'),
					apply_filters( 'booking_bus_reservas_capability', 'manage_options' ),
					'booking_bus_reserve',
					'booking_reserve_init'
				);
        $option_page = add_submenu_page(
					'booking-bus-plugin',
					('Listado de Clientes'),
					('Listado de Clientes'),
					apply_filters( 'booking_bus_reservas_capability', 'manage_options' ),
					'booking_bus_customer',
					'booking_customer_init'
				);
    $option_page = add_submenu_page(
                    'booking-bus-plugin',
                    ('Historial de cambios'),
                    ('Historial de cambios'),
                    apply_filters( 'booking_bus_reservas_capability', 'manage_options' ),
                    'booking_bus_changes_history',
                    'booking_bus_changes_history_init'
    );
}
function booking_bus_init(){
  echo "<h1>Booking Bus</h1>";
}

function booking_customer_init(){
  global $wpdb;
  $products = get_posts(array('post_type'=>'product','post_status' => 'any','numberposts'=>-1));
  $simple_bed = array();

    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
  $rows = $wpdb->get_results('SELECT * FROM '. $table_reserves . ' WHERE 1 GROUP BY dni ',ARRAY_A);

  // if($product_id = get_request('product_id')){
  //   $simple_bed = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and ($table_reserves.bed = '' or $table_reserves.bed IS NULL);", OBJECT );
  //   $reserves_beds = array();
  //   foreach($wpdb->get_results("SELECT $table_reserves.bed as B FROM $table_reserves WHERE $table_reserves.product_id = $product_id GROUP BY B;", OBJECT ) as $b){
  //     if( $b->B != '' ){
  //       $reserves_beds[$b->B] = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.bed = '$b->B';", OBJECT );
  //     }
  //   }
  //   $seats_reserve = $wpdb->get_results("SELECT value FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
  //   $temp_a = array();
  //   foreach ($seats_reserve as $tmp) {
  //     $temp_a[] = $tmp->value;
  //   }
  //   $meta_total = get_post_meta($product_id);
  //   $seats_reserve = $temp_a;
  // }

  include_once(dirname(__file__).'../../templates/customer_admin.php');
}

function booking_bus_changes_history_init() {
    global $wpdb;
    $logs = array();
    if (get_request('showAll') == 'true') {
        $logs = $wpdb->get_results("SELECT * from {$wpdb->prefix}booking_bus_logs ORDER BY id Desc");
    }
    else if (get_request('adminId') != null) {
        $logs = $wpdb->get_results("SELECT * from {$wpdb->prefix}booking_bus_logs WHERE admin_id = ".get_request('adminId')." ORDER BY id Desc");
    }
    else {
        $logs = $wpdb->get_results("SELECT * from {$wpdb->prefix}booking_bus_logs ORDER BY id Desc LIMIT 500");
    }

    include_once(dirname(__file__).'../../templates/historial_cambios.php');
}

function booking_reserve_init(){
  global $wpdb;
  $products = get_posts(array('post_type'=>'product','post_status' => 'any','numberposts'=>-1));
  $simple_bed = array();
  if($product_id = get_request('product_id')){
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $simple_bed = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and ($table_reserves.bed = '' or $table_reserves.bed IS NULL);", OBJECT );
    $reserves_beds = array();
    foreach($wpdb->get_results("SELECT $table_reserves.bed as B FROM $table_reserves WHERE $table_reserves.product_id = $product_id GROUP BY B;", OBJECT ) as $b){
      if( $b->B != '' ){
        $reserves_beds[$b->B] = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.bed = '$b->B';", OBJECT );
      }
    }
    $seats_reserve = $wpdb->get_results("SELECT value FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
    $temp_a = array();
    foreach ($seats_reserve as $tmp) {
      $temp_a[] = $tmp->value;
    }
    $meta_total = get_post_meta($product_id);
    $seats_reserve = $temp_a;
  }

  include_once(dirname(__file__).'../../templates/bed_admin.php');
}


function booking_reservas_init(){
  $products = get_posts(array('post_type'=>'product','numberposts'=>-1));
  include_once(dirname(__file__).'../../templates/reservas.php');
}
function booking_report_init(){
  global $wpdb;
  $products = get_posts(array('post_type'=>'product','post_status' => 'any','numberposts'=>-1));
  $reservs = array();
  if($product_id = get_request('product_id')){
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $reservs = $wpdb->get_results("SELECT id,name,dni,phone,domain,postalcode,locale,item_id,order_id,product_id,value,status,date,data,bed,birthday,(SELECT SUM(or_booking_payment.amount) FROM or_booking_payment WHERE or_booking_payment.booking_id =  ".$table_reserves.".id ) AS total_payment FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
    $seats_reserve = $wpdb->get_results("SELECT value FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
    $temp_a = array();
    foreach ($seats_reserve as $tmp) {
      $temp_a[] = $tmp->value;
    }
    $seats_reserve = $temp_a;
    $total_asientos = get_post_meta(get_post_meta($product_id,'booking_bus_bus',true),'booking_bus_capacidad',true)-count($reservs);
    $meta_total = get_post_meta($product_id);
  }

  include_once(dirname(__file__).'../../templates/report.php');
}

add_action("wp_ajax_get_bus", "get_bus");
add_action("wp_ajax_nopriv_get_bus", "get_bus");
add_action("wp_ajax_set_reserve", "set_reserve");
add_action("wp_ajax_nopriv_set_reserve", "set_reserve");
add_action("wp_ajax_set_reserve_customer", "set_reserve_customer");
add_action("wp_ajax_nopriv_set_reserve_customer", "set_reserve_customer");
add_action("wp_ajax_get_report", "get_report");
add_action("wp_ajax_nopriv_get_report", "get_report");

function add_custom_jquery_ui() {
   wp_enqueue_script( 'jquery-ui-draggable' );
   wp_enqueue_script( 'jquery-ui-droppable' );
   wp_enqueue_script( 'jquery-ui-sortable' );
}
add_action( 'admin_enqueue_scripts', 'add_custom_jquery_ui' );

function get_report() {
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('Europe/London');
  if (PHP_SAPI == 'cli')
  	die('This example should only be run from a Web Browser');
  require_once dirname(__FILE__) . '/PHPExcel.php';

  $objPHPExcel = new PHPExcel();

  if($product_id = get_request('product_id')){
    global $wpdb;
    global $bus_configs;
    $products = get_posts(array('post_type'=>'product','numberposts'=>-1));
    $reservs = array();
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $reservs = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
    $seats_reserve = $wpdb->get_results("SELECT value FROM $table_reserves WHERE $table_reserves.product_id = $product_id ;", OBJECT );
    $temp_a = array();
    foreach ($seats_reserve as $tmp) {
      $temp_a[] = $tmp->value;
    }
    $seats_reserve = $temp_a;
    $total_asientos = get_post_meta(get_post_meta($product_id,'booking_bus_bus',true),'booking_bus_capacidad',true)-count($reservs);
    $meta_total = get_post_meta($product_id);
    $bus = (get_post_meta($meta_total['booking_bus_bus'][0]));

    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    							 ->setLastModifiedBy("Maarten Balliauw")
    							 ->setTitle("Office 2007 XLSX Test Document")
    							 ->setSubject("Office 2007 XLSX Test Document")
    							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    							 ->setKeywords("office 2007 openxml php")
    							 ->setCategory("Test result file");

    $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A1', 'NOMBRE Y APELLIDO')
      ->setCellValue('B1', 'DNI')
      ->setCellValue('C1', 'FECHA DE NACIMIENTO')
      ->setCellValue('D1', 'TELÉFONO')
      ->setCellValue('E1', 'DOMICILIO')
      ->setCellValue('F1', 'CÓDIGO POSTAL')
      ->setCellValue('G1', 'LOCALIDAD')
      ->setCellValue('H1', 'ASIENTO')
      ->setCellValue('I1', 'STATUS');



    $stylelines = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => '00000000'),
        ),
      ),
    );

    $count = 1;
    foreach ($reservs as $single){
      $count++;
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$count, $single->name )
        ->setCellValue('B'.$count, $single->dni )
        ->setCellValue('C'.$count, $single->birthday )
        ->setCellValue('D'.$count, $single->phone  )
        ->setCellValue('E'.$count, $single->domain  )
        ->setCellValue('F'.$count, $single->postalcode )
        ->setCellValue('G'.$count, $single->locale )
        ->setCellValue('H'.$count, @$bus["booking_plants_".$single->value][0] )
        ->setCellValue('I'.$count, convert_status_simple($single->status) );
    }
    $objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'CONTROL DE EQUIPAJE');
    $objPHPExcel->getActiveSheet(0)->mergeCells('I1:R1');
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(40);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setWidth(3);
    $objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setWidth(3);


    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A2:R'.$count)->applyFromArray($stylelines);


    $objPHPExcel->getActiveSheet(0)->freezePane('A2');
    $objPHPExcel->getActiveSheet(0)->setTitle('Reservas');

    $objPHPExcel->createSheet(1)->setTitle('Disponibles');

    $objPHPExcel->setActiveSheetIndex(1);

    $objPHPExcel->setActiveSheetIndex(1)
    ->setCellValue('A1', 'Asiento')
    ->setCellValue('B1', 'Status');

    $plants = ($bus['booking_bus_plantas'][0]==1)?array('a'):array('a','b');
    $filas = $bus['booking_bus_filas'][0];
    $cont_avaliable = 1;
    foreach ($plants as $plv){
      for ($cols = 1; $cols <= $filas ; $cols++){
        for ($rows = 1; $rows <= $bus_configs['rows'] ; $rows++){
          if (@$bus["booking_plants_".$plv."_".$rows."_".$cols][0]&&@$bus["booking_plants_".$plv."_".$rows."_".$cols][0] != ''&&!in_array($plv."_".$rows."_".$cols,$seats_reserve) == true){
            $cont_avaliable++;
            $objPHPExcel->setActiveSheetIndex(1)
              ->setCellValue('A'.$cont_avaliable, @$bus["booking_plants_".$plv."_".$rows."_".$cols][0] )
              ->setCellValue('B'.$cont_avaliable, 'Disponible' );
          }
        }
      }
    }
    $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(15);
    $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:B'.$cont_avaliable)->applyFromArray($stylelines);


    $objPHPExcel->getActiveSheet(1)->freezePane('A2');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0 );
  }
  // Redirect output to a client’s web browser (Excel2007)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="reporte_'.$product_id.'.xlsx"');
  header('Cache-Control: max-age=0');
  // If you're serving to IE 9, then the following may be needed
  header('Cache-Control: max-age=1');

  // If you're serving to IE over SSL, then the following may be needed
  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
  header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header ('Pragma: public'); // HTTP/1.0

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');



  die();
}

add_action("wp_ajax_get_reserve", "get_reserve");
add_action("wp_ajax_nopriv_get_reserve", "get_reserve");
function get_reserve() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['id']) {
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $table_users = $wpdb->prefix.'users';



    $row = $wpdb->get_row('SELECT * ,
                            (SELECT SUM(or_booking_payment.amount) FROM or_booking_payment WHERE or_booking_payment.booking_id =  '.$table_reserves.'.id ) 
                            AS total_payment 
                            FROM '. $table_reserves . ' 
                            WHERE '.$table_reserves.'.id = ' . $_REQUEST['id'],ARRAY_A);
    $row['payments'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'booking_payment WHERE booking_id = ' . $_REQUEST['id'],ARRAY_A);
    $row['total_payment'] = floatval($row['total_payment']);

      $order = wc_get_order($row['order_id']);
      $row['totalViaje'] = floatval($order->get_total());

    $row['logs'] = $wpdb->get_results("SELECT or_booking_bus_logs.*, or_users.display_name
                                    FROM or_booking_bus_logs
                                    INNER JOIN or_users ON or_users.ID = or_booking_bus_logs.admin_id
                                    WHERE or_booking_bus_logs.reservation_id = {$_REQUEST['id']}", ARRAY_A);

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($row);
    die();
  }
}

add_action("wp_ajax_get_list_ajax", "get_list_ajax");
add_action("wp_ajax_nopriv_get_list_ajax", "get_list_ajax");
function get_list_ajax() {
  header("Content-Type: application/json; charset=UTF-8");
  $data = array(
    'query' => 'Unit',
    'suggestions' => get_records((@$_REQUEST['query_arg']!= ''?$_REQUEST['query_arg']:'name'),@$_REQUEST['query']),
  );
  echo json_encode($data);
  die();
}

function get_records($value = 'name', $query = '')
{
  global $wpdb;
  $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
  $data = array();
  if(!empty($query)){
    $rows = $wpdb->get_results('SELECT * FROM '. $table_reserves . ' WHERE '.$value.' != "" AND '.$value.' LIKE "%'.$query.'%" GROUP BY '.$value.' ',ARRAY_A);
    foreach ($rows as $row) {
      $data[] = array(
        'value' => $value == 'dni'?($row[$value]." ".$row['name']):$row[$value],
        'data' => $row['id'],
        'name' => $row['name'],
        'dni' => $row['dni'],
        'domain' => $row['domain'],
        'phone' => $row['phone'],
        'postalcode' => $row['postalcode'],
        'locale' => $row['locale'],
        'birthday' => $row['birthday'],
      );
    }
  }
  return $data;
}

add_action("wp_ajax_update_record_bed", "update_record_bed");
add_action("wp_ajax_nopriv_update_record_bed", "update_record_bed");
function update_record_bed() {
  global $wpdb;
  $ident = @$_REQUEST['id'];
  $value = @$_REQUEST['value'];

  foreach (explode(';',$ident) as $id) {
    if( $id != '' ) {
      $wpdb->update(
        $wpdb->prefix.'booking_bus_reserveds',
        array(
          'bed'      => $value,
        )
        ,array( 'id' => $id )
      );
    }
  }
  die();
}

add_action("wp_ajax_booking_bus_vouches", "booking_bus_vouches");
add_action("wp_ajax_nopriv_booking_bus_vouches", "booking_bus_vouches");
function booking_bus_vouches() {
  global $wpdb;
  require_once dirname(__FILE__) . '/Html2pdf.php';
  $product_id = @$_REQUEST['product_id'];
  $vouche_id = @$_REQUEST['vouche_id'];
  if($product_id != ''){
    $product = get_post( $product_id );
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';

    $reserves_beds = array();
    if($vouche_id != ''){
      $row = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.id = $vouche_id;", OBJECT );
      if( $row[0]->bed != '' ){
        $reserves_beds[$row[0]->bed] = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.bed = '".$row[0]->bed."';", OBJECT );
      }else{
        $reserves_beds[$row->id] = $row;
      }
    } else {
      $groups = $wpdb->get_results("SELECT $table_reserves.bed as B FROM $table_reserves WHERE $table_reserves.product_id = $product_id GROUP BY B;", OBJECT );
      foreach ($groups as $group_id) {
        if( $group_id->B == '' ){
          foreach ($wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.bed = '$group_id->B';", OBJECT ) as $row) {
            $reserves_beds[$row->id] = array($row);
          }
        }else{
          $reserves_beds[$group_id->B] = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.bed = '$group_id->B';", OBJECT );
        }
      }
    }
    ob_start();
    include_once(dirname(__file__).'../../templates/vouche.php');
    $content = ob_get_clean();

    try
    {
      $html2pdf = new HTML2PDF('P', 'letter', 'fr');
      //$html2pdf->setDefaultFont('Arial');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output('vouches.pdf');
    }
    catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
    }


  }

  die();
}

add_action("wp_ajax_booking_bus_recibo", "booking_bus_recibo");
add_action("wp_ajax_nopriv_booking_bus_recibo", "booking_bus_recibo");
function booking_bus_recibo() {
    global $wpdb;
    require_once dirname(__FILE__) . '/Html2pdf.php';
    $payment_id = @$_REQUEST['payment_id'];

    if($payment_id != ''){
        //$product = get_post( $product_id );
        $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
        $table_payments = $wpdb->prefix.'booking_payment';

        $payment = $wpdb->get_row("SELECT * from {$table_payments} WHERE id = {$payment_id}");

        if ($payment == null) {
            http_response_code(404);
            die();
        }
        $reserva = $wpdb->get_row("SELECT * from {$table_reserves} WHERE id = {$payment->booking_id}");
        $product = get_post($reserva->product_id);

        $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
            'admin_id'        => get_current_user_id(),
            'reservation_id'         => $reserva->id,
            'text'    => "Generó el recibo del pago #".$payment_id,

        ));

        $content = file_get_contents(dirname(__file__).'../../templates/recibo.html');

        $content = str_replace("{{PAYMENT}}", $payment->amount, $content);
        $content = str_replace("{{NOMBRE}}", $reserva->name, $content);
        $content = str_replace("{{DETALLE}}", $product->post_title, $content);
        $content = str_replace("{{ID}}", $payment_id, $content);

        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(5, 0, 5, 0));
            //$html2pdf->setDefaultFont('Arial');
            $html2pdf->pdf->SetDisplayMode('real');

            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output("Recibo de pago Num {$payment_id}.pdf");
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }


    }

    die();
}

function set_reserve() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['id']) {
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $data = array(
      'name'        => get_request('name'),
      'dni'         => get_request('dni'),
      'birthday'    => get_request('birthday'),
      'phone'       => get_request('phone'),
      'domain'      => get_request('domain'),
      'postalcode'  => get_request('postalcode'),
      'locale'      => get_request('locale'),
    );
    if($wpdb->update($table_reserves,$data,array( 'id' => get_request('id') ))!== false){

        $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
            'admin_id'        => get_current_user_id(),
            'reservation_id'         => get_request('id'),
            'change_type'    => "UPDATE",

        ));

      $data = array(
        'name'        => get_request('name'),
        'birthday'    => get_request('birthday'),
        'phone'       => get_request('phone'),
        'domain'      => get_request('domain'),
        'postalcode'  => get_request('postalcode'),
        'locale'      => get_request('locale'),
      );
      $wpdb->update($table_reserves,$data,array( 'dni' => get_request('dni') ));
    }
  }
}

add_action("wp_ajax_set_payment", "set_payment");
add_action("wp_ajax_nopriv_set_payment", "set_payment");
function set_payment() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['id']) {
    $table_reserves = $wpdb->prefix.'booking_payment';
    $table_logs = $wpdb->prefix.'booking_bus_logs';
    $data = array(
      'amount'        => get_request('amount'),
      'booking_id'       => get_request('id'),
    );
    $wpdb->insert($table_reserves,$data);
      $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
          'admin_id'        => get_current_user_id(),
          'reservation_id'         => get_request('id'),
          'text'    => "Realizó pago #{$wpdb->insert_id} de $".number_format(get_request('amount'), 2),
      ));
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $row = $wpdb->get_row('SELECT * , (SELECT SUM(or_booking_payment.amount) FROM or_booking_payment WHERE or_booking_payment.booking_id =  '.$table_reserves.'.id ) AS total_payment FROM '. $table_reserves . ' WHERE id = ' . $_REQUEST['id'],ARRAY_A);
    $row['payments'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'booking_payment WHERE booking_id = ' . $_REQUEST['id'],ARRAY_A);
    $row['total_payment'] = floatval($row['total_payment']);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($row);
    die();
  }
}
add_action("wp_ajax_delete_payment", "delete_payment");
add_action("wp_ajax_nopriv_delete_payment", "delete_payment");
function delete_payment() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['payment_id']) {
    $table_reserves = $wpdb->prefix.'booking_payment';
    $row = $wpdb->get_row('SELECT * FROM ' . $table_reserves ." WHERE id =  ". $_REQUEST['payment_id'],OBJECT);
      $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
          'admin_id'        => get_current_user_id(),
          'reservation_id'         => $row->booking_id,
          'text'    => "Eliminó pago #{$_REQUEST['payment_id']} de $".$row->amount,
      ));
    $wpdb->delete( $table_reserves, array( 'id' => $_REQUEST['payment_id'] ) );
    $table_reserves = $wpdb->prefix.'booking_bus_reserveds';
    $rID = $row->booking_id;
    $row = $wpdb->get_row('SELECT * , (SELECT SUM(or_booking_payment.amount) FROM or_booking_payment WHERE or_booking_payment.booking_id =  '.$table_reserves.'.id ) AS total_payment FROM '. $table_reserves . ' WHERE id = ' . $rID,ARRAY_A);
    $row['payments'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'booking_payment WHERE booking_id = ' . $rID,ARRAY_A);
    $row['total_payment'] = floatval($row['total_payment']);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($row);
    die();
  }
}

add_action("wp_ajax_sql_section_update", "sql_section_update");
add_action("wp_ajax_nopriv_sql_section_update", "sql_section_update");
function sql_section_update() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['confirm']=='true'&@$_REQUEST['sql']!='') {
    // print_r($wpdb->query($_REQUEST['sql']));
    // CREATE TABLE IF NOT EXISTS `orozcoviajes`.`or_booking_payment` (
    //   `id` INT(11) NOT NULL AUTO_INCREMENT,
    //   `amount` FLOAT(10,2) NOT NULL,
    //   `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //   `booking_id` INT(11) NOT NULL,
    //   PRIMARY KEY (`id`))
    // ENGINE = InnoDB
    // DEFAULT CHARACTER SET = latin1;
    // echo $_REQUEST['sql'];
  }

  if($_REQUEST&&@$_REQUEST['confirm']) {
    include_once(dirname(__file__).'../../templates/update_sql.php');
  }
}

function set_reserve_customer() {
  global $wpdb;
  if($_REQUEST&&@$_REQUEST['actual_dni']) {
    $data = array(
      'dni'        => get_request('dni'),
      'name'        => get_request('name'),
      'birthday'    => get_request('birthday'),
      'phone'       => get_request('phone'),
      'domain'      => get_request('domain'),
      'postalcode'  => get_request('postalcode'),
      'locale'      => get_request('locale'),
        );
    $wpdb->update($table_reserves,$data,array( 'dni' => get_request('actual_dni') ));
  }
}

function get_bus() {
  global $wpdb;

  if($_REQUEST&&@$_REQUEST['viaje_id']) {
    $viaje = get_post($_REQUEST['viaje_id']);
    $viajeMeta = get_post_meta($viaje->ID);

    $bus = get_post(get_post_meta($viaje->ID,'booking_bus_bus',true));
    $bus_meta = get_post_meta($bus->ID,null,false);
    $htmlHelper = new HtmlHelper('booking_bus');
    $table_reserves= $wpdb->prefix.'booking_bus_reserveds';
    $temp_r = $wpdb->get_results("SELECT $table_reserves.value as val, $table_reserves.status as status, $table_reserves.id as id FROM $table_reserves WHERE $table_reserves.product_id = $viaje->ID ;", OBJECT );
    $reserves = array();
    $reserves_id = array();
    foreach ($temp_r as $val_temp) {
      $reserves[$val_temp->val] = $val_temp->status;
      $reserves_id[$val_temp->val] = $val_temp->id;
    }
    include_once(dirname(__file__).'../../templates/reserva_planta.php');
  }else{
    echo '<div id="message" class="notice notice-error is-dismissible">
            <p>Seleccione un viaje</p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button>
          </div>';
  }
  die();
}

add_action("wp_ajax_reverse_reserve", "reverse_reserve");
add_action("wp_ajax_nopriv_reverse_reserve", "reverse_reserve");
function reverse_reserve(){
  require_once(ABSPATH .'wp-load.php');
  global $wpdb;

  header("Content-Type: application/json");

  if($order_id = @$_POST['order_id']){
      $reserve = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}booking_bus_reserveds WHERE order_id = {$_POST['order_id']}");
      $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
          'admin_id'        => get_current_user_id(),
          'reservation_id'         => $reserve->id,
          'change_type'    => "DELETE",
      ));

      $postData = wp_delete_post($_POST['order_id'],true);
    echo json_encode(array(
      'success' => 1,
      'message' => 'Registro eliminado',
    ));
    die;
  }
  echo json_encode(array(
    'success' => 0,
    'message' => 'No se pudo eliminar el Registro',
  ));
  die;
}

add_action("wp_ajax_get_request_reserve", "get_request_reserve");
add_action("wp_ajax_nopriv_get_request_reserve", "get_request_reserve");
function get_request_reserve(){
  require_once(ABSPATH .'wp-load.php');
  global $wpdb;
  //add_action( 'woocommerce_init');

  if($product_id = get_request('viaje_id')){
    $table_reserves= $wpdb->prefix.'booking_bus_reserveds';
    //validacion
    $tmp_validator = $wpdb->get_results("SELECT * FROM $table_reserves WHERE $table_reserves.product_id = $product_id and $table_reserves.value = '".get_request('value')."';", OBJECT );
    if( count($tmp_validator) > 0 ){
      echo "0";
      die();
    }
    $product = get_post($product_id);
    //$price = get_post_meta( $product_id, '_regular_price', true);
      $price = get_request('price');
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Order &ndash; '.$product->post_title ),
      'post_content'  => '',
      'post_type'     => 'shop_order',
      'post_status'   => ((get_request('status')=='buyed')?'wc-completed':'wc-pending'),
      'comment_status'=> 'closed',
      'ping_status'   => 'closed',
      'post_author'   => 1,
    );
    $order_id = wp_insert_post( $my_post );
    //insert_metas
    add_post_meta($order_id, '_prices_include_tax', 'no');
    add_post_meta($order_id, '_order_version', '3.1.0');
    add_post_meta($order_id, '_order_total', $price);
    add_post_meta($order_id, '_order_tax',0);
    add_post_meta($order_id, '_order_shipping_tax',0);
    add_post_meta($order_id, '_order_shipping',0);
    add_post_meta($order_id, '_cart_discount_tax',0);
    add_post_meta($order_id, '_cart_discount',0);
    add_post_meta($order_id, '_order_currency','ARS');
    add_post_meta($order_id, '_','ARS');
    //insert order item
    $item_id = woocommerce_add_order_item( $order_id, array(
      'order_item_name'       => $product->post_title,
      'order_item_type'       => 'line_item'
    ));
    $band_insert = $wpdb->insert($wpdb->prefix.'booking_bus_reserveds', array(
      'name'        => get_request('name'),
      'dni'         => get_request('dni'),
      'birthday'    => get_request('birthday'),
      'phone'       => get_request('phone'),
      'domain'      => get_request('domain'),
      'postalcode'  => get_request('postalcode'),
      'locale'      => get_request('locale'),
      'item_id'     => $item_id,
      'order_id'    => $order_id,
      'product_id'  => $product_id,
      'status'      => get_request('status'),
      'value'       => get_request('value')
    ));

    $reserve_id = $wpdb->insert_id;

      $log_insert = $wpdb->insert($wpdb->prefix.'booking_bus_logs', array(
          'admin_id'        => get_current_user_id(),
          'reservation_id'         => $reserve_id,
          'change_type'    => get_request('status') == 'reserved' ? 'RESERVE' : 'BUY',

      ));

    if($band_insert !== false){
      $data = array(
        'name'        => get_request('name'),
        'birthday'    => get_request('birthday'),
        'phone'       => get_request('phone'),
        'domain'      => get_request('domain'),
        'postalcode'  => get_request('postalcode'),
        'locale'      => get_request('locale'),
      );
      $wpdb->update($wpdb->prefix.'booking_bus_reserveds',$data,array( 'dni' => get_request('dni') ));
    }

    $metas = array(
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_qty',
        'meta_value'  => 1
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_tax_class',
        'meta_value'  => ''
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_product_id',
        'meta_value'  => $product_id
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_variation_id',
        'meta_value'  => 0
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_line_subtotal',
        'meta_value'  => $price
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_line_subtotal_tax',
        'meta_value'  => 0
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_line_total',
        'meta_value'  => $price
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_line_tax',
        'meta_value'  => 0
      ),
      array(
        'order_item_id' => $item_id,
        'meta_key'     => '_line_tax_data',
        'meta_value'  => 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'
      )
    );
    foreach ($metas as $meta) {
      $wpdb->insert($wpdb->prefix.'woocommerce_order_itemmeta', $meta);
    }
    echo $reserve_id;
    die();
  }
  echo "0";
  die();
}
