<?php
/**
 * The template for displaying all pages
 * Template Name: Woo Commerce Integration
 *
 *
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
$quality_construction_designlayout = get_post_meta(get_the_ID(), 'quality_construction_sidebar_layout', true  );
get_header(); ?>

    <section id="inner-title" class="inner-title no-background">
        <div class="container">
            <div class="row">
                <div class="col-md-8"><h2><?php the_title(); ?></h2></div>
                <?php
                if ($quality_construction_breadcrump_option == "enable") {
                    ?>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <?php breadcrumb_trail(); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section id="section16" class="section16">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 left-block">
                    <?php
                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content-no-image', 'page');


                    endwhile; // End of the loop.
                    ?>
                </div><!-- div -->
                <?php if ($quality_construction_designlayout != 'no-sidebar') { ?>
                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div><!-- div -->
        </div>
    </section>
<script type="text/javascript">
  window.onload = function(){
    jQuery('.woocommerce input.qty').prop('disabled', true);
  }
</script>

<?php get_footer();
