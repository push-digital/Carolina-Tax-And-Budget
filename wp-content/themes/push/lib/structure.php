<?php
//: lib/structure.php ://

//: Header ://

add_filter( 'genesis_seo_title', 'ck_title_logo', 9, 3 );
function ck_title_logo( $title, $inside, $wrap ) {
    $logo = get_field( 'logo', 'option' ) ? sprintf( '<a href="%s"><img class="logo" src="%s"></a>', get_home_url(), get_field( 'logo', 'option' ) ) : '';
    $inside = sprintf( '<a href="%s" title="%s">%s</a>', get_home_url(), esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );
    return sprintf( '%s<%2$s class="site-title">%3$s</%2$s>', $logo, $wrap, $inside );
}

remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 11 );


add_action( 'genesis_header', 'ck_social_buttons', 10 );
function ck_social_buttons() {
	?>
	
	<div class="social-wrap">
		
		<?php if ( have_rows( 'social_links', 'option' ) ): ?>
			<ul class="s-container sl-container">
			<?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
				<li><a href="<?php the_sub_field( 'link' ) ?>" target="_blank"><?php the_sub_field( 'icon' ) ?></a></li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	
	</div>
	
	<?php
}

function ck_footer_social_buttons() {

?>

<div class="social-wrap">
	<?php if ( have_rows( 'social_links', 'option' ) ): ?>
	
		<ul class="s-container sl-container">
			
			<?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
				<li><a href="<?php the_sub_field( 'link' ) ?>" target="_blank"><?php the_sub_field( 'icon' ) ?></a></li>
			<?php endwhile; ?>
			
			
			<?php if( get_field('use_donation_link', 'option') ): ?>
				<li><a style="border-right:1px solid #c2c2c2" href="<?php echo the_field('donation_url', 'option') ?>"><i class="fa fa-money"></i></a></li>
			<?php endif; ?>
		</ul>
		
	<?php endif; ?>
</div>

<?php
}

//: Inner ://

add_action( 'genesis_before_content_sidebar_wrap', 'pd_site_inner_wrap_open' );
function pd_site_inner_wrap_open() {
    echo '<div class="wrap">';
}

add_action( 'genesis_after_content_sidebar_wrap', 'pd_site_inner_wrap_close' );
function pd_site_inner_wrap_close() {
    echo '</div>';
}





//: Footer ://

remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'ck_footer_menu', 'genesis_do_subnav' );

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'ck_site_footer' );


function ck_site_footer() {	
?>

<div class="one-third first">
	<?php //do_action( 'ck_footer_menu') ?>
	
		<p class="poweredby">
			<a href="/privacy-policy">Privacy Policy</a>
			<?php if ( $use_powered_by = get_field( 'use_powered_by', 'option' )): ?>
				&nbsp;&nbsp;|&nbsp;&nbsp;Powered by <a target="_blank" href="<?php the_field( 'powered_by_link', 'option' ); ?>"><?php the_field( 'powered_by_text', 'option' ); ?></span></a>
			<?php endif; ?>

		</p>
	

	<?php if ( $disclaimer = get_field( 'disclaimer', 'option' ) ): ?>

		<p class="disclaimer"><?php echo $disclaimer ?></p>

	<?php endif; ?>
	<!-- <p class="copyright">All Rights Reserved</p> -->
</div>

<div class="one-third second">
	<img class="footer-logo" src="<?php echo the_field('footer_logo', 'option') ?>" alt="<?php get_bloginfo('name') ?>" />
</div>

<div class="one-third third">
	<div class="footer-icons">
		<?php echo ck_footer_social_buttons() ?>
	</div>
</div>

<?php } ?>