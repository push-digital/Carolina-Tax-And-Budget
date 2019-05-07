<?php
/**
 * Javascript for Load More
 *
 */
function be_load_more_js() {
	global $wp_query;
	$args = array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'query' => $wp_query->query
	);
	wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '../js/load-more.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'be-load-more', 'beloadmore', $args );
}
add_action( 'wp_enqueue_scripts', 'be_load_more_js' );
add_action( 'genesis_before_loop', 'sk_opening', 20 ); // a high priority of 20 to make this appear below .archive-description
function sk_opening() {
	echo '<div class="post-listing">';
}
add_action( 'genesis_after_loop', 'sk_closing' );
function sk_closing() {
	// echo '</div>';
	echo '<button class="load-more">Load More</button></div>';
}
// Remove Archive Pagination
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
genesis();