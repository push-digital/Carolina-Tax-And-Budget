<?php
/**
* Template Name: Home Template
 
*/

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

add_action( 'genesis_after_header', 'pd_after_header_hero_section' );

function pd_after_header_hero_section() {

?>


<?php get_sidebar('hero'); ?>


<?php get_sidebar('key-messages'); ?>


<?php

}

add_action( 'genesis_before_footer', 'above_footer_cta' );

function above_footer_cta() {
	$afctaBGImg = get_field('afctaBGImg');
	$afctaImg = get_field('afctaImg');
	$afctaTitle = get_field('afctaTitle');
	$afctaTitleColor = get_field('afctaTitleColor');
	$afctaDescColor = get_field('afctaDescColor');
	$afctaDesc = get_field('afctaDesc');
	$afctaButtonText = get_field('afctaButtonText');
	$afctaLink = get_field('afctaLink');
	$afctaPageLink = get_field('afcta_page_link');
?>

<?php get_sidebar('testimonials'); ?>



<div class="widget info-widget" style="background-image:url(<?php echo $afctaBGImg ?>)">
	<div class="widget-wrap wrap">
		<div class="image">
			<img src="<?php echo $afctaImg ?>">
		</div>
		
		<div class="text">
			<h1 style="color:<?php echo $afctaTitleColor ?>" class="title"><?php echo $afctaTitle ?></h1>
			<p style="color:<?php echo $afctaDescColor ?>" class="description"><?php echo $afctaDesc ?></p>
			<a class="button" href="<?php echo $afctaLink ?>"><?php echo $afctaButtonText ?></a>
			<!-- <a class="button" href="<?php echo $afctaPageLink ?>"><?php echo $afctaButtonText ?></a> -->
		</div>
	</div>
</div>


<?php
}

add_action( 'genesis_after_header', 'pd_after_header_social_links_2' );
function pd_after_header_social_links_2() {
	
?>



<div class="header-links d-none">
	<div class="wrap">
    	<?php if( have_rows('menu_items') ): ?>
			<ul>
				<?php while( have_rows('menu_items') ): the_row();
					// vars
					$title = get_sub_field('title');
					$useLink = get_sub_field('use_url');
					$tweet = get_sub_field('is_twitter');
					$link = get_sub_field('url');
					$page = get_sub_field('link_to_page');
					$useIcon = get_sub_field('use_icon');
					$iconClass = get_sub_field('icon');
					$linkClass = get_sub_field('link_class');
					$defaultTweet = get_field('default_twitter_message','option');
				?>
			
				<li><a href="<?php if($useLink)  { echo $link; } else { echo $page; } ?>" <?php if ($tweet) { ?>data-text="<?php echo $defaultTweet; } ?>" class="<?php echo $linkClass; ?>"><?php if($useIcon) { echo $iconClass; } ?> <?php echo $title; ?></a></li>
        
				<?php endwhile; ?>
			</ul>
			
		<?php endif; ?>
    </div>
</div>



<?php
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'ck_front_page_loop' );




function ck_front_page_loop() {
    // if ( get_query_var('paged') ) {
    //     $paged = get_query_var('paged');
    // }
    // elseif ( get_query_var('page') ) {
    //     $paged = get_query_var('page');
    // } else {
    //     $paged = 1;
    // }
    
    $args = array(
    	'category__in'      => get_field( 'home_feed_category' ),
		'posts_per_page'    => 12
		// 'paged'             => $paged,
		// 'order'             => 'DESC',
		// 'orderby'           => 'date'
    );
    

    echo '<h3 class="news-header">';
    
    echo get_field('news_header_title');
    echo '</h3>';
    global $wp_query;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
            do_action( 'genesis_before_entry' );
            printf( '<article %s>', genesis_attr( 'entry' ) );
                do_action( 'ck_entry_thumbnail', 'home-featured-image' );
                do_action( 'genesis_entry_header' );
                // do_action( 'genesis_entry_content' );
            echo '</article>';
            do_action( 'genesis_after_entry' );
        endwhile;
    endif;

    wp_reset_query();
}



/* OLD BELOW */
// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

if ( get_field( 'hero_layout' ) ):

// add_action( 'genesis_before', 'ck_before_home_page' );
function ck_before_home_page() {
	if ( get_field( 'hide_entry_title' ) ) {
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
        remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	}

}


add_action( 'wp_head', 'ck_wp_head_style' );
function ck_wp_head_style() {

?>

<style type="text/css">
	.site-inner {
		/*background-color:<?php the_field( 'background_color' ) ?>;*/
		/*background-image:url(<?php the_field( 'background_image' ) ?>);*/
		/*background-position: <?php the_field( 'background_position_x' ) ?> <?php the_field( 'background_position_y' ) ?>;*/
		/*background-attachment: <?php the_field( 'background_attachment' ) ?>;*/
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
	.entry-title {
		font-size: <?php the_field( 'title_size' ) ?>px;
	}
	.entry-form .cta {
		color: <?php the_field( 'entry_font_color' ) ?>;
	}
	.form-cta, .form-cta h3 {
		color: <?php the_field( 'entry_font_color' ) ?>;
	}
	
    .home .hero .form-wrap.wrap {
      left: <?php the_field( 'home_form_left_pos' ) ?>%;
      bottom: <?php the_field( 'home_form_bottom_pos' ) ?>%;
    }
    input.gform_button.button {
      background-color:<?php the_field('form_bg'); ?>;
      border:2px solid <?php the_field('form_border'); ?>;
      color:<?php the_field('form_text'); ?>;
      font-weight: 700;
      /*border-radius: 6px;*/
    }
    
    input.gform_button.button:hover {
      background-color:<?php the_field('form_bg_hover'); ?>;
      border:2px solid <?php the_field('form_border_hover'); ?>;
      color:<?php the_field('form_text_hover'); ?>;
    }
    
    .widget.info-widget:after {
		content: '';
		background: <?php the_field('afctaBGImgOverlay'); ?>;
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 100%;
		z-index: 0; 
	}
    
</style>

<?php
}

add_filter( 'body_class', 'ck_page_body_classes' );
function ck_page_body_classes( $classes ) {
	$classes[] = 'float-' . get_field( 'layout_float' );

	if ( get_field( 'hide_form' ) )
		$classes[] = 'no-form';

	if ( get_field( 'hide_entry_title' ) )
		$classes[] = 'no-title';

	if ( get_field( 'hide_share_buttons' ) )
		$classes[] = 'no-share';

	if ( !get_field( 'show_enter_site_button' ) )
		$classes[] = 'no-enter';

	if ( get_field( 'background_position_x' ) == 'left' )
		$classes[] = 'background-left';

	if ( get_field( 'background_position_x' ) == 'right' )
		$classes[] = 'background-right';

	if ( get_field( 'background_position_y' ) == 'top' )
		$classes[] = 'background-top';

	if ( get_field( 'background_position_y' ) == 'bottom' )
		$classes[] = 'background-bottom';

	return $classes;
}

endif;

genesis();