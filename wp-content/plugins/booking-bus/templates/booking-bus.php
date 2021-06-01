<?php
global $wpdb;
$meta = get_post_meta( get_the_id());
$bus_meta = get_post_meta( $meta['booking_bus_bus'][0] );// print_r($bus_meta);
$table_reserves= $wpdb->prefix.'booking_bus_reserveds';
$temp_r = $wpdb->get_results("SELECT $table_reserves.value as val, $table_reserves.status as status FROM $table_reserves WHERE $table_reserves.product_id = ".get_the_id()." ;", OBJECT );
$reserves = array();
$htmlHelper = new HtmlHelper('booking_bus');
$product = get_product(get_the_id());

$My_sess = new WC_Session_Handler();
foreach ($temp_r as $val_temp) {
  $reserves[$val_temp->val] = $val_temp->status;
}
?>

<p style="margin: 0px 0 0.4em;"><b>Salida: </b> <?= $meta['booking_bus_fecha_salida'][0] ?> <b>Retorno:</b> <?= $meta['booking_bus_fecha_retorno'][0] ?></p>
<p style="margin: 0px 0 0.4em;"><b>Hora de Salida: </b> <?= $bus_configs['hora'][$meta['booking_bus_capacidad'][0]] ?></p>
<p style="margin: 0px 0 0.4em;"><b>Origen: </b> <?= get_the_title($meta['booking_bus_from'][0]) ?></p>
<p style="margin: 0px 0 0.4em;"><b>Destino: </b> <?= get_the_title($meta['booking_bus_to'][0]) ?></p>

<!-- Modal -->
<form id="booking_form" action="" method="post"  data-toggle="validator">
  <div class="modal fade" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          Datos de Personales
        </div>
        <div id="content-book" class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="booking_name" name="name" value="" required placeholder="Nombre y Apellido">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="booking_dni" name="dni" value="" required placeholder="DNI">
              </div>
              <div class="form-group">
                <input type="date" class="form-control" id="booking_birthday" name="birthday" value="" required placeholder="Fecha de Nacimiento">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="booking_domain" name="domain" value="" required placeholder="Domicilio">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="booking_phone" name="phone" value="" required placeholder="Tel&eacute;fono">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="booking_postalcode" name="postalcode" value="" placeholder="Codigo Postal">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="booking_locale" name="locale" value="" required placeholder="Localidad">
              </div>
              <input type="hidden" name="asiento" id="asiento_id" value="" placeholder="">
              <input type="hidden" name="product_id" id="product_id" value="<?= get_the_id() ?>" placeholder="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
          <button type="button" id="save_booking" class="btn btn-primary">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="modal fade" id="booking_modal_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div id="content-book" class="modal-body">
          <p>Desea realizar otra compra?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Si</button>
        <a href="<?php echo site_url('index.php/carrito'); ?>" class="btn btn-primary">Finalizar Compra</a>
      </div>
    </div>
  </div>
</div>

<?php
$filas = $bus_meta['booking_bus_filas'][0];
$plantas = (($bus_meta['booking_bus_plantas'][0]==1)?array(a):array(a,b));
?>
<input type="hidden" id="viaje_id" value="">
<input type="hidden" id="viaje_title" value="">

<?php if ($bus_meta['booking_bus_plantas'][0]>1): ?>
<select id="selector_plantas">
  <option selected="selected" value="a">Planta Baja</option>
  <option value="b">Planta Alta</option>
</select>
<?php endif; ?>

<?php $bp = false; foreach ($plantas as $planta): ?>
<div class="plantas_content" id="content_planta_<?= $planta ?>" <?php if($bp): ?>style="display:none;"<?php endif; ?>>
  <h1>Planta <?= (($planta=="b")?"Alta":"Baja") ?></h1>
  <table>
    <tbody>
      <?php for ($row=1; $row <= 5 ; $row++): ?>
      <tr>
        <?php for ($i=1;$i <= $filas ;$i++): $row_ident = $planta.'_'.$row.'_'.$i; $value = $bus_meta['booking_plants_'.$row_ident][0]; ?>
          <td class="plants_row_<?= $row.'_'.$i ?>">
            <?php $status_reserve = isset($reserves[$row_ident])?$reserves[$row_ident]:'avaliable'; ?>
            <button style="background: url(<?php echo plugins_url( 'booking-bus/assets/imgs/seat.png') ?>) no-repeat; background-size: 101%" id="<?= $planta.'_'.$row.'_'.$i ?>" type="button" status="<?= $htmlHelper->status_asiento($value,$status_reserve) ?>" class="<?= $htmlHelper->status_asiento($value,$status_reserve) ?> btn btn-primary btn-lg">
              <?= $value ?>
            </button>
          </td>
        <?php endfor; ?>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>
