<?php
/**
 * Dynamic css
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('quality_construction_dynamic_css') ):
    function quality_construction_dynamic_css(){

    $quality_construction_top_header_color = esc_attr( quality_construction_get_option('quality_construction_top_header_background_color') );

    $quality_construction_top_footer_color = esc_attr( quality_construction_get_option('quality_construction_top_footer_background_color') );

    $quality_construction_bottom_footer_color = esc_attr( quality_construction_get_option('quality_construction_bottom_footer_background_color') );

    $quality_construction_primary_color = esc_attr( quality_construction_get_option('quality_construction_primary_color') );


    $custom_css = '';


    /*====================Dynamic Css =====================*/
    $custom_css .= ".top-header{
         background-color: " . $quality_construction_top_header_color . ";}
    ";

    $custom_css .= ".footer-top{
         background-color: " . $quality_construction_top_footer_color . ";}
    ";

    $custom_css .= ".footer-bottom{
         background-color: " . $quality_construction_bottom_footer_color . ";}
    ";


    $custom_css .= ".section-0-background,
     .btn-primary,
     .section-1-box-icon-background,
     .section-14-box .date,
     #quote-carousel a.carousel-control,
     .section-10-background,
     .footer-top .submit-bgcolor,
     .nav-links .nav-previous a, 
     .nav-links .nav-next a,
     .comments-area .submit,
     .inner-title{
         background-color: " . $quality_construction_primary_color . ";}
    ";

    $custom_css .= ".section-4-box-icon-cont i,
    .btn-seconday,
    a:visited{
        color: " . $quality_construction_primary_color . ";}
    ";

    $custom_css .= ".section-14-box .underline,
   .item blockquote img,
   .widget .widget-title,
   .btn-primary,
   #quote-carousel .carousel-control.left, 
   #quote-carousel .carousel-control.right{
        border-color: " . $quality_construction_primary_color . ";}
    ";
    /*------------------------------------------------------------------------------------------------- */

    /*custom css*/

    wp_add_inline_style('quality-construction-style', $custom_css);

}
endif;
add_action('wp_enqueue_scripts', 'quality_construction_dynamic_css', 99);