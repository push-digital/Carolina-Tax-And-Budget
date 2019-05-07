<?php
//: lib/theme.php ://

//: Genesis ://
add_theme_support( 'html5' );
remove_action( 'genesis_comments', 'genesis_do_comments' );

add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ), 'secondary' => __( 'Footer Navigation Menu', 'genesis' ) ) );


add_action( 'wp_head', 'pd_theme_styles' );
function pd_theme_styles() {
    $formText = get_field('form_submit_text_color', 'options');
    $formBG = get_field('form_submit_bg', 'options');
    $formHText = get_field('form_hover_submit_text_color', 'options');
    $formHBG = get_field('form_hover_submit_bg', 'options');
    $brandColor = get_field('brand_color', 'options');
    $headerBG = get_field('header_bg_color', 'options');
    $footerBG = get_field('footer_bg_color', 'options');
    $footerDiscColor = get_field('footer_disc_color', 'options');
    $footerDiscWeight = get_field('footer_disc_weight', 'options');
  	?>
  	
  	<style type="text/css">
        .site-header > .wrap {
          background-color:<?php echo $headerBG; ?>;
        }
        .site-footer {
          background-color:<?php echo $footerBG; ?>;
        }
        .site-footer .disclaimer {
          color:<?php echo $footerDiscColor; ?>;
          border:1px solid <?php echo $footerDiscColor; ?>;
          font-weight: <?php echo $footerDiscWeight; ?>;
        }
        .entry-form button,
        .entry-form input[type="button"],
        .entry-form input[type="reset"],
        .entry-form input[type="submit"],
        .entry-form .button,
        .entry-content .entry-form .button {
          background-color:<?php echo $formBG; ?>;
          border:2px solid <?php echo $formBG; ?>;
          color:<?php echo $formText; ?>;
          font-weight: 700;
          line-height: 47px;
        }
        .entry-form button:hover,
        .entry-form input:hover[type="button"],
        .entry-form input:hover[type="reset"],
        .entry-form input:hover[type="submit"],
        .entry-form .button:hover,
        .entry-content .entry-form .button:hover {
          background-color:<?php echo $formHBG; ?>;
          border:2px solid <?php echo $formHText; ?>;
          color:<?php echo $formHText; ?>;
        }
        .social-wrap .sl-container li a,
        .home .site-header .genesis-nav-menu a {
          /*background-color:<?php echo $brandColor; ?>;*/
          /*color:#fff;*/

        }
        .social-wrap .sl-container li a:hover,
        .home .site-header .genesis-nav-menu a:hover {
          /*background-color:#fff;*/
          /*color:<?php echo $brandColor; ?>;*/
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .news-header, .entry-title, .widget-title, .header-links .wrap li a  {
          color:<?php echo $brandColor; ?>;
        }
        .header-links .wrap li a:hover {
          background-color:<?php echo $brandColor; ?>;
        }
    </style>
    <?php
}

// add_filter( 'genesis_pre_get_option_site_layout', 'ck_genesis_do_layout' );
function ck_genesis_do_layout( $option ) {
    if ( get_field( 'layout' ) == 'full-width' ) {
        $option = 'full-width';
    }
    else {
        $option = 'content-sidebar';
    }
    echo $option;
//    if ( is_home() || is_front_page() || is_category() || is_archive() )
//        $option = 'full-width-content';
//    else $option = 'content-sidebar';
    return $option;
}

add_action( 'genesis_meta', 'ck_viewport_meta_tag_output' );
function ck_viewport_meta_tag_output() {
 echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">';
}

add_filter( 'theme_page_templates', 'ck_remove_genesis_page_templates' );
function ck_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

//: Search Form ://
//* Do NOT include the opening php tag shown above. Copy the code shown below.
add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );
/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function theme_menu_extras( $menu, $args ) {
	//* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
	if ( 'primary' !== $args->theme_location )
		return $menu;
	//* Uncomment this block to add a search form to the navigation menu

	ob_start();
	get_search_form();
	$search = ob_get_clean();
	$menu  .= '<li class="menu-item menu-item-type-search">' . $search . '</li>';

	//* Uncomment this block to add the date to the navigation menu
	/*
	$menu .= '<li class="right date">' . date_i18n( get_option( 'date_format' ) ) . '</li>';
	*/
	return $menu;
}
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
   return esc_attr( 'Search...' );
}
//: Yoast SEO ://

add_filter( 'wpseo_metabox_prio', '__return_null');

//: Gravity Forms ://

add_filter( 'gform_init_scripts_footer', '__return_true' );

add_filter( 'gform_confirmation_anchor', create_function( '', 'return true;' ) );
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    return -1;
}

