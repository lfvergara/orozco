<style>
  body, div, img, p, ul li, span,table, tbody, thead, tr,td {
    font-family: Arial;
    padding: 0px;
    margin: 0px;
    font-size: 12px;
  }
  .wrapper {
    border: 3px solid #000000;
    margin: 20px;
    padding: 20px;
    margin-right: 60px;
  }
  p {
    margin-bottom: 20px;
    text-align: justify;
  }
  .header {
    margin-bottom: 50px;
  }
  .table, .table_data {
    width: 100%
  }
  .table td {
    width: 30%;
    border-bottom: 1px solid rgb(189, 189, 189);
    border-right: 1px solid rgb(189, 189, 189);
    padding: 5px;
  }
  .table_data td {
    width: 33%;
    padding: 5px;
  }
  .table td.first {
    width: 10%
  }
  .description {
    margin: 0 0 50px 0;
  }
</style>
<?php foreach ($reserves_beds as $beds): ?>
<page>
  <div class="wrapper">
    <div class="header" style="text-align: center;">
      <h3 style="margin-bottom: 0px;">OROZCO VIAJES Y TURISMO</h3>
      <span style="margin: 0px; font-size: 9px;">Legajo N° 16.548</span>
      <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg" alt="">-->
    </div>
    <div class="description">
      <table class="table_data">
        <tbody>
          <tr>
            <td><b>Cliente:</b> <?php echo @$beds[0]->name; ?></td>
            <td><b>DNI:</b> <?php echo @$beds[0]->dni; ?></td>
            <td><b>Fecha Nacimiento:</b> <?php echo mysql_a_espanol(@$beds[0]->birthday); ?></td>
          </tr>
          <tr>
            <td><b>Domicilio:</b> <?php echo @$beds[0]->locale; ?></td>
            <td><b>Email:</b> <?php echo @$beds[0]->email; ?></td>
            <td><b>Teléfono:</b> <?php echo @$beds[0]->phone; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="description">
      <table class="table">
        <thead>
          <tr>
            <td class="first">Item</td>
            <td>Nombre Y Apellido</td>
            <td>DNI</td>
            <td>Fecha de Nacimiento</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($beds as $row): ?>
          <tr>
            <td class="first">1</td>
            <td><?php echo @$row->name ?></td>
            <td><?php echo @$row->dni ?></td>
            <td><?php echo mysql_a_espanol(@$row->birthday) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="description">
      <p><b>Descripción del Paquete:</b></p>
      <p><?php echo $product->post_title; ?></p>
      <p><?php echo $product->post_content; ?></p>
    </div>
    <h3>TERMINOS Y CONDICIONES</h3>
    <p>SERVICIOS INCLUIDOS: Los precios incluyen sólo los servicios según se mencionen en el voucher entregado.</p>
    <p>DOCUMENTACIÓN: Para los viajes al exterior es necesario atender la legislación vigente en cada caso. Será responsabilidad exclusiva del CLIENTE contar con la documentación personal y familiar que la autoridad migratoria correspondiente exija.</p>
    <p>HOTELES: La calidad y el contenido de los servicios prestados por el hotel están determinados por la categoría turística oficial asignada. En el supuesto que LA AGENCIA se viera obligada a cambiar el hotel confirmado debido a la celebración de eventos especiales y/o situaciones fuera de su control, su responsabilidad quedará delimitada a ofrecer un hotel de igual categoría o superior.  Las habitaciones contratadas son de tipo standard, salvo especificación escrita al respecto. Los pasajeros registrados en este voucher se alojaran en la misma habitación doble, triple o cuádruple según corresponda.</p>
    <p>RESERVA: Los paquetes y tours deberán reservarse con el pago de un TREINTA (30 %) por ciento del valor total de los mismos.</p>
    <p>ANULACIONES DEL CLIENTE Y/O CANCELACION DEL VIAJE: En todo momento EL CLIENTE puede anular los servicios solicitados o contratados NO teniendo derecho a la devolución del importe abonado. En caso de suspensión del viaje por parte de la agencia el cliente tiene derecho a devolución total del importe abonado en concepto de reserva. </p>
    <br>
    <br>
    <p style="text-align:center">Firma del Pasajero</p>
    <p style="text-align:center">Apóstol San Pablo 2246-Bº Consejo de Abogados</p>
  </div>
</page>
<?php endforeach; ?>
