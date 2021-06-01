<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; global $htmlHelper; global $bus_configs; ?>
<?php $bus = (get_post_meta($meta_total['booking_bus_bus'][0])); ?>
<?php add_thickbox(); ?>
<div id="modal-window-editor" style="display:none;">
    <h1>Datos De Reserva/Venta</h1>
    <div class="booking-bus-modal">
      <table id="tableReserve">
        <tbody>
          <tr>
            <td>
              <?php $htmlHelper->create_input('name','Nombre y Apellido:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('dni','Dni:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('birthday','Fecha de Nacimiento:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('phone','Teléfono:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('domain','Domicilio:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('postalcode','Código Postal:') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('locale','Localidad:') ?>
            </td>
          </tr>
          <tr style="text-align: center">
              <td>
                  <span id="showHistoryLink" style="cursor: pointer; display:none;"><b>Ver historial de cambios</b></span>
              </td>
          </tr>
        </tbody>
      </table>
        <table id="tableHistory" style="display: none">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Tipo de cambio</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <span id="historyVolver" style="cursor: pointer"><b>Volver</b></span>
                </td>
            </tr>
            </tfoot>
        </table>
      <input type="hidden" id="value_row">
      <div style="text-align:center;" id="actionButtons">
        <input type="button" id="close-action" class="button-rebuy button action" value="Cerrar">&nbsp;
        <input type="button" id="save_action" class="button-rebuy button action" value="Guardar">
      </div>
    </div>
</div>
<div id="modal-window-payment" style="display:none;">
    <h1>Pagos</h1>
    <div class="booking-bus-modal">
      <table>
        <tbody>
          <tr>
            <td>
              <?php $htmlHelper->create_input('amount_payment','Monto:','number') ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php $htmlHelper->create_input('date_payment','Fecha:','date') ?>
            </td>
          </tr>
        <tbody>
      <table>
      <input type="hidden" id="value_row">
      <div style="text-align:center; margin: 20px 0;">
        <input type="button" id="save_action_payment" class="button-rebuy button action" value="Guardar">
      </div>
      <table class="wp-list-table widefat fixed striped posts" id="list_payments">
      	<thead>
        	<tr>
        		<td id="cb" class="manage-column column-cb check-column">
              <label class="screen-reader-text" for="cb-select-all-1"></label>
            </td>
                <th scope="col" class="manage-column"><span class=" tips">#</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Fecha</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Monto</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
          </tr>
      	</thead>
      	<tbody>
          <tr class=" status-publish hentry">
            <td colspan="4" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td>
          </tr>
        </tbody>
      	<tfoot>
        	<tr>
        		<td id="cb" class="manage-column column-cb check-column">
              <label class="screen-reader-text" for="cb-select-all-1"></label>
            </td>
                <th scope="col" class="manage-column"><span class=" tips">#</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Fecha</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Monto</span></th>
            <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
          </tr>
      	</tfoot>
      </table>
      <div style="text-align:center; margin: 20px 0;">
        <input type="button" id="close-action" class="button-rebuy button action" value="Cerrar">
      </div>
    </div>
</div>
<script type="text/javascript">
    function generarRecibo(paymentId) {
        var win = window.open("admin-ajax.php?action=booking_bus_recibo&payment_id=" + paymentId, '_blank');
        win.focus();
    }
  window.onload = function(){
        console.log("entro");
        if (jQuery('#reservation_id').val() != '') {
            jQuery('[reservation-id="' + jQuery('#reservation_id').val() + '"]').css('background-color', '#1085b2');
            jQuery('[reservation-id="' + jQuery('#reservation_id').val() + '"] td').css('color', 'white');
                setTimeout(function() {
                    jQuery(document).scrollTop(jQuery('[reservation-id="' + jQuery('#reservation_id').val() + '"]').offset().top - 200);
                }, 500)
        }
    function reset_edit_report(){
      jQuery('#booking_bus_name').val('');
      jQuery('#booking_bus_dni').val('');
      jQuery('#booking_bus_birthday').val('');
      jQuery('#booking_bus_phone').val('');
      jQuery('#booking_bus_domain').val('');
      jQuery('#booking_bus_postalcode').val('');
      jQuery('#booking_bus_locale').val('');
      jQuery('#value_row').val('');
      jQuery('.tb-close-icon').click();
    }
    function reset_payment_report(){
      jQuery('#booking_bus_amount_payment').val('0');
      jQuery('#booking_bus_date_payment').val('<?php echo date('Y-m-d') ?>');
      jQuery('#list_payments tbody tr').remove();
      jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><td colspan="5" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td></tr></tbody>');
      jQuery('.tb-close-icon').click();
    }
    jQuery('#modal-window-editor #close-action').click(function(){
      reset_edit_report();
    });
    jQuery('#modal-window-payment #close-action').click(function(){
      reset_payment_report();
    });
    jQuery('#doprint').click(function(){
      jQuery("#print_area_report").print();
    });
    jQuery('#save_action').click(function(){
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=set_reserve'); ?>',
        type: "POST",
        data: {
          id : jQuery('#value_row').val(),
          name : jQuery('#booking_bus_name').val(),
          dni : jQuery('#booking_bus_dni').val(),
          birthday : jQuery('#booking_bus_birthday').val(),
          phone: jQuery('#booking_bus_phone').val(),
          domain : jQuery('#booking_bus_domain').val(),
          postalcode : jQuery('#booking_bus_postalcode').val(),
          locale : jQuery('#booking_bus_locale').val()
        },
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        location.reload();
        reset_edit_report();
      });
    });
    jQuery('#save_action_payment').click(function(){
      jQuery(this).prop('disabled',true);
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=set_payment'); ?>',
        type: "POST",
        data: {
          id : jQuery('#value_row').val(),
          amount : jQuery('#booking_bus_amount_payment').val(),
          date : jQuery('#booking_bus_date_payment').val(),
        },
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        reset_payment_report();
        location.reload();
      });
    });
    jQuery('a.thickbox.fa-edit').click(function(){
      var row_id = jQuery(this).attr('ident');
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=get_reserve'); ?>',
        type: "POST",
        data: {
          id : row_id },
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        var message = JSON.parse(msg);
        jQuery('#booking_bus_name').val(message.name);
        jQuery('#booking_bus_dni').val(message.dni);
        jQuery('#booking_bus_birthday').val(message.birthday);
        jQuery('#booking_bus_phone').val(message.phone);
        jQuery('#booking_bus_domain').val(message.domain);
        jQuery('#booking_bus_postalcode').val(message.postalcode);
        jQuery('#booking_bus_locale').val(message.locale);
        jQuery('#value_row').val(message.id);
        console.log(message.logs);

          jQuery('#showHistoryLink').show();
          jQuery('#tableHistory tbody').empty();

          //Lleno tabla de logs
          for (let log of message.logs) {
              console.log(log);
              let descripcion = '';
              switch (log.change_type) {
                  case 'RESERVE':
                      descripcion = "Realizó la reserva";
                      break;
                  case 'BUY':
                      descripcion = "Realizó la venta";
                      break;
                  case 'UPDATE':
                      descripcion = "Editó la reserva";
                      break;
                  case 'DELETE':
                      descripcion = "Anuló la reserva";
                      break;
                  default:
                      descripcion = log.text;
                      break;
              }


              jQuery('#tableHistory tbody').append(`<tr>
                                                <td>${log.display_name}</td>
                                                <td>${descripcion}</td>
                                                <td>${log.date}</td>
                                              </tr>`
              );
          }




      });
    });

    jQuery('#showHistoryLink').click(function(e){
          jQuery('#tableHistory').show();
          jQuery('#tableReserve').hide();
          jQuery('#actionButtons').hide();
      });

      jQuery('#historyVolver').click(function(e){
          jQuery('#tableHistory').hide();
          jQuery('#tableReserve').show();
          jQuery('#actionButtons').show();
      });

    jQuery('a.thickbox.fa-credit-card').click(function() {
      jQuery('#list_payments tbody tr').remove();
      jQuery('#booking_bus_amount_payment').val('0');
      jQuery('#booking_bus_date_payment').val('<?php echo date('Y-m-d') ?>');
      var row_id = jQuery(this).attr('ident');
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=get_reserve'); ?>',
        type: "POST",
        data: {
          id : row_id },
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        var message = JSON.parse(msg);
        if(message.payments.length <= 0){
          jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><td colspan="5" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td></tr></tbody>');
        }
        jQuery.each(message.payments, function(index, value) {
          jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><th scope="row" class="check-column"> </th><td class="name column-name has-row-actions column-primary">'+value.id+' </td><td class="name column-name has-row-actions column-primary">'+value.create_at+' </td><td class="name column-name has-row-actions column-primary">'+value.amount+' </td><td class="name column-name has-row-actions column-primary"><button type="button" id="generarRecibo" onclick="generarRecibo(' + value.id + ')" title="Generar recibo" class="button tips fa fa-money"></button> <button type="button" data-id="'+value.id+'" title="Eliminar" class="button tips delete_payment fa fa-trash"></button> </td></tr>');
        });
        jQuery('#value_row').val(message.id);
        jQuery('.delete_payment').click(function() {
          var id = jQuery(this).data('id');
          jQuery.ajax({
            url: '<?= admin_url('admin-ajax.php?action=delete_payment'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {payment_id: id}
          }).done(function() {
            reset_payment_report();
            location.reload();
          });

        });
        console.log(message);
      });
    });
    jQuery('#do_print').click(function() {
      var product_id = jQuery('#product_id').val();
      window.open("<?= admin_url('admin-ajax.php?action=get_report&product_id='); ?>"+product_id,"_blank");
    });
    jQuery('#do_select').click(function() {
      var product_id = jQuery('#product_id').val();
      window.open("<?= admin_url('admin.php?page=booking_bus_reserve&product_id='); ?>"+product_id,"_self");
    });

    jQuery('#search_str').keyup(function() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("search_str");
      filter = input.value.toUpperCase();
      table = document.getElementById("the-list");
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        band = false;
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if (td) {
            if(td[j].innerHTML.search(filter)>-1){
              band = true;
            }
          }
        }
        if(band){
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    });
  }
