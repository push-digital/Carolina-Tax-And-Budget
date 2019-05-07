<?php
/**
 *  Template Name: Landing
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 ) ;

remove_action( 'genesis_header', 'genesis_do_nav' );

remove_action( 'genesis_before_footer', 'pd_before_footer_widget_area', 99 );
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );


add_action( 'genesis_before', 'pd_before_landing_simple' );
function pd_before_landing_simple() {

    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    remove_action( 'genesis_entry_header', 'pd_entry_header_thumbnail', 11 );

    remove_action( 'genesis_entry_footer', 'pd_entry_footer' );

    add_action( 'genesis_entry_header', 'ck_entry_header_logo', 10 );
    add_action( 'genesis_entry_header', 'pd_after_header_logo', 11 );

    add_action( 'genesis_entry_footer', 'ck_entry_enter_site', 10 );
}

function ck_entry_header_logo() {
  ?>     <a href="<?php echo get_home_url() ?>"><img src="<?php the_field('logo') ?>" alt=""></a> <?php
    // echo sprintf( '<a href="%s"><img src="%s/assets/images/logo.png"></a>', get_home_url(), get_stylesheet_directory_uri() );
}
function pd_after_header_logo() {
?>
<div class="social-wrap">
<?php if ( have_rows( 'social_links', 'option' ) ): ?>
  <ul class="s-container sl-container">
    <li><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/bar.gif" alt="Spacer" /></li>
  <?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
    <li><a href="<?php the_sub_field( 'link' ) ?>" target="_blank"><?php the_sub_field( 'icon' ) ?></a></li>
  <?php endwhile; ?>
  <li><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/bar.gif" alt="Spacer" /></li>
  </ul>
<?php endif; ?>
</div>
<?php
}


function ck_entry_enter_site() {
    if (is_page('donate')) {
      return;
    } else {
      echo sprintf( '<a class="button enter-site" href="%s">Continue to Site</a>', get_home_url() );
    }
}

// add_action( 'wp_enqueue_scripts', 'ck_enqueue_landing_style' );
function ck_enqueue_landing_style() {
    wp_enqueue_style( 'landing', get_stylesheet_directory_uri() . '/assets/css/landing.css' );
}

// add_action( 'wp_head', 'ck_wp_head_landing' );
function ck_wp_head_landing() {
    $url = wp_get_attachment_url( get_post_thumbnail_id() );
    if ( $url == '' ) return;
    echo '<style type="text/css">';
        echo sprintf( 'body{background-image:url()!important;}.site-inner { background-image:url(%s)!important; }', $url );
    echo '</style>';
}

add_action( 'wp_head', 'pd_landing_styles' );
function pd_landing_styles() {
	?>
	<style type="text/css">
    body { background-color:#fff; }
		.site-inner {
			background-color:<?php the_field( 'background_color' ) ?>;
			background-image:url( <?php the_field( 'background_image' ) ?> );
			background-position: <?php the_field( 'background_position_x' ) ?> <?php the_field( 'background_position_y' ) ?>;
			background-attachment: <?php the_field( 'background_attachment' ) ?>;
		}
		.entry {
			float: <?php the_field( 'layout_float' ) ?>;
			max-width: <?php the_field( 'layout_max_width' ) . the_field( 'layout_max_width_unit' ) ?>;
			margin-top: <?php the_field( 'layout_margin_top' ) . the_field( 'layout_margin_top_unit' ) ?>;
			margin-bottom: <?php the_field( 'layout_margin_bottom' ) . the_field( 'layout_margin_bottom_unit' ) ?>;
			color: <?php the_field( 'entry_font_color' ) ?>;
			background-color: <?php the_field( 'entry_background_color' ) ?>;
			border-radius: <?php the_field( 'border_radius' ) ?>px <?php the_field( 'border_radius' ) ?>px 0 0;
			border-top-color: <?php the_field( 'border_color' ) ?>;
			border-top-width: <?php the_field( 'border_width' ) ?>px;
			border-top-style: solid;
		}
		.entry-content h1,
		.entry-content h2,
		.entry-content h3,
		.entry-content h4,
		.entry-title {
      color: <?php the_field( 'entry_title_color' ) ?>;
		}
    .entry-title {
      font-size: <?php the_field( 'title_size' ) ?>px;
    }
    .entry-form { margin-top: 20px; }
		.entry-form .cta {
			color: <?php the_field( 'entry_font_color' ) ?>;
		}
		.form-cta, .form-cta h3 {
			color: <?php the_field( 'entry_font_color' ) ?>;
		}
    .entry-form button,
    .entry-form input[type="button"],
    .entry-form input[type="reset"],
    .entry-form input[type="submit"],
    .entry-form .button,
    .entry-content .entry-form .button {
      background-color:<?php the_field('form_bg_color'); ?>;
      border:2px solid <?php the_field('form_border_color'); ?>;
      color:<?php the_field('form_text_color'); ?>;
      font-weight: 700;
    }
    .entry-form button:hover,
    .entry-form input:hover[type="button"],
    .entry-form input:hover[type="reset"],
    .entry-form input:hover[type="submit"],
    .entry-form .button:hover,
    .entry-content .entry-form .button:hover {
      background-color:<?php the_field('form_bg_hover_color'); ?>;
      border:2px solid <?php the_field('form_border_hover_color'); ?>;
      color:<?php the_field('form_text_hover_color'); ?>;
    }
    .entry .button {width: 100%;}
	</style>
	<?php
}

remove_action( 'genesis_footer', 'ck_site_footer' );

add_action( 'genesis_footer', 'pd_landing_footer' );
function pd_landing_footer() {
	if ( $disclaimer = get_field( 'disclaimer', 'option' ) ):
	?>
	<p class="disclaimer"><?php echo $disclaimer ?></p>
	<?php
	endif;
}

genesis();
