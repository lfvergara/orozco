<?php add_thickbox(); ?>
<div class="wrap">
  <div class="top">
    <div class="alignleft actions bulkactions">
      <label for="bulk-action-selector-top" class="screen-reader-text">Selecciona acción en lote</label>
      <select name="action" id="selector-viaje">
        <option value="0">-- Seleccione un Viaje --</option>
        <?php foreach ($products as $p): ?>
          <?php
            $bus_id =  get_post_meta($p->ID ,'booking_bus_bus',true);
            $post_7 = get_post( $bus_id );

            if(TITLE_BUS)
              $title_bus = " ($post_7->post_title)";
            else
              $title_bus = '';
          ?>
          <option value="<?= $p->ID ?>"><?= $p->post_title.$title_bus ?></option>
        <?php endforeach; ?>
      </select>
      <input type="submit" id="doaction" class="button action" value="Mostrar">
    </div>
    <br class="clear">
    <div id="content_bus"></div>
    <script type="text/javascript">
      window.onload = function() {
        jQuery('#doaction').click(function(){

      		var viaje_id = jQuery('#selector-viaje').val();
          var my_action = 'my_test_ajax';
      		var request = jQuery.ajax({
      			url: '<?= admin_url('admin-ajax.php?action=get_bus') ?>',
      			type: "POST",
      			data: { viaje_id : viaje_id },
      			dataType: "html"
      		});
      		request.done(function( msg ) {
      			jQuery( "#content_bus" ).html( msg );
      		});
      	});
      }
    </script>
		<br class="clear">
	</div>
</div>