<?php $bp = true; endforeach; ?>
<script type="text/javascript">
  window.onload = function (){

    jQuery('#booking_name').autocomplete({
        serviceUrl: '<?= admin_url('admin-ajax.php?action=get_list_ajax&query_arg=name'); ?>',
        onSelect: function (suggestion) {
          jQuery('#booking_name').val(suggestion.name);
          jQuery('#booking_dni').val(suggestion.dni);
          jQuery('#booking_birthday').val(suggestion.birthday);
          jQuery('#booking_domain').val(suggestion.domain);
          jQuery('#booking_phone').val(suggestion.phone);
          jQuery('#booking_postalcode').val(suggestion.postalcode);
          jQuery('#booking_locale').val(suggestion.locale);
          console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });

    jQuery('#booking_dni').autocomplete({
        serviceUrl: '<?= admin_url('admin-ajax.php?action=get_list_ajax&query_arg=dni'); ?>',
        onSelect: function (suggestion) {
          jQuery('#booking_name').val(suggestion.name);
          jQuery('#booking_dni').val(suggestion.dni);
          jQuery('#booking_birthday').val(suggestion.birthday);
          jQuery('#booking_domain').val(suggestion.domain);
          jQuery('#booking_phone').val(suggestion.phone);
          jQuery('#booking_postalcode').val(suggestion.postalcode);
          jQuery('#booking_locale').val(suggestion.locale);
          console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });

    jQuery('#save_booking').click(function(){
      jQuery(this).prop('disabled',true);
      var product_id = <?= get_the_id(); ?>;
      var name = jQuery('#booking_name').val();
      var dni = jQuery('#booking_dni').val();
      var birthday = jQuery('#booking_birthday').val();
      var domain = jQuery('#booking_domain').val();
      var phone = jQuery('#booking_phone').val();
      var postalcode = jQuery('#booking_postalcode').val();
      var locale = jQuery('#booking_locale').val();
      var value_a = jQuery('#asiento_id').val();
      var request_reserve = jQuery.ajax({
        url: '<?php echo site_url(); ?><?= $product->add_to_cart_url() ?>',
        type: "POST",
        data: {
          product_id : product_id,
          name: name,
          dni : dni,
          birthday : birthday,
          phone: phone,
          domain: domain,
          postalcode: postalcode,
          locale : locale,
          value: value_a},
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        jQuery('#'+value_a).attr('status','temp');
        jQuery('#'+value_a).removeClass('avaliable');
        jQuery('#'+value_a).prop('disabled',true);
        jQuery('#'+value_a).addClass('temp');
        jQuery('#save_booking').prop('disabled',false);

        jQuery('#booking_name').val('');
        jQuery('#booking_dni').val('');
        jQuery('#booking_birthday').val('');
        jQuery('#booking_domain').val('');
        jQuery('#booking_phone').val('');
        jQuery('#booking_postalcode').val('');
        jQuery('#booking_locale').val('');
        jQuery('#asiento_id').val('');


        jQuery('#booking_modal').modal('hide');
        jQuery('#booking_modal_dialog').modal('show');
      });
    });
    jQuery('#selector_plantas').change(function(){
      if(jQuery(this).val()=="b"){
        jQuery('#content_planta_a').hide();
        jQuery('#content_planta_b').show();
      }else{
        jQuery('#content_planta_b').hide();
        jQuery('#content_planta_a').show();
      }
    })
    jQuery('button.avaliable').click(function(){
      jQuery('#booking_modal').modal('show');

      jQuery('#asiento_id').val(jQuery(this).attr('id'));
    });
  }
</script>
