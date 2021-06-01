<?php
/**
 * The template for displaying all pages
 * Template Name: Contact Form
 *
 *
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
$quality_construction_designlayout = get_post_meta(get_the_ID(), 'quality_construction_sidebar_layout', true  );
$lat = quality_construction_get_option('quality_construction_lat_option');
$lng = quality_construction_get_option('quality_construction_lon_option');
$key = quality_construction_get_option('quality_construction_key_option');
$zoo = quality_construction_get_option('quality_construction_zoom_option');

get_header(); ?>

    <section id="map" class="wow fadeInUp">
      <div class="container-fluid">
        <div class="row">
          <div class="google-map h450" data-zoom="<?= $zoo ?>" data-lat="<?= $lat ?>" data-lng="<?= $lng ?>"></div>
        </div>
      </div>
    </section>
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

                        get_template_part('template-parts/content-contact', 'page');

                    endwhile; // End of the loop.
                    ?>
                </div>
            </div><!-- div -->
        </div>
    </section>

<?php get_footer();