</script>
<style media="screen">
  .busqueda{
    font-size: 12px;
    position: relative;
    float: right;
  }
  #search_str {
    position: relative;
    right: 0px;
  }
  .wp-heading-inline {
    display: block;
    width: 100%;
  }
</style>

<?php $amount = ($order = wc_get_product($product_id)->price); ?>

<div class="wrap">
  <h1 class="wp-heading-inline">Reporte</h1>
  <br><br>
  <div class="top">
    <div class="alignleft actions bulkactions">
      <form class="<?= $actual_link ?>" method="get">
        <label for="bulk-action-selector-top" class="screen-reader-text">Selecciona acción en lote</label>
        <input type="hidden" name="page" value="<?= @$_GET['page'] ?>">
          <input type="hidden" id="reservation_id" name="reservation_id" value="<?= @$_GET['reservation_id'] ?>">
        <select name="product_id" id="product_id">
          <option value="0">-- Seleccione un Viaje --</option>
          <?php foreach ($products as $p): ?>
            <option  <?= ($product_id==$p->ID)?'selected="selected"':''; ?>  value="<?= $p->ID ?>"><?= $p->post_title ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" id="doaction" class="button action" value="Mostrar">
        <input type="button" id="do_select" class="button action" value="Habitaciones">
        <input type="submit" id="do_print" class="button action" value="Descargar Reporte">
      </form>
    </div>
    <br><br><br>
  <div id="print_area_report">
    <h3>
      Listado de Asientos Ocupados
      <label class="busqueda" for="">
        Buscar:
        <input type="text" id="search_str" placeholder="...">
      </label>
    </h3>
    <table class="wp-list-table widefat fixed striped posts">
    	<thead>
      	<tr>
      		<td id="cb" class="manage-column column-cb check-column">
            <label class="screen-reader-text" for="cb-select-all-1"></label>
          </td>
          <th scope="col" class="manage-column"><span class=" tips">Nombre y Apellido</span></th>
          <th scope="col" class="manage-column"><span class=" tips">DNI</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Fecha de Nac.</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Teléfono</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Domicilio</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Código Postal</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Localidad</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Asiento</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Habitaci&oacute;n</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Status</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Pagado</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
        </tr>
    	</thead>
      <?php if (count($reservs)): ?>
    	<tbody id="the-list">
        <?php foreach ($reservs as $single):
            $amount = wc_get_order($single->order_id)->get_total();
            ?>
          <tr id="post-106" reservation-id="<?=$single->id ?>" class=" status-publish hentry">
      			<th scope="row" class="check-column"> </th>
            <td class="name column-name has-row-actions column-primary"><?= $single->name ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= $single->dni ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= mysql_espanol($single->birthday); ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= $single->phone ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= $single->domain ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= $single->postalcode ?> </td>
            <td class="name column-name has-row-actions column-primary"><?= $single->locale ?></td>
            <td class="name column-name has-row-actions column-primary"><?= @$bus["booking_plants_".$single->value][0] ?></td>
            <td class="name column-name has-row-actions column-primary"><?= @$single->bed ?></td>
            <td class="name column-name has-row-actions column-primary"><?= convert_status($single->status) ?></td>
            <td class="name column-name has-row-actions column-primary"><?= $single->total_payment>=$amount?'<div class="booking-bus-badge badge-green"><b>Pagado</b></div><div style="margin-top: 5px; text-align: center">'.wc_price($single->total_payment).'</div>':(wc_price($single->total_payment) . ($single->total_payment<$amount?' de '.wc_price($amount):'')) ?></td>
            <td class="order_actions column-order_actions" data-colname="Acciones">
              <p>
                  <a title="Vouche" class="button tips fa fa-file" target="_blank" href="<?= wp_nonce_url( admin_url('admin-ajax.php?action=booking_bus_vouches&product_id='.$product_id.'&vouche_id='.$single->id), 'woocommerce-mark-order-status' ) ?>"></a>
                  <?php if ( $single->status != 'buyed' && $single->status != 'temp' ): ?>
                  <a title="Procesar" class="button tips fa fa-check" href="<?= wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=completed&order_id=' . $single->order_id), 'woocommerce-mark-order-status' ) ?>"></a>
                  <?php endif; ?>
                  <?php if ( $single->status != 'temp' ): ?>
                  <a title="Mostrar Detalle" class="button tips fa fa-eye" href="<?=  admin_url('post.php?post='.$single->order_id) ?>&amp;action=edit"></a>
                  <?php endif; ?>
                  <?php if ( $single->status != 'buyed' ): ?>
                  <a title="Modificar" ident="<?= $single->id ?>" href="#TB_inline?width=500&height=420&inlineId=modal-window-editor" class="hvr-grow thickbox button tips fa fa-edit" data-order="<?= $single->order_id ?>"></a>
                  <?php endif; ?>
                    <a title="Pago" ident="<?= $single->id ?>" href="#TB_inline?width=500&height=420&inlineId=modal-window-payment" class="hvr-grow thickbox button tips fa fa-credit-card" data-order="<?= $single->order_id ?>"></a>
                  <a title="Eliminar" class="button tips fa fa-trash" href="<?=  get_delete_post_link($single->order_id,null,true) ?>"></a>
      				</p>
            </td>
          </tr>
        <?php endforeach; ?>
  		</tbody>
      <?php else: ?>
        <tr id="post-106" class=" status-publish hentry">
          <td colspan="13" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td>
        </tr>
      <?php endif; ?>
    	<tfoot>
        <tr>
          <td id="cb" class="manage-column column-cb check-column">
            <label class="screen-reader-text" for="cb-select-all-1"></label>
          </td>
          <th scope="col" class="manage-column"><span class=" tips">Nombre y Apellido</span></th>
          <th scope="col" class="manage-column"><span class=" tips">DNI</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Fecha de Nac.</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Teléfono</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Domicilio</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Código Postal</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Localidad</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Asiento</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Habitaci&oacute;n</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Status</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Pagado</span></th>
          <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
        </tr>
    	</tfoot>

    </table>
    <br>
    <h3>Listado de Asientos Disponibles</h3>
    <?php

      $plants = ($bus['booking_bus_plantas'][0]==1)?array('a'):array('a','b');
      $filas = $bus['booking_bus_filas'][0];
      $cont_avaliable = 0;
    ?>
    <table>
      <tr>
        <?php foreach ($plants as $plv): ?>
        <td style="width:<?= (count($plants)==1)?'100%':'50%' ?>;vertical-align:top;">
          <h4>Planta <?= ($plv=='a')?'Baja':'Alta' ?></h4>
          <table class="wp-list-table widefat fixed striped posts">
          	<thead>
            	<tr>
            		<td id="cb" class="manage-column column-cb check-column">
                  <label class="screen-reader-text" for="cb-select-all-1"></label>
                </td>
                <th scope="col" class="manage-column"><span class=" tips">Asiento</span></th>
                <th scope="col" class="manage-column"><span class=" tips">Estatus</span></th>
              </tr>
          	</thead>
          	<tbody id="the-list">
              <?php for ($cols = 1; $cols <= $filas ; $cols++): ?>
              <?php for ($rows = 1; $rows <= $bus_configs['rows'] ; $rows++): ?>
                <?php if ($bus["booking_plants_".$plv."_".$rows."_".$cols][0] && $bus["booking_plants_".$plv."_".$rows."_".$cols][0] != ''&&! in_array($plv."_".$rows."_".$cols,$seats_reserve) == true): $cont_avaliable++ ?>
                    <tr id="" class=" status-publish hentry">
                			<th scope="row" class="check-column"> </th>
                      <td class="name column-name has-row-actions column-primary"><?= @$bus["booking_plants_".$plv."_".$rows."_".$cols][0] ?> </td>
                      <td class="name column-name has-row-actions column-primary">Disponible </td>
                    </tr>
                  <?php endif; ?>
                <?php endfor; ?>
              <?php endfor; ?>
        		</tbody>
          	<tfoot>
              <tr>
                <td id="cb" class="manage-column column-cb check-column">
                  <label class="screen-reader-text" for="cb-select-all-1"></label>
                </td>
                <th scope="col" class="manage-column"><span class=" tips">Asiento</span></th>
                <th scope="col" class="manage-column"><span class=" tips">Estatus</span></th>
              </tr>
          	</tfoot>

          </table>
        </td>
      <?php endforeach; ?>
      </tr>
    </table>
    <?php if (count($reservs)): ?>
    <div class="">
      <p><strong>Disponibles: <?= $cont_avaliable; ?></strong></p>
      <p><strong>Ocupados: <?= count($reservs); ?></strong></p>
    </div>
      <?php endif; ?>
    </div>
		<br class="clear">
	</div>
</div>
