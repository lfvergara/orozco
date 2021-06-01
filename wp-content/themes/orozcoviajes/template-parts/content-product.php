<?php $meta = get_post_meta( get_the_id()); ?>


<?php global $bus_configs; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-3 col-sm-6 product-thumb">
			<div class="feature-image">
				<?php if(has_post_thumbnail()):
 				 $image_id = get_post_thumbnail_id();
 				 $image_url = wp_get_attachment_image_src($image_id, 'full', true);
 				 $image_path = $image_url[0];
 				 ?>
 						<img src="<?php echo esc_url($image_url[0]); ?>" width="100%" class="img-responsive wow zoomIn" alt="image">
 				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-6 product-details">
			<h3><?php the_title() ?></h3>
			<p><?php the_content() ?></p>
			<p><b>Salida: </b> <?= $meta['booking_bus_fecha_salida'][0] ?> <b>Retorno:</b> <?= $meta['booking_bus_fecha_retorno'][0] ?></p>
			<p><b>Hora de Salida: </b> <?= $bus_configs['hora'][$meta['booking_bus_capacidad'][0]] ?></p>
			<p><b>Origen: </b> <?= get_the_title($meta['booking_bus_from'][0]) ?></p>
			<p><b>Destino: </b> <?= get_the_title($meta['booking_bus_to'][0]) ?></p>
			<p><span class="price">$<?= $meta['_price'][0] ?></span></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
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
</article><!-- #post-## -->