add_filter( 'gform_field_css_class', 'ck_gform_field_custom_type_class', 10, 3 );
function ck_gform_field_custom_type_class( $classes, $field, $form ) {
    if ( is_admin() ) return $classes;
    $classes .= sprintf( ' gfield_%s', esc_attr( $field->type ) );
    if ( $field['inputMask'] && $field['inputMaskValue'] == '99999' )
        $classes .= ' gfield_zip';
    if ( isset( $field['size'] ) ) $classes .= ' ' . $field['size'];
    return $classes;
}

add_filter( 'gform_notification', 'change_notification_email', 10, 3 );
function change_notification_email( $notification, $form, $entry ) {
    if ( $notification['name'] == 'Admin Notification' ) {
        return null;
    }
    return $notification;
}

//: Wordpress ://
//add_filter( 'excerpt_length', 'ck_excerpt_length' );
function ck_excerpt_length( $length ) {
	return 35;
}

add_filter('excerpt_more', 'ck_get_read_more_link');
add_filter( 'the_content_more_link', 'ck_get_read_more_link' );
function ck_get_read_more_link() {
    return '...';
}

//: Theme ://
add_action( 'wp_enqueue_scripts', 'ck_enqueue_scripts' );
function ck_enqueue_scripts() {
    wp_enqueue_script( 'slicknav', get_stylesheet_directory_uri() . '/assets/js/jquery.slicknav.min.js', array( 'jquery' ), false, true  );
	wp_enqueue_script( 'functions', get_stylesheet_directory_uri() . '/assets/js/jquery.functions.js', array( 'jquery' ), false, true );
}


//: Slick Slider ://
add_action( 'wp_enqueue_scripts', 'slick_slider_scripts' );
function slick_slider_scripts() {
    wp_enqueue_script( 'slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), false, true  );
}



add_filter( 'genesis_favicon_url', 'ck_favicon_url' );
function ck_favicon_url() {
    return get_field( 'favicon', 'option' ) ? get_field( 'favicon', 'option' ) : '';
}

add_action( 'after_setup_theme', 'ck_after_theme_setup_image_sizes' );
function ck_after_theme_setup_image_sizes() {
  add_image_size( 'featured-image', 1020, 510, true );
  add_image_size( 'home-featured-image', 712, 263, true );
}

//add_filter( 'body_class', 'ck_body_classes' );
function ck_body_classes( $classes ) {
    if ( is_page() ) {
        $classes[] = 'page-' . sanitize_html_class( substr( basename( get_page_template() ), 0, -4 ) );
    }
	return $classes;
}

//: ACF Option Pages ://


if ( function_exists( 'acf_add_options_page' ) ):

acf_add_options_page( array(
    'page_title'    => 'Theme Settings',
    'menu_slug'     => 'theme_settings',
    'capability'    => 'manage_options',
    'position'      => '25.1',
    'icon_url'      => ck_push_icon_data_url(),
) );

endif;
//: Sidebars ://

unregister_sidebar( 'header-right' );
//add_theme_support( 'genesis-footer-widgets', 3 );


genesis_register_sidebar( array(
	'id'          => 'sidebar',
	'name'        => __( 'Sidebar', 'ck' ),
	'description' => __( 'This is the primary site sidebar.', 'ck' ),
) );


//: Scripts ://

add_action( 'wp_head', 'ck_header_scripts' );
function ck_header_scripts() {
    $code = get_field( 'header_scripts', 'option' );
    if ( !have_rows( 'header_scripts', 'option' ) ) return;
    while ( have_rows( 'header_scripts', 'option' ) ): the_row();
    echo "\n";
    the_sub_field( 'script' );
    echo "\n";
    endwhile;
}

add_action( 'wp_footer', 'ck_footer_scripts' );
function ck_footer_scripts() {
    $code = get_field( 'footer_scripts', 'option' );
    if ( !have_rows( 'footer_scripts', 'option' ) ) return;
    while ( have_rows( 'footer_scripts', 'option' ) ): the_row();
    echo "\n";
    the_sub_field( 'script' );
    echo "\n";
    endwhile;
}

//: Facebook ://
add_action( 'wp_head', 'ck_print_facebook_init' );
function ck_print_facebook_init() {
    if ( !get_field( 'facebook_id', 'option' ) ) return;
    echo '<script>window.fbAsyncInit = function(){FB.init({appId: \'' . get_field( 'facebook_id', 'option' ) . '\', status: true, cookie: true, xfbml: true });};(function(d, debug){var js, id = \'facebook-jssdk\', ref = d.getElementsByTagName(\'script\')[0];if(d.getElementById(id)) {return;}js = d.createElement(\'script\'); js.id = id; js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));function postToShare(url){var obj = {method: \'share\',href: url};function callback(response){}FB.ui(obj, callback);}</script>' . "\n";
}

?>
