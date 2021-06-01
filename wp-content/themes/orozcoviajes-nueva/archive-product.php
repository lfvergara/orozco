<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */

$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
$quality_construction_designlayout = quality_construction_get_option('quality_construction_sidebar_layout_option');
get_header();
?>
    <section id="inner-title" class="inner-title no-background">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Reservas</h2>
                </div>
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
                <div class="col-md-12 left-block">
                    <div class="row">
                        <?php if (have_posts()) :
                          while (have_posts()) : the_post();
                            get_template_part('template-parts/content-wo', get_post_format());
                          endwhile;
                          the_posts_navigation();
                        endif;
                        ?>
                    </div>
                </div>
            </div><!-- div -->
        </div>
    </section>
<?php get_footer();
