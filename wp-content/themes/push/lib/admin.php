<?php
//: lib/admin.php ://

//: Genesis ://
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );
remove_theme_support( 'genesis-seo-settings-menu' );
remove_theme_support( 'genesis-admin-menu' );

remove_theme_support( 'genesis-inpost-layouts' );

genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

remove_action( 'admin_menu', 'genesis_add_inpost_scripts_box' );

//: Wordpress ://
add_filter( 'edit_post_link', '__return_false' );
add_filter('widget_text', 'do_shortcode');

add_action( 'widgets_init', 'ck_unregister_genesis_widgets', 20 );
function ck_unregister_genesis_widgets() {
	unregister_widget( 'Genesis_eNews_Updates' );
	unregister_widget( 'Genesis_Featured_Page' );
	unregister_widget( 'Genesis_Featured_Post' );
	unregister_widget( 'Genesis_Latest_Tweets_Widget' );
	unregister_widget( 'Genesis_Menu_Pages_Widget' );
	unregister_widget( 'Genesis_User_Profile_Widget' );
	unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
//    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}

add_action( 'genesis_admin_before_metaboxes', 'ck_remove_genesis_theme_metaboxes' );
function ck_remove_genesis_theme_metaboxes( $hook ) {
	remove_meta_box( 'genesis-theme-settings-version',    $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-feeds',      $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-layout',     $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-header',     $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', 	      $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-breadcrumb', $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-comments',   $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-posts',      $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-blogpage',   $hook, 'main' );
	remove_meta_box( 'genesis-theme-settings-scripts',    $hook, 'main' );
    
	remove_meta_box( 'genesis-seo-settings-doctitle', $hook, 'main' );
	remove_meta_box( 'genesis-seo-settings-homepage', $hook, 'main' );
	remove_meta_box( 'genesis-seo-settings-dochead',  $hook, 'main' );
	remove_meta_box( 'genesis-seo-settings-robots',   $hook, 'main' );
	remove_meta_box( 'genesis-seo-settings-archives', $hook, 'main' );
}

add_action( 'admin_bar_menu', 'ck_admin_bar_remove_menu_items', 99 );
function ck_admin_bar_remove_menu_items( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );
}

add_action( 'admin_bar_menu', 'ck_admin_bar_add_push_link', 1 );
function ck_admin_bar_add_push_link( $wp_admin_bar ) {
    $args = array(
        'id'    => 'push-logo',
        'title' => sprintf( '<span class="ab-icon" style="margin-right:0"><img style="height:26px;width:20px;opacity:0.6;" src="%s"></span>', ck_push_icon_data_url() ),
        'href'  => 'http://pushdigital.com',
        'meta'  => array( 
            'target'    => '_blank',
        ),
    );
    $wp_admin_bar->add_node( $args );
}

add_action( 'admin_menu', 'ck_remove_menus' );
function ck_remove_menus(){
    global $menu;
   remove_menu_page( 'edit-comments.php' );
    
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
}

add_action( 'wp_dashboard_setup', 'ck_disable_dashboard_widgets' );
function ck_disable_dashboard_widgets() {

    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );
}

add_filter( 'admin_footer_text', 'ck_admin_footer_text' );
function ck_admin_footer_text() {
//     echo '<p style="float:right">Powered by <a href="http://pushdigital.com" target="_blank">Push Digital</a></p>';
    remove_filter( 'update_footer', 'core_update_footer' );
}

add_action( 'login_head', 'ck_custom_admin_logo' );
function ck_custom_admin_logo()
{
    echo '<style type="text/css">
        body {
       
            background-color: #f3f3f3 !important;
        }
        h1 a {
       
            background-image:url(' . get_stylesheet_directory_uri() . '/assets/images/logo.png)!important;
            width: 320px !important;
            height: 138px !important;
            background-size: 320px 138px !important;
            background-position: center top !important;
            margin: 0 auto !important;
        }
    </style>';
}

?>