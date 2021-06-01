<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; global $htmlHelper; global $bus_configs; ?>
<?php $bus = (get_post_meta($meta_total['booking_bus_bus'][0])); ?>
<?php add_thickbox(); ?>
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
      jQuery('.tb-close-icon').click();
    }
    jQuery('#close-action').click(function(){
      reset_edit_report();
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
        jQuery('#booking_bus_birthday').val(message.birthday);
        jQuery('#booking_bus_phone').val(message.phone);
        jQuery('#booking_bus_domain').val(message.domain);
        jQuery('#booking_bus_postalcode').val(message.postalcode);
        jQuery('#booking_bus_locale').val(message.locale);
        jQuery('#value_row').val(message.id);
        console.log(message);
      });
    });
    jQuery('#do_createbed').click(function() {
      var d = new Date();
      jQuery('#container_beeds').prepend('<div class="droppable_bed sortable_el"><div class="row_bed"><input type="text" placeholder="Habitación" value="Hab. '+(d.getTime())+'"></div></div>');
      _dropables();
    });
    jQuery('#do_vouches').click(function() {
      var product_id = jQuery('#product_id').val();
      window.open("<?= admin_url('admin-ajax.php?action=booking_bus_vouches&product_id='); ?>"+product_id,"_blank");
    });
    jQuery('#do_reserve').click(function() {
      var product_id = jQuery('#product_id').val();
      window.open("<?= admin_url('admin.php?page=booking_bus_report&product_id='); ?>"+product_id,"_self");
    });
    jQuery(".single_no_bed").draggable({helper: 'clone'});
    _dropables();
    function _dropables() {
      jQuery(".droppable_bed").droppable({
        accept: ".single_no_bed",
        drop: function(ev,ui){
          load_container();
          var ident = ui.draggable.attr('data-ident');
          var value= jQuery(this).find('input').val();
          if(jQuery(this).children().length > 4) {
            load_container(false);
            return false;
          } else {
            jQuery(ui.draggable).appendTo(this);
            update_record(ident, value);
          }
        }
      });
      jQuery( ".sortable_el" ).sortable();
      jQuery( ".sortable_el" ).disableSelection();
    }

    function update_record(ident, value) {
      var request_reserve = jQuery.ajax({
        url: '<?= admin_url('admin-ajax.php?action=update_record_bed'); ?>',
        type: "POST",
        data: {
          id : ident,
          value: value },
        dataType: "html"
      });
      request_reserve.done(function( msg ) {
        load_container(false);
      });
    }

    function load_container( set = true ){
      if(set){
        jQuery('#loader_container').show();
      }else{
        jQuery('#loader_container').hide();
      }
    }
    jQuery('#container_beeds').find('input').change(function(){
      load_container();
      var el = jQuery(this);
      var value = el.val();
      var idents = '';
      el.parent().parent().find('.single_no_bed').each(function( index ) {
        if(idents != '')
          idents = idents + ';';
        idents = idents + jQuery(this).attr('data-ident');
      });
      update_record(idents, value);
    })
    jQuery("#bed_simple").droppable({
      accept: ".single_no_bed",
      drop: function(ev,ui){
        load_container();
        var ident = ui.draggable.attr('data-ident');
        var value = '';
        jQuery(ui.draggable).prependTo(this);
        update_record(ident, value);
      }
    });
  }
</script>


<div class="wrap">
  <h1 class="wp-heading-inline">Administrar Habitaciones</h1>
  <br><br>
  <div class="top">
    <div class="alignleft actions bulkactions">
      <form class="<?= $actual_link ?>" method="get">
        <label for="bulk-action-selector-top" class="screen-reader-text">Selecciona acción en lote</label>
        <input type="hidden" name="page" value="<?= @$_GET['page'] ?>">
        <select name="product_id" id="product_id">
          <option value="">-- Seleccione un Viaje --</option>
          <?php foreach ($products as $p): ?>
            <option  <?= ($product_id==$p->ID)?'selected="selected"':''; ?>  value="<?= $p->ID ?>"><?= $p->post_title ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" id="doaction" class="button action" value="Mostrar">
        <input type="button" id="do_reserve" class="button action" value="Reporte">
        <input type="button" id="do_vouches" class="button action" value="Descargar Vouches">
      </form>
    </div>
    <br><br><br>
  <?php if ( $product_id != '' ): ?>
  <div>
    <h3>Habitaci&oacute;n no asignada</h3>
    <div id="bed_simple" class="sortable_el">
      <?php if (count($simple_bed)): ?>
      <?php foreach ($simple_bed as $single): ?>
        <div class="single_no_bed" data-ident="<?php echo $single->id ?>">
          <div>(<?= @$bus["booking_plants_".$single->value][0] ?>)</div>
          <div class="name_bed"><?= $single->name ?></div>
          <div><?= $single->dni ?></div>
        </div>
      <?php endforeach; ?>
      <?php endif; ?>
      <div class="clear"></div>
    </div>
    <br class="clear">
    <h3>Habitaciones</h3>
    <div style="margin-bottom:20px">
      <input type="button" id="do_createbed" class="button action" value="Crear Habitaci&oacute;n">
    </div>
    <div id="container_beeds">
      <?php foreach ($reserves_beds as $bk => $bv): ?>
        <div class="droppable_bed sortable_el">
          <div class="row_bed">
            <input type="text" placeholder="Habitación" value="<?php echo $bk ?>">
          </div>
          <?php foreach ($bv as $single): ?>
            <div class="single_no_bed" data-ident="<?php echo $single->id ?>">
              <div>(<?= @$bus["booking_plants_".$single->value][0] ?>)</div>
              <div class="name_bed"><?= $single->name ?></div>
              <div><?= $single->dni ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
		<br class="clear">
	</div>
  <?php endif; ?>
</div>
<div id="loader_container" class="text-center"><i class="fa fa-gear fa-spin align-middle"></i></div>
