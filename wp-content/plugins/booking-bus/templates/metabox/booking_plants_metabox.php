<?php global $htmlHelper; global $bus_configs; global $post; ?>
<?php wp_nonce_field( basename( __FILE__ ), 'booking_plants' ); ?>

<select id="selector_plantas">
  <option selected="selected" value="1">Plana 1</option>
  <option value="2">Plana 2</option>
</select>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#booking_bus_plantas').change(function(){
    change_selector(this)
  });

  function change_selector(selector_plantas){
    if(jQuery(selector_plantas).val()=="2"){
      jQuery('#selector_plantas').show();
    }else{
      jQuery('#selector_plantas').hide();
    }
  }
  change_selector(jQuery('#booking_bus_plantas'));

  jQuery('#selector_plantas').change(function(){
    if(jQuery(this).val()=="2"){
      jQuery('#content_planta_1').hide();
      jQuery('#content_planta_2').show();
    }else{
      jQuery('#content_planta_2').hide();
      jQuery('#content_planta_1').show();
    }
  })
});
</script>
<div id="content_planta_1">
  <h1>Planta 1</h1>
  <table>
    <tbody>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[a_1_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_a_1_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[a_2_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_a_2_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[a_3_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_a_3_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[a_4_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_a_4_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[a_5_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_a_5_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
    </tbody>
  </table>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('#booking_bus_filas').change(function(){
        change_rows(jQuery(this).val());
      });
      change_rows(jQuery('#booking_bus_filas').val());
    });

    function change_rows(selector){
      var row_class = ".plants_row_";
      var limit_row = parseInt(selector);
      var last_row = <?php echo TOTAL_ROW_FILAS ?>;
      for (var i = 1 ; i <= last_row; i++) {
        if(i <= limit_row)
          jQuery('.plants_row_'+i).show();
        else{
          jQuery('.plants_row_'+i).hide();
          jQuery('.plants_row_'+i+' input').val('');
        }

      }
    }
  </script>
</div>
<div id="content_planta_2" style="display:none">
  <h1>Planta 2</h1>
  <table>
    <tbody>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
        <td class="plants_row_<?php echo $value ?>">
          <input class="input_plantas" type="text" name="booking_plants[b_1_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_b_1_'.$value, true ); ?>">
        </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[b_2_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_b_2_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[b_3_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_b_3_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[b_4_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_b_4_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($bus_configs['filas'] as $value): ?>
          <td class="plants_row_<?php echo $value ?>">
            <input class="input_plantas" type="text" name="booking_plants[b_5_<?php echo $value ?>]" value="<?php echo get_post_meta( $post->ID,'booking_plants_b_5_'.$value, true ); ?>">
          </td>
        <?php endforeach; ?>
      </tr>
    </tbody>
  </table>
</div>
