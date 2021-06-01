<div class="wrap">
    <h1 class="wp-heading-inline">Historial de cambios</h1>
    <br>
    <?php if (get_request('showAll') != 'true' && get_request('adminId') == null) { ?>
        Mostrando últimos 500 resultados | <a href='admin.php?page=booking_bus_changes_history&showAll=true'>Mostrar historial completo</a>
    <?php } else if (get_request('adminId') != null) { ?>
        Mostrando los <?php echo sizeof($logs) ?> resultados del usuario <b><?php echo get_userdata(get_request('adminId'))->display_name ?></b> | <a href='admin.php?page=booking_bus_changes_history'>Ver resultados de todos los usuarios</a>
    <?php } else { ?>
    Mostrando todos los <?php echo sizeof($logs) ?> resultados
    <?php } ?>
    <br>
    <br>

    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th># Reserva</th>
                <th>Comprador</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) {
                $descripcion = "";
                $reserva = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}booking_bus_reserveds WHERE id = {$log->reservation_id}");

                $reservaLink = "";
                if ($reserva == null) {
                    $reservaLink = $log->reservation_id;
                }
                else {
                    $reservaLink = "<a href='admin.php?page=booking_bus_report&product_id={$reserva->product_id}&reservation_id={$reserva->id}'>{$log->reservation_id}</a>";}

                switch($log->change_type) {
                    case 'RESERVE':
                        $descripcion = "Realizó la reserva";
                        break;
                    case 'BUY':
                        $descripcion = "Realizó la venta";
                        break;
                    case 'UPDATE':
                        $descripcion = "Editó la reserva";
                        break;
                    case 'DELETE':
                        $descripcion = "Anuló la reserva";
                        break;
                    default:
                        $descripcion = $log->text;
                        break;
                }

                ?>
            <tr>
                <td><?php echo $log->id ?></td>
                <td><?php echo $reservaLink ?></td>
                <td><?php echo ($reserva != null ) ? "<div>".$reserva->name ."</div><div style='font-size: smaller; font-weight: bold'>". $reserva->dni . "</div>" : "No disponible"?></td>
                <td><a href="admin.php?page=booking_bus_changes_history&adminId=<?php echo $log->admin_id ?>"><?php echo get_userdata($log->admin_id)->display_name ?></a></td>
                <td><?php echo $descripcion ?></td>
                <td><?php echo $log->date ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th># Reserva</th>
                <th>Comprador</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>
        </tfoot>
    </table>
</div>