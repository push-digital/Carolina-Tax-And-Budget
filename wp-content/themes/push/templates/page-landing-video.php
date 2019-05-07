<?php
/**
 *  Template Name: Landing - Video
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 ) ;

remove_action( 'genesis_header', 'genesis_do_nav' );

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

add_action( 'genesis_before', 'pd_before_landing_video' );
function pd_before_landing_video() {

    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    remove_action( 'genesis_entry_header', 'pd_entry_header_thumbnail', 11 );

    remove_action( 'genesis_entry_footer', 'pd_entry_footer' );
    
    
    add_action( 'genesis_entry_header', 'ck_entry_header_logo' );
    
    add_action( 'genesis_entry_footer', 'ck_entry_enter_site', 10 );
}

//remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'ck_genesis_loop_video_area', 1 );
//add_action( 'genesis_loop', 'genesis_do_loop' );
function ck_genesis_loop_video_area() {
    $youtube_id = get_field( 'youtube_video_id' );
    $title = get_field( 'video_title' );
    
    echo '<div class="video-section">';
        echo '<div class="video-wrap">';
            echo sprintf( '<h1 class="video-title">%s</h1>', $title );
            echo do_shortcode( sprintf( '[youtube id="%s"]', $youtube_id ) );
        echo '</div>';
    echo '</div>';
}

function ck_entry_header_logo() {
    echo sprintf( '<a href="%s"><img src="%s/assets/images/logo.png"></a>', get_home_url(), get_stylesheet_directory_uri() );
}

function ck_entry_enter_site() {
    echo sprintf( '<a class="button enter-site" href="%s">Continue to Site</a>', get_home_url() );
}

add_action( 'wp_enqueue_scripts', 'ck_enqueue_landing_style' );
function ck_enqueue_landing_style() {
    wp_enqueue_style( 'landing-video', get_stylesheet_directory_uri() . '/assets/css/landing-video.css' );
}

genesis();