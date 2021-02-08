<?php

$posts = new WP_Query([
	'post_type'     => 'estate',
	'post_status'   => 'publish',
	'posts_per_page'=> 10,
]);

if ( $posts->post_count ) {
	while ( $posts->have_posts() ) {
		$posts->the_post();
		do_action( 'astra_template_parts_content' );
	}
} else {
    real()->render( 'estate-nothing-found' );
}

wp_reset_postdata();
