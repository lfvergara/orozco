<?php
/**
 * The template for displaying all pages
 * Template Name: Inicio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chiavassa Pablo
 * @subpackage Quality Construction
 */
?>
<!-- Slider home -->
<div id="owl-slider-home" class="owl-carousel owl-theme wow fadeIn">
  <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-home/slider1.jpg" alt="Orozco Viajes">
  </div>
  <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-home/slider2.jpg" alt="Orozco Viajes">
  </div>
  <!--
  <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-home/slider3.jpg" alt="Orozco Viajes">
  </div>
  <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-home/slider4.jpg" alt="Orozco Viajes">
  </div>
  -->
</div>
<!-- Quienes somos -->
<div class="quienes-somos-home wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titulos-secciones">
          <h2>
            Quienes somos
          </h2>
        </div>
      </div>
      <div class="col-md-10 col-md-offset-1">
        <p>
          Somos una empresa riojana con más de 20 años de experiencia que presta servicios de Agencia de viajes y transporte de pasajeros de manera eficiente, responsable, rápida, segura y confortable.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Comunicate con nosotros -->
<div class="comunicate-home wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h3><i class="fa fa-phone" aria-hidden="true"></i> (0380) 467 9738</h3>
      </div>
      <div class="col-md-4">
        <h3><i class="fa fa-envelope" aria-hidden="true"></i> orozcoevt@gmail.com</h3>
      </div>
      <div class="col-md-4">
        <h3><i class="fa fa-phone" aria-hidden="true"></i> (0380) 476 1020</h3>
      </div>
    </div>
  </div>
</div>
<!-- MODALES -->
<!-- Modal -->
<div id="Formula1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">FÓRMULA 1 2019</h4>
      </div>
      <div class="modal-body">
        <p>
          FORMULA 1<br>
          GP BRASIL 2019<br>
          CUPOS LATAM<br>
          DESDE CÓRDOBA<br>
          03 NOCHES<br><br>
          Aéreo Córdoba / San Pablo / Córdoba<br>
          Traslado regular aeropuerto / hotel / aeropuerto<br>
          03 noches de alojamiento<br>
          03 días de traslado regular al autodromo (no incluye entradas)<br>
          Asistencia al viajero AC15<br>
          Kit Formula 1 (Protectores de oído, capa de lluvia y mochila)<br><br>

          Nota: Las entradas al autodromo no están incluidas.(Entrada es 3 días: viernes, sabado y domingo).<br><br>
           
          -Entradas sector A: USD 292<br>
          -Entradas sector G: USD 219<br>
          -Entradas sector Q: USD 219<br>
          -Entradas sector M: USD 567<br>
          -Entradas sector B: USD 911<br><br>
           
          MENORES DE 5 AÑOS NO PUEDEN INGRESAR AL AUTÓDROMO<br><br>
           
          Tarifas incluyen impuestos aéreos e IVA. No incluyen gastos de gestión.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="Peru-all-inclusive" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PERÚ ALL INCLUSIVE - PUNTA SAL</h4>
      </div>
      <div class="modal-body">
        <p>
          PUNTA SAL - CUPOS LATAM - DESDE CORDOBA - 07 NOCHES<br><br>
          Aéreo Córdoba / Talara / Córdoba<br>
          07 noches de alojamiento con all inclusive<br>
          Traslado Aeropuerto / Hotel / Aeropuerto<br>
          Asistencia al Viajero<br><br>
          Las tarifas de los servicios expresados en este paquete sólo son válidos para esta operación.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Viajes destacados -->
