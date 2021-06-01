<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$address = quality_construction_get_option( 'quality_construction_address_option');
$phone1 = quality_construction_get_option( 'quality_construction_phone1_option');
$phone2 = quality_construction_get_option( 'quality_construction_phone2_option');
$phone3 = quality_construction_get_option( 'quality_construction_phone3_option');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div   class="section-14-box wow fadeIn">
      <div class="col-md-6">
        <?php the_content(); ?>
        <?php if ( get_edit_post_link() ) : ?>
 					<footer class="entry-footer">
 						<?php
 							edit_post_link(
 								sprintf(
 									/* translators: %s: Name of current post */
 									esc_html__( 'Edit %s','quality-construction'),
 									the_title( '<span class="screen-reader-text">"', '"</span>', false )
 								),
 								'<span class="edit-link">',
 								'</span>'
 							);
 						?>
 					</footer><!-- .entry-footer -->
 				<?php endif; ?>
      </div>
      <div class="col-md-6">
        <h3><strong>Apóstol San Pablo 2246 (Bº Consejo de Abogados), La Rioja</strong></h3>
        <section id="map" class="wow fadeIn">
              <div class="google-map h450" data-zoom="<?= $zoo ?>" data-lat="-29.4381928" data-lng="-66.8653595"></div>
        </section>
        <!--
        <h3>Direcci&oacute;n</h3>
        <p><?= $address ?></p>
        <h3>Tel&eacute;fonos</h3>
        <p>
          <ul>
            <?php if ($phone1): ?><li><?= $phone1 ?></li><?php endif; ?>
            <?php if ($phone2): ?><li><?= $phone2 ?></li><?php endif; ?>
            <?php if ($phone3): ?><li><?= $phone3 ?></li><?php endif; ?>
          </ul>
        </p>
        -->
      </div>
    </div>
</article>
