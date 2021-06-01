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

<?php get_footer();
