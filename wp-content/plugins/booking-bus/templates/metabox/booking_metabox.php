<?php global $htmlHelper; global $bus_configs; ?>

<?php wp_nonce_field( basename( __FILE__ ), 'booking_bus' ); ?>
<table>
  <tbody>
    <tr>
      <td>
        <?php $htmlHelper->create_input('dominio','Domicilio:') ?>
      </td>
      <td>
        <?php $htmlHelper->create_input('nromotor','Nro Motor:') ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $htmlHelper->create_input('nrochasis','Nro Chasis:') ?>
      </td>
      <td>
        <?php $htmlHelper->create_dropdown('capacidad','Capacidad:',$bus_configs['asientos']) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $htmlHelper->create_input('nrointerno','Nro Interno:') ?>
      </td>
      <td>
        <?php $htmlHelper->create_dropdown('plantas','Plantas:',$bus_configs['plantas']) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $htmlHelper->create_dropdown('filas','Filas:',$bus_configs['filas']) ?>
      </td>
      <td>
      </td>
    </tr>
  </tbody>
</table>
