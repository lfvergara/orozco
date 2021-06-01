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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div   class="section-14-box wow fadeIn">
      <div class="col-md-12">
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
    </div>
</article>
