<?php global $htmlHelper; global $bus_configs; ?>

<?php wp_nonce_field( basename( __FILE__ ), 'booking_bus' ); ?>
<table>
  <tbody>
    <tr>
      <td>
        <?php $htmlHelper->create_dropdown_by_post('bus','Bus:',$buses) ?>
      </td>
      <td>
        <?php $htmlHelper->create_dropdown('capacidad','Hora de Salida:',$bus_configs['hora']) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $htmlHelper->create_picker('fecha_salida','Fecha de Salida:') ?>
      </td>
      <td>
        <?php $htmlHelper->create_picker('fecha_retorno','Fecha de Retorno:') ?>

      </td>
    </tr>
    <script type="text/javascript">
      window.onload = function() {
        jQuery( ".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
      }
    </script>
    <tr>
      <td>
        <?php $htmlHelper->create_dropdown_by_post('from','Ciuda Origen:',$cities) ?>
      </td>
      <td>
        <?php $htmlHelper->create_dropdown_by_post('to','Ciudad Destino:',$cities) ?>
      </td>
    </tr>
  </tbody>
</table>