<div class="viajes-destacados-home wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titulos-secciones">
          <h2>
            Viajes destacados
          </h2>
        </div>
      </div>
      <div class="col-md-6">
        <a data-toggle="modal" data-target="#Formula1">
          <img src="<?php bloginfo('template_url'); ?>/assets/images/Formula1-2019.png" alt="Formula 1 2019" class="img-responsive" style="margin-bottom: 30px; cursor: pointer;">
        </a>
      </div>
      <div class="col-md-6">
        <a data-toggle="modal" data-target="#Peru-all-inclusive">
          <img src="<?php bloginfo('template_url'); ?>/assets/images/Peru-all-inclusive.png" alt="Perú all inclusive" class="img-responsive" style="margin-bottom: 30px; cursor: pointer;">
        </a>
      </div>
      <div class="col-md-12">
        <?php if (shortcode_exists ('featured_products')) echo do_shortcode ('[featured_products per_page="4" columns="2"]'); ?>
      </div>
      <div class="col-md-12 text-center">
        <a href="http://orozcoviajes.com/tienda/" class="btn btn-primary">Ver todos los viajes</a>
      </div>
    </div>
  </div>
</div>
<!-- Testimonios -->
<div class="testimonios-home wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titulos-secciones">
          <h2>
            Nuestros clientes dicen
          </h2>
        </div>
      </div>
      <div class="col-md-12">
        <div id="owl-testimonios-home" class="owl-carousel owl-theme wow fadeIn">
          <div class="item">
            <div class="testimonial">
              <h3 class="title">José Luna Bazán</h3>
              <p class="description">
                Realicé un viaje a Valle Hermoso el mes pasado. Realmente excelente el servicio y atención de Orozco. Se cumplió con todo lo prometido. Muy buena coordinadora,muy buen servicio de hotel,hermosas las excursiones,muy buen micro,choferes impecable,los felicito! Da gusto abonar un servicio de tan buena calidad como el suyo!!! Muy agradecido!!!
              </p>
              <ul class="rating">
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
              </ul>
              <br>
              <a href="https://www.facebook.com/jose.luna.73113/posts/1556389814474067:0" target="_blank">Ver opinión</a>
            </div>
          </div>
          <div class="item">
            <div class="testimonial">
              <h3 class="title">Blanca Valeria Valles</h3>
              <p class="description">
                Muy buena empresa!! El coordinador Gabriel excelente!!! Trabajo sin descanso. Muy organizado todo. Viaje a Viñas con Orozco y tuve una muy buena experiencia con esta empresa de turismo!!!
              </p>
              <ul class="rating">
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
              </ul>
              <br>
              <a href="https://www.facebook.com/blancavaleria.valles/posts/10215038922105291:0" target="_blank">Ver opinión</a>
            </div>
          </div>
          <div class="item">
            <div class="testimonial">
              <h3 class="title">Sil Andrada</h3>
              <p class="description">
                Un sueño cumplído. Gracias a la flia Orozco. Los coordinadores César y Gabriel. Los chóferes Gustavo y Cristian y a todo el grupo d viaje q tuve la dicha d conocer y disfrutar... La pase excelente Dios los bendiga a todos y hay q volverrrrrr
              </p>
              <ul class="rating">
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
              </ul>
              <br>
              <a href="https://www.facebook.com/silvanaclaudi/posts/1475541342526340:0" target="_blank">Ver opinión</a>
            </div>
          </div>
          <div class="item">
            <div class="testimonial">
              <h3 class="title">Carmen Esther Alaniz</h3>
              <p class="description">
                Fui a cataratas con la empresa todo exelente los coordinadores chicos muy amables y simpaticos
              </p>
              <ul class="rating">
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
                <li class="fa fa-star"></li>
              </ul>
              <br>
              <a href="https://www.facebook.com/carmenesther.alaniz/posts/1423331241061993:0" target="_blank">Ver opinión</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Ultimas noticias
<div class="ultimas-noticias-home wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titulos-secciones">
          <h2>
            Últimas noticias
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>
-->
<article class="container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="row">
    <div class="col-md-12">
      <?php the_content(); ?>
      <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
          <?php
            edit_post_link(
              sprintf(
                /* translators: %s: Name of current post */
                esc_html__( 'Editar página %s','quality-construction'),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
              ),
              '<span class="edit-link">',
              '</span>'
            );
          ?>
        </footer><!-- .entry-footer -->
      <?php endif; ?>
    </div>
  </div>
</article>
<!-- jQuery -->
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>