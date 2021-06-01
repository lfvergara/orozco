<?php
/**
 * The template for displaying all pages
 * Template Name: Empresa
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chiavassa Pablo
 * @subpackage Quality Construction
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');

get_header(); ?>

<section id="inner-title" class="inner-title no-background">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2><?php the_title(); ?></h2></div>
            <?php
            if ($quality_construction_breadcrump_option == "enable") {
                ?>
                <div class="col-md-12">
                    <div class="breadcrumbs">
                        <?php breadcrumb_trail(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Slider empresa -->
<div class="container" style="margin-top: 80px; margin-bottom: 60px;">
  <div class="row">
    <div class="col-md-6">
      <div id="owl-slider-home" class="owl-carousel owl-theme wow fadeIn">
          <div class="item">
              <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-empresa/slider1.jpg" alt="Orozco Viajes">
          </div>
          <div class="item">
              <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-empresa/slider2.jpg" alt="Orozco Viajes">
          </div>
          <div class="item">
              <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-empresa/slider3.jpg" alt="Orozco Viajes">
          </div>
          <div class="item">
              <img src="<?php bloginfo('template_url'); ?>/assets/images/slider-empresa/slider4.jpg" alt="Orozco Viajes">
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <p style="font-size: 18px; color: #666; font-weight: 300; margin-top: 15px;">
        Somos una empresa riojana con más de 20 años de experiencia que presta servicios de Agencia de viajes y transporte de pasajeros de manera eficiente, responsable, rápida, segura y confortable.
        <br><br>
        Poseemos unidades propias las cuales se encuentran habilitadas a nivel nacional e internacional.
        <br><br>
        Disponemos de los recursos logísticos y humanos necesarios para satisfacer sus necesidades y exigencias. Nuestros vehículos son climatizados para garantizar su comodidad y confort. Asimismo, nuestros conductores se encuentran adecuadamente capacitados. De esta manera, brindamos una atención amable y un servicio confiable.
      </p>
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


<!-- jQuery -->
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>

<?php get_footer(); ?>