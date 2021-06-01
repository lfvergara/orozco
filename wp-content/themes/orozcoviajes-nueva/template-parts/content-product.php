<?php $meta = get_post_meta( get_the_id()); ?>


<?php global $bus_configs; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-7 product-thumb">
			<div class="feature-image">
				<?php if(has_post_thumbnail()):
 				 $image_id = get_post_thumbnail_id();
 				 $image_url = wp_get_attachment_image_src($image_id, 'full', true);
 				 $image_path = $image_url[0];
 				 ?>
 						<img src="<?php echo esc_url($image_url[0]); ?>" width="100%" class="img-responsive wow fadeIn" alt="image">
 				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-5 product-details">
			<h3 class="text-center"><?php the_title() ?></h3>
			<hr>
			<p><?php the_content() ?></p>
			<p>
				<b>Fecha de salida: </b> <?= $meta['booking_bus_fecha_salida'][0] ?>
			</p>
			<p>
				<b>Fecha de retorno:</b> <?= $meta['booking_bus_fecha_retorno'][0] ?>
			</p>
			<p>
				<b>Hora de Salida: </b> <?= $bus_configs['hora'][$meta['booking_bus_capacidad'][0]] ?>
			</p>
			<p>
				<b>Origen: </b> <?= get_the_title($meta['booking_bus_from'][0]) ?>
			</p>
			<p>
				<b>Destino: </b> <?= get_the_title($meta['booking_bus_to'][0]) ?>
			</p>
			<hr>
			<p class="text-center">
				<span class="price">$<?= $meta['_price'][0] ?></span>
			</p>
			<hr>
			<!-- Trigger the modal with a button -->
			<p class="text-center">
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalReserva">Reservar lugar</button>
			</p>

			<!-- Modal -->
			<div id="modalReserva" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Realizar reserva</h4>
			      </div>
			      <div class="modal-body">
					<div class="text-center">
						<?php if(!is_user_logged_in()): ?>
						<br>
						<h2>Contáctenos para mayor información</h2>
						<p>Si desea tener más información de nuestro producto, por favor complete el siguiente formulario.</p>
						<?php echo do_shortcode('[contact-form-7 id="43" title="Formulario de contacto 1"]'); ?>
						<?php else: ?>
						<?php get_template_part('template-parts/booking-bus', get_post_format()); ?>
						<?php endif; ?>
					</div>
			      </div>
			    </div>

			  </div>
			</div>
		</div>
	</div>
</article><!-- #post-## -->
