<?php
$filas = $bus_meta['booking_bus_filas'][0];
$plantas = (($bus_meta['booking_bus_plantas'][0]==1)?array(a):array(a,b));
$priceOptions = array();
$priceOptions[$viajeMeta['_regular_price'][0]] = "$ ".$viajeMeta['_regular_price'][0];

if ($viajeMeta['_sale_price'][0] != "" && $viajeMeta['_sale_price'][0] != null) {
    $priceOptions[$viajeMeta['_sale_price'][0]] = "$ ".$viajeMeta['_sale_price'][0];
}
?>
<input type="hidden" id="viaje_id" value="<?= $viaje->ID ?>">
<input type="hidden" id="tarifa_cama" value="<?= $viajeMeta['_regular_price'][0] ?>">
<input type="hidden" id="tarifa_semicama" value="<?= $viajeMeta['_sale_price'][0] ?>">
<input type="hidden" id="viaje_title" value="<?= $viaje->post_title ?>">

<?php if (count($plantas)>1): ?>
<select id="selector_plantas">
  <option selected="selected" value="a">Planta Baja</option>
  <option value="b">Planta Alta</option>
</select>
<script type="text/javascript">
jQuery(document).ready(function(){

  jQuery('#booking_bus_name').autocomplete({
      serviceUrl: '<?= admin_url('admin-ajax.php?action=get_list_ajax&query_arg=name'); ?>',
      onSelect: function (suggestion) {
        jQuery('#booking_bus_name').val(suggestion.name);
        jQuery('#booking_bus_dni').val(suggestion.dni);
        jQuery('#booking_bus_birthday').val(suggestion.birthday);
        jQuery('#booking_bus_domain').val(suggestion.domain);
        jQuery('#booking_bus_phone').val(suggestion.phone);
        jQuery('#booking_bus_postalcode').val(suggestion.postalcode);
        jQuery('#booking_bus_locale').val(suggestion.locale);
        console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
      }
  });

  jQuery('#booking_bus_dni').autocomplete({
      serviceUrl: '<?= admin_url('admin-ajax.php?action=get_list_ajax&query_arg=dni'); ?>',
      onSelect: function (suggestion) {
        jQuery('#booking_bus_name').val(suggestion.name);
        jQuery('#booking_bus_dni').val(suggestion.dni);
        jQuery('#booking_bus_birthday').val(suggestion.birthday);
        jQuery('#booking_bus_domain').val(suggestion.domain);
        jQuery('#booking_bus_phone').val(suggestion.phone);
        jQuery('#booking_bus_postalcode').val(suggestion.postalcode);
        jQuery('#booking_bus_locale').val(suggestion.locale);
        console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
      }
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
});
</script>
<?php endif; ?>

<div id="modal-window-id" style="display:none;">
    <h1>Datos De Reserva/Venta</h1>
    <div id="booking-bus-detail" class="booking-bus-modal">
      <table id="tableReserve">
        <tbody>
        <tr>
            <td>
                <?php $htmlHelper->create_dropdown('price','Precio:', $priceOptions) ?>
            </td>
        </tr>
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
      <input type="hidden" id="order_id">
      <input type="hidden" id="row_id">
        <input type="hidden" id="user_insert_id">
      <div id="actionButtons" style="text-align:center;">
        <input type="button" id="reserved" class="button-rebuy button action" value="Reservado">&nbsp;
        <input type="button" id="buyed" class="button-rebuy button action" value="Vendido">
        <input type="button" id="reversed" class="button action" value="Anular" disabled="disabled" style="display:none">
        <input type="button" id="edit_btn" class="button action" value="Editar" style="display:none">
        <input type="button" id="save_btn" class="button action" value="Guardar" style="display:none">
        <button type="button" id="payment_btn" class="button action">Pago</button>
      </div>
    </div>
    <div id="booking-bus-payment" style="display:none">
      <table>
        <tbody>
          <tr>
            <td>
              <label for="Domicilio:">Pagado:</label>
              <span id="price_order"></span>
            </td>
          </tr>
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
        </tbody>
      </table>
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
      <div style="text-align:center; margin: 20px 0px">
        <input type="button" id="save_payment_btn" class="button action" value="Guardar">
        <button type="button" id="detail_btn" class="button action">Detalle</button>
      </div>
    </div>
</div>
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
            <a style="background: url(<?php echo plugins_url( 'booking-bus/assets/imgs/seat-admin.png') ?>) no-repeat; background-size: 101%"
              id="<?= $planta.'_'.$row.'_'.$i ?>"
              <?php if ($status_reserve != 'avaliable'): ?>
                ident-reserve="<?php echo $reserves_id[$row_ident] ?>"
              <?php endif; ?>
              <?php if($value!=''&&!(isset($reserves[$row_ident]))): ?>href="#TB_inline?width=500&height=420&inlineId=modal-window-id"<?php endif; ?>
              status="<?php echo $htmlHelper->status_asiento($value,$status_reserve); ?>"
              index="<?php echo $planta.'_'.$row.'_'.$i ?>"
              class="hvr-grow thickbox asiento_fila <?php echo $htmlHelper->status_asiento($value,$status_reserve) ?>">
              <?= $value ?>
            </a>
          </td>
        <?php endfor; ?>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>
<?php $bp = true; endforeach; ?>
<script type="text/javascript">
    var amount = <?php echo floatval(wc_get_product($viaje->ID)->price) ?>;
    function reset_payment_report(){
      jQuery('#booking_bus_amount_payment').val('0');
      jQuery('#booking_bus_date_payment').val('<?php echo date('Y-m-d') ?>');
      jQuery('#list_payments tbody tr').remove();
      jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><td colspan="5" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td></tr></tbody>');
    }
    jQuery('#payment_btn').click(function(e){
      jQuery('#booking-bus-detail').hide();
      jQuery('#booking-bus-payment').show();
    });
    jQuery('#detail_btn').click(function(e){
      jQuery('#booking-bus-detail').show();
      jQuery('#booking-bus-payment').hide();
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
    jQuery('#save_payment_btn').click(function(){
      jQuery(this).prop('disabled',true);
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=set_payment'); ?>',
        type: "POST",
        dataType: 'json',
        data: {
          id : jQuery('#row_id').val(),
          amount : jQuery('#booking_bus_amount_payment').val(),
          date : jQuery('#booking_bus_date_payment').val(),
        }
      });
      request_reserve.done(function( response ) {
        regenerate_table(response);
        // jQuery('#list_payments tbody tr').remove();
        // if(response.payments.length <= 0){
        //   jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><td colspan="4" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td></tr></tbody>');
        // }
        // jQuery.each(response.payments, function(index, value) {
        //   jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><th scope="row" class="check-column"> </th><td class="name column-name has-row-actions column-primary">'+value.amount+' </td><td class="name column-name has-row-actions column-primary">'+value.create_at+' </td><td class="name column-name has-row-actions column-primary"><button type="button" data-id="'+value.id+'" title="Eliminar" class="button tips delete_payment fa fa-trash"></button> </td></tr>');
        // });
        //
        // jQuery('.delete_payment').click(function() {
        //   var id = jQuery(this).data('id');
        //   jQuery.ajax({
        //     url: '<?= admin_url('admin-ajax.php?action=delete_payment'); ?>',
        //     type: 'POST',
        //     dataType: 'json',
        //     data: {payment_id: id}
        //   }).done(function() {
        //     reset_payment_report();
        //     location.reload();
        //   });
        //
        // });
        //
        // jQuery('#save_payment_btn').prop('disabled',false);
        //
        // if( response.total_payment < amount ) {
        //   jQuery('span#price_order').text(response.total_payment + " $ de " + amount + " $");
        // } else {
        //   jQuery('#save_payment_btn').hide().prop('disabled',true);
        //   jQuery('span#price_order').text("Pagado");
        // }
      });
    });
    function generarRecibo(paymentId) {
        var win = window.open("admin-ajax.php?action=booking_bus_recibo&payment_id=" + paymentId, '_blank');
        win.focus();
    }
  function regenerate_table(data) {
        console.log(data);
    jQuery('#list_payments tbody tr').remove();
    if(data.payments.length <= 0){
      jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><td colspan="5" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td></tr></tbody>');
    }
    jQuery.each(data.payments, function(index, value) {
      jQuery('#list_payments tbody').append('<tr id="post-106" class=" status-publish hentry"><th scope="row" class="check-column"> </th><td class="name column-name has-row-actions column-primary">'+value.id+' </td><td class="name column-name has-row-actions column-primary">'+value.create_at+' </td><td class="name column-name has-row-actions column-primary">'+value.amount+' </td><td class="name column-name has-row-actions column-primary"><button type="button" id="generarRecibo" onclick="generarRecibo(' + value.id + ')" title="Generar recibo" class="button tips fa fa-money"></button> <button type="button" data-id="'+value.id+'" title="Eliminar" class="button tips delete_payment fa fa-trash"></button> </td></tr>');
    });
    jQuery('.delete_payment').click(function() {
      var id = jQuery(this).data('id');
      jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=delete_payment'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {payment_id: id}
      }).done(function(response) {
        regenerate_table(response)
      });
    });

    jQuery('#save_payment_btn').prop('disabled',false);

    if( data.total_payment < amount ) {
      jQuery('span#price_order').text(data.total_payment + " $ de " + amount + " $");
    } else {
      jQuery('#save_payment_btn').hide().prop('disabled',true);
      jQuery('span#price_order').text("Pagado");
    }
  }

  jQuery('.asiento_fila').click(function(e) {
    jQuery('span#price_order').text(amount+" $");
    reset_payment_report();
    jQuery('#detail_btn').click();
    jQuery('#value_row').val(jQuery(this).attr('id'));
    jQuery('#payment_btn').hide().prop('disabled',true);
      if(jQuery(this).attr('status') != 'avaliable'){
        jQuery(this).attr('href','#TB_inline?width=500&height=420&inlineId=modal-window-id');
        jQuery('#modal-window-id').find('input,select').each(function(index, el) {
          jQuery(this).prop('disabled',true);
        });
        jQuery('#modal-window-id').find('button').each(function(index, el) {
          jQuery(this).hide();
        });
        jQuery.ajax({
          url: '<?= admin_url('admin-ajax.php?action=get_reserve'); ?>',
          type: 'POST',
          dataType: 'json',
          data: {id: jQuery(this).attr('ident-reserve')}
        })
        .done(function(response) {
          jQuery('#booking_bus_name').val(response.name);
          jQuery('#booking_bus_price').val(response.totalViaje);
          jQuery('#booking_bus_dni').val(response.dni);
          jQuery('#booking_bus_birthday').val(response.brithday);
          jQuery('#booking_bus_phone').val(response.phone);
          jQuery('#booking_bus_domain').val(response.domain);
          jQuery('#booking_bus_postalcode').val(response.postalcode);
          jQuery('#booking_bus_locale').val(response.locale);
          jQuery('#order_id').val(response.order_id);
          jQuery('#row_id').val(response.id);

          jQuery('#showHistoryLink').show();
          jQuery('#tableHistory tbody').empty();

          jQuery('#reversed').show().prop('disabled',false);
          jQuery('#edit_btn').show().prop('disabled',false);
          jQuery('#payment_btn').show().prop('disabled',false);
          jQuery('#save_payment_btn').show().prop('disabled',false);
          jQuery('#detail_btn').show().prop('disabled',false);
          jQuery('#booking_bus_amount_payment').val('0').prop('disabled',false);
          jQuery('#booking_bus_date_payment').val('<?php echo date('Y-m-d') ?>').prop('disabled',false);

          //Lleno tabla de logs
            for (let log of response.logs) {
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

          regenerate_table(response);

          if( response.total_payment < amount ) {
            jQuery('span#price_order').text(`$ ${response.total_payment} de $ ${response.totalViaje}`);
          } else {
            jQuery('#save_payment_btn').hide().prop('disabled',true);
            jQuery('span#price_order').text("Pagado");
          }
        });
      } else {
          jQuery('#booking_bus_price').val(jQuery('#booking_bus_price option:first').val());
        jQuery('#booking_bus_name').val('');
        jQuery('#booking_bus_dni').val('');
        jQuery('#booking_bus_birthday').val('');
        jQuery('#booking_bus_phone').val('');
        jQuery('#booking_bus_domain').val('');
        jQuery('#booking_bus_postalcode').val('');
        jQuery('#booking_bus_locale').val('');
        jQuery('#order_id').val('');
        jQuery('#row_id').val('');

          jQuery('#showHistoryLink').hide();

        jQuery('#reversed').hide().prop('disabled',true);
        jQuery('#edit_btn').hide().prop('disabled',true);
        jQuery('#save_btn').hide().prop('disabled',true);

        jQuery('.button-rebuy').show();
        jQuery('#modal-window-id').find('input,select').each(function(index, el) {
          jQuery(this).prop('disabled',false);
        });
        jQuery('#modal-window-id').find('button').each(function(index, el) {
          jQuery(this).show();
        });
        jQuery('#payment_btn').hide().prop('disabled',true);
      }
    });
    jQuery('#edit_btn').click(function(event) {
      jQuery('.button-rebuy').hide();
      jQuery(this).hide().prop('disabled',true);
      jQuery('#reversed').hide();
      jQuery('#save_btn').show().prop('disabled',false);
      jQuery('.booking-bus-modal input,select').prop('disabled',false);
    });
    jQuery('#save_btn').click(function(event) {


      jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=set_reserve'); ?>',
        type: "POST",
        data: {
          id : jQuery('#row_id').val(),
          name : jQuery('#booking_bus_name').val(),
          dni : jQuery('#booking_bus_dni').val(),
          birthday : jQuery('#booking_bus_birthday').val(),
          phone: jQuery('#booking_bus_phone').val(),
          domain : jQuery('#booking_bus_domain').val(),
          postalcode : jQuery('#booking_bus_postalcode').val(),
          locale : jQuery('#booking_bus_locale').val()
        },
        dataType: "html"
      }).done(function( msg ) {
        jQuery('.button-rebuy').show();
        jQuery(this).hide().prop('disabled',true);
        jQuery('#reversed').show();
        jQuery('#edit_btn').show().prop('disabled',false);
        jQuery('.tb-close-icon').click();
      });
    });
    jQuery('#reversed').click(function(event) {
      var order_id = jQuery('#order_id').val();
      var selected = '#'+jQuery('#value_row').val();
      var status = jQuery(selected).attr('status');
      jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=reverse_reserve'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {order_id: order_id}
      })
      .done(function(response) {
        if(response.success == 1){
          jQuery(selected).attr('href','#TB_inline?width=500&height=420&inlineId=modal-window-id');
          jQuery(selected).removeClass("buyed").removeClass("reserved");
          jQuery(selected).addClass('avaliable');
          jQuery('.tb-close-icon').click();
          jQuery(selected).attr('status','avaliable');
        }
      });

    });
    jQuery('.button-rebuy').click(function(){
      jQuery('.button-rebuy').prop('disabled', true);
      var selected = '#'+jQuery('#value_row').val();
      var status = jQuery(selected).attr('status');
      if(status=="avaliable") {
        //////////////////////////////
        var viaje_id = jQuery('#viaje_id').val();
        var price = jQuery('#booking_bus_price').val()
        var name = jQuery('#booking_bus_name').val();
        var dni = jQuery('#booking_bus_dni').val();
        var birthday = jQuery('#booking_bus_birthday').val();
        var phone = jQuery('#booking_bus_phone').val();
        var domain = jQuery('#booking_bus_domain').val();
        var postalcode = jQuery('#booking_bus_postalcode').val();
        var locale = jQuery('#booking_bus_locale').val();
        var value_a = jQuery('#value_row').val();
        var button = jQuery(this).attr('id');
        console.log(price);
        var request_reserve = jQuery.ajax({
          url: '<?= admin_url('admin-ajax.php?action=get_request_reserve'); ?>',
          type: "POST",
          data: {
            viaje_id : viaje_id,
              price: price,
            status: button,
            name: name,
            dni : dni,
            birthday : birthday,
            phone: phone,
            domain: domain,
            postalcode: postalcode,
            locale : locale,
            value: value_a },
          dataType: "html"
        });
        request_reserve.done(function( msg ) {
            jQuery(selected).attr('ident-reserve', msg);
          jQuery(selected).attr('status',button);
          jQuery(selected).attr('href','#');
          jQuery(selected).removeClass("avaliable");
          jQuery(selected).addClass(button);
          jQuery('.tb-close-icon').click();

          jQuery('#booking_bus_name').val('');
          jQuery('#booking_bus_dni').val('');
          jQuery('#booking_bus_birthday').val('');
          jQuery('#booking_bus_phone').val('');
          jQuery('#booking_bus_domain').val('');
          jQuery('#booking_bus_postalcode').val('');
          jQuery('#booking_bus_locale').val('');
          jQuery('#value_row').val('');
          jQuery('.button-rebuy').prop('disabled', false);

        });
      }
    });
</script>
