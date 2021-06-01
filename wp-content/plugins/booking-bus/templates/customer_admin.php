<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; global $htmlHelper; global $bus_configs; ?>
<?php $bus = (get_post_meta($meta_total['booking_bus_bus'][0])); ?>
<?php add_thickbox(); ?>
<div id="modal-window-editor" style="display:none;">
    <h1>Datos De Reserva/Venta</h1>
    <div class="booking-bus-modal">
      <table>
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
        </tbody>
      </table>
      <input type="hidden" id="value_row">
      <input type="text" id="actual_dni">
      <div style="text-align:center;">
        <input type="button" id="close-action" class="button-rebuy button action" value="Cerrar">&nbsp;
        <input type="button" id="save_action" class="button-rebuy button action" value="Guardar">
      </div>
    </div>
</div>
<script type="text/javascript">
  window.onload = function(){
    function reset_edit_report(){
      jQuery('#booking_bus_name').val('');
      jQuery('#booking_bus_dni').val('');
      jQuery('#booking_bus_birthday').val('');
      jQuery('#booking_bus_phone').val('');
      jQuery('#booking_bus_domain').val('');
      jQuery('#booking_bus_postalcode').val('');
      jQuery('#booking_bus_locale').val('');
      jQuery('#value_row').val('');
      jQuery('#actual_dni').val('');
      jQuery('.tb-close-icon').click();
    }
    jQuery('#close-action').click(function(){
      reset_edit_report();
    });
    jQuery('#save_action').click(function(){
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=set_reserve_customer'); ?>',
        type: "POST",
        data: {
          id : jQuery('#value_row').val(),
          name : jQuery('#booking_bus_name').val(),
          dni : jQuery('#booking_bus_dni').val(),
          actual_dni : jQuery('#actual_dni').val(),
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

    jQuery('a.thickbox').click(function(){
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
        jQuery('#actual_dni').val(message.dni);
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


<div class="wrap">
  <h1 class="wp-heading-inline">
    Administrar Clientes
    <label class="busqueda" for="">
      Buscar:
      <input type="text" id="search_str" placeholder="...">
    </label>
  </h1>
  <br><br>
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
  <table id="table_customer" class="wp-list-table widefat fixed striped posts">
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
        <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
      </tr>
    </thead>
    <?php if (count($rows)): ?>
    <tbody id="the-list">
      <?php foreach ($rows as $single): ?>
        <tr id="post-<?php echo $single['id'] ?>" class=" status-publish hentry">
          <th scope="row" class="check-column"> </th>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['name'] ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['dni'] ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo mysql_espanol($single['birthday']); ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['phone'] ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['domain'] ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['postalcode'] ?> </td>
          <td class="name column-name has-row-actions column-primary"><?php echo $single['locale'] ?></td>
          <td class="order_actions column-order_actions" data-colname="Acciones">
            <p>
              <a title="Modificar" ident="<?php echo $single['id'] ?>" href="#TB_inline?width=500&height=420&inlineId=modal-window-editor" class="hvr-grow thickbox button tips editable" data-order="<?php echo $single->order_id ?>">Editar</a>
            </p>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <?php else: ?>
      <tr id="post-106" class=" status-publish hentry">
        <td colspan="12" style="text-align:center;"class=" name column-name has-row-actions column-primary"><strong>No se han encontrado resultados</strong></td>
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
        <th scope="col" class="manage-column"><span class=" tips">Acciones</span></th>
      </tr>    </tfoot>

  </table>
</div>
<div id="loader_container" class="text-center"><i class="fa fa-gear fa-spin align-middle"></i></div>
