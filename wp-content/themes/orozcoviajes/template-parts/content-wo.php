<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$description_from = quality_construction_get_option( 'quality_construction_blog_excerpt_option');
$description_length = quality_construction_get_option( 'quality_construction_description_length_option');
$readme_text = quality_construction_get_option( 'quality_construction_read_more_text_blog_archive_option');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 col-xs-12 product-list'); $_product = wc_get_product( get_the_ID() ); ?>>
     <div class="section-14-box wow fadeInUp">
             <?php if(has_post_thumbnail()):
               $image_id = get_post_thumbnail_id();
               $image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
               $image_path = $image_url[0];
               ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php echo esc_url($image_url[0]); ?>" width="100%" class="img-responsive wow zoomIn" alt="image">
                </a>
              <?php endif; ?>
              <h3 class="text-center">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
              <p class="text-center middle"><span>Precio: </span>$<?= $_product->get_price(); ?></p>

              <div class="text-center">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php  echo esc_html("Más Información"); ?></a></div>
               <?php
                 wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:','quality-construction'),
                        'after'  => '</div>',
                      ) );
                    ?>
       </div>
  </article><!-- #post-## -->
