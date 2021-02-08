<?php get_header(); ?>
<div id="primary" <?php astra_primary_class(); ?>>

	<?php real_block('estate-list'); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
