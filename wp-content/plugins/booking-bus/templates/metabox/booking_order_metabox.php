<?php global $htmlHelper; global $bus_configs; ?>


<?php wp_nonce_field( basename( __FILE__ ), 'booking_bus' ); ?>
<?php foreach ($personales as $personal): $viaje = get_post($personal->product_id); ?>
  <?php
    $tmp = get_post_meta($personal->product_id);
    $bus = get_post_meta($tmp['booking_bus_bus'][0]);
  ?>
  <h3>Producto: <?= $viaje->post_title ?></h3>
  <h4>Asiento: <?= @$bus['booking_plants_'.$personal->value][0] ?></h4>
<table>
  <tbody>
    <tr>
      <td>
        <label for="Domicilio:">Nombre y Apellido:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->name; ?>">
      </td>
      <td>
        <label for="Domicilio:">DNI:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->dni; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="Domicilio:">Fecha de Nacimiento:</label>
        <input type="date" readonly="readonly" disabled="disabled" value="<?= $personal->birthday; ?>">
      </td>
      <td>
        <label for="Domicilio:">Teléfonos:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->phone; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="Domicilio:">Domicilio:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->domain; ?>">
      </td>
      <td>
        <label for="Domicilio:">Código Postal:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->postalcode; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="Domicilio:">Localidad:</label>
        <input type="text" readonly="readonly" disabled="disabled" value="<?= $personal->locale; ?>">
      </td>
      <td>
      </td>
    </tr>
  </tbody>
</table>
<?php endforeach; ?>
