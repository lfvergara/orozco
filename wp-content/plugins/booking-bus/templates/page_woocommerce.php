<?php get_header(); ?>
<?php
  do_action( 'woocommerce_before_main_content' );
?>

  <?php while ( have_posts() ) : the_post(); ?>

    <?php
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly
    }
    ?>

    <?php
    	 do_action( 'woocommerce_before_single_product' );
    	 if ( post_password_required() ) {
    	 	echo get_the_password_form();
    	 	return;
    	 }
    ?>
    <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php	do_action( 'woocommerce_before_single_product_summary' ); ?>
    	<div class="summary entry-summary">
    		<?php	do_action( 'booking_single_product_summary' ); ?>
    	</div><!-- .summary -->
    	<?php	do_action( 'booking_after_single_product_summary' ); ?>
    </div><!-- #product-<?php the_ID(); ?> -->
    <?php do_action( 'woocommerce_after_single_product' ); ?>
  <?php endwhile; // end of the loop. ?>
<?php  do_action( 'woocommerce_after_main_content' ); ?>
<?php  do_action( 'woocommerce_sidebar' ); ?>
<?php get_footer(); ?>
