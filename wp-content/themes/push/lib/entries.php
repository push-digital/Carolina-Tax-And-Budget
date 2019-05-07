<?php
//: lib/entries.php ://

add_action( 'genesis_before', 'ck_before_entries' );
function ck_before_entries() {
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
    remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	add_action( 'genesis_entry_header', 'ck_entry_header_thumbnail', 3 );
    add_action( 'genesis_entry_footer', 'ck_after_entry_form' );
    add_action( 'genesis_entry_footer', 'ck_entry_footer_social_share' );
		if (is_front_page()) {
			remove_action( 'genesis_entry_footer', 'ck_entry_footer_social_share' );
			add_action( 'genesis_entry_header', 'ck_entry_footer_social_share', 14 );
			// add_action( 'genesis_entry_footer', 'ck_entry_footer_social_share', 1 );
			// add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
			// add_filter('genesis_entry_title', 'pd_fp_title');
			  // add_action( 'genesis_entry_header', 'genesis_post_title', 9 );

		}
		if (is_page_template('templates/page-landing.php')) {
			remove_action( 'genesis_header', 'genesis_do_nav', 11 );
			remove_action( 'genesis_header', 'ck_social_buttons', 10 );
		}
}

function pd_fp_title() {
	// get_the_title
}

function ck_entry_header_thumbnail() {
    if ( !has_post_thumbnail() ) return;

    $size = is_front_page() ? 'home-featured-image' : 'featured-image';
    echo '<div class="entry-thumbnail">';
    if ( !is_single() && !is_page() ) echo sprintf( '<a href="%s">', get_the_permalink() );
        the_post_thumbnail( $size );
    if ( is_single() || ( is_page() && !is_front_page() ) ) echo '</a>';
    echo '</div>';
}

function ck_after_entry_form() {
    if ( get_field( 'hide_form' ) ) return;

    $form = get_field( 'form' );
    $form_cta = get_field( 'form_cta' );

    if ( !$form ) {
        $page_form_options = get_field( 'page_form_options', 'option' );

        if ( is_single() || ( is_page() && $page_form_options == 'post' ) ) {
            $form = get_field( 'default_post_form', 'option' );
            if ( !$form_cta )
                $form_cta = get_field( 'default_post_form_cta', 'option' );
        }
        else if ( is_page() && $page_form_options == 'form' ) {
            $form = get_field( 'default_page_form', 'option' );
            if ( !$form_cta )
                $form_cta = get_field( 'default_page_form_cta', 'option' );
        }
    }


	$form_cta = strip_tags( $form_cta ) == $form_cta ? '<h3>' . $form_cta . '</h3>' : $form_cta;
    if ( $form ) {
        echo '<div class="entry-form">';
            if ( $form_cta )
                echo sprintf( '<div class="form-cta">%s</div>', $form_cta );
            echo gravity_form( $form['id'], false, false );
        echo '</div>';
    }
}

function ck_entry_footer_social_share() {
    if ( get_field( 'hide_share' ) ) return;

    $home = get_field( 'share_home' );

    $permalink = $home ? get_home_url() : get_the_permalink();
    $shortlink = $home ? get_home_url() : wp_get_shortlink();

    $twitter_message = get_field( 'twitter_message' ) && !$home ? ck_encode_twitter( get_field( 'twitter_message' ) ) : get_field( 'default_twitter_message', 'option' );
    $email_subject = get_field( 'email_subject' ) && !$home ? get_field( 'email_subject' ) : get_field( 'default_email_subject', 'option' );
    
    ?>
    
    <div class="entry-share">
    	<ul class="s-container ss-container">
			<li><a class="button ss-fk" href="<?php echo $permalink ?>"><i class="fa fa-facebook-square"></i><span>Share</span></a></li>
			<li><a class="button ss-tr" href="<?php echo $shortlink ?>" data-text="<?php echo $twitter_message ?>"><i class="fa fa-twitter"></i><span>Tweet</span></a></li>
    	</ul>
    </div>

    <?php
}

?>