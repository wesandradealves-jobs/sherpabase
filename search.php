<?php
/**
* The template for displaying pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package WordPress
* @subpackage sherpabase
* @since Sherpa Base 1.0
*/
get_header(); ?>
<main>
<?php if ( have_posts() ) : ?>
<?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();

endwhile;
else :
	
endif;
?>
</main><!-- .site-main -->
<?php get_footer(); ?>