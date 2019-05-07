<?php
/**
 *  
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'pd_do_splash_menu' );

add_action( 'genesis_before', 'pd_splash_genesis_before' );
function pd_splash_genesis_before() {
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
    add_action( 'genesis_entry_footer', 'pd_entry_content_splash_enter_site' );
}

function pd_entry_content_splash_enter_site() {
    echo '<div class="enter-site">';
        echo sprintf( '<a class="button" href="%s">Enter Site</a>', get_home_url() );
    echo '</div>';
}

function pd_do_splash_menu() {
    $defaults = array(
        'menu'            => 7,
        'container_class' => 'nav-splash',
        'menu_class'      => 'menu genesis-nav-menu',
    );

    wp_nav_menu( $defaults );
}

add_action( 'genesis_before_content_sidebar_wrap', 'pd_splash_background', 0 );
function pd_splash_background() {
    $background_url = get_post_meta( get_the_id(), 'background_url', true );
    if ( $background_url == '' ) return;
    echo sprintf( '<img class="splash-background" src="%s">', $background_url );
}

//add_action( 'wp_head', 'pd_splash_wp_head_style' );
function pd_splash_wp_head_style() {
    $background_url = get_post_meta( get_the_id(), 'background_url', true );
    if ( $background_url == '' ) return;
    echo '<style type="text/css">';
    echo sprintf( 'body.splash .site-inner{background-image:url(%s);}', $background_url );
    echo '</style>';
}

add_filter( 'genesis_attr_content', 'pd_splash_content_attributes' );
function pd_splash_content_attributes( $attributes ) {
    $attributes['class'] .= ' feature';
    return $attributes;
}
 
genesis();