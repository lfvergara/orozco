<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$copyright = quality_construction_get_option('quality_construction_copyright');
if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) {

    ?>

    <section id="footer-top" class="footer-top wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php } ?>

<div class="container" style="margin-bottom: 30px; margin-top: 30px;">
    <div class="row">
        <div class="col-md-12 text-center">
            <ins class="bookingaff" data-aid="1754399" data-target_aid="1754399" data-prod="banner" data-width="728" data-height="90" data-lang="es">
                <!-- Anything inside will go away once widget is loaded. -->
                    <a href="//www.booking.com?aid=1754399">Booking.com</a>
            </ins>
            <script type="text/javascript">
                (function(d, sc, u) {
                  var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];
                  s.type = 'text/javascript';
                  s.async = true;
                  s.src = u + '?v=' + (+new Date());
                  p.parentNode.insertBefore(s,p);
                  })(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');
            </script>
        </div>
    </div>
</div>

<footer id="footer-bottom" class="footer-bottom wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">

                <ul class="redes-sociales-seguinos">
                    <li><a href="https://www.facebook.com/transporteorozcolarioja/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/orozcoviajes/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>

                <div class="copyright">
                    <a href="https://orozcoviajes.com/terminos-y-condiciones-de-uso/">Términos y condiciones de uso</a> | <a href="https://orozcoviajes.com/politica-de-cookies/">Política de Cookies</a> | <a href="https://orozcoviajes.com/politica-de-privacidad/">Política de Privacidad</a>
                    <br><br>
                    Copyright &copy; <a href="http://orozcoviajes.com">Orozco Viajes y Turismo</a> <?= date('Y') ?> | Diseño de <a href="https://chiavassapablo.com" target="_blank" title="Chiavassa Pablo">Chiavassa Pablo</a>
                </div>

            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script type="text/javascript">
        
    jQuery(document).ready(function($) {
            
        // WOW Animate
        wow = new WOW( {
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 10,
            mobile: false,
              live: true
        } )
        wow.init();

        
        jQuery("#owl-slider-home").owlCarousel( {
            loop: true,
            dots: true,
            responsiveClass: true,
            nav: false,
            autoplay: true,
            margin: 0,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0:{ items:1},
                480:{ items:1},
                768:{ items:1},
                992:{ items:1},
                1170:{ items:1}
            }
        } );

        $("#owl-testimonios-home").owlCarousel( {
            loop: true,
            dots: true,
            responsiveClass: true,
            nav: false,
            autoplay: true,
            margin: 0,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0:{ items:1},
                480:{ items:1},
                768:{ items:1},
                992:{ items:2},
                1170:{ items:3}
            }
        } );

        $('[data-toggle="tooltip"]').tooltip();

    } );
</script>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'HKaEDymwcr';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<div id='jivo_copyright' style='display: none'>Live Chat desarrollado por <a href='https://www.jivochat.es' target='_blank'>JivoChat</a></div>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>
