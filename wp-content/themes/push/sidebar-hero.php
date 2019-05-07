<?php 
	$pad_top = get_field('hero_pad_top');
	$pad_bottom = get_field('hero_pad_bottom');
	$align_box = get_field('hero_align_textbox');
	$text_align = get_field('hero_textbox_align_text');
	$button_link = get_field('hero_textbox_button_link');
	$button_text = get_field('hero_textbox_button_text');
	$bg_image = get_field('background_image');
	$bg_color = get_field('background_color');
?>

<div class="hero-wrapper" style="background-image:url(<?php echo $bg_image; ?>); background-size: cover; background-position: center center; display: flex; margin-top: 95px; padding-top: <?php echo $pad_top; ?>rem; padding-bottom: <?php echo $pad_bottom; ?>rem; background-color: <?php echo $bg_color; ?>;">
	<div class="container hero-inner">
		<div class="row justify-content-<?php echo $align_box; ?>">
    		<div class="col-lg-<?php the_field( 'hero_text_width' ) ?> col-md-auto">
	    		<div class="text-wrap <?php echo $text_align; ?> " style="background: <?php the_field( 'text_background_color' ) ?>; padding: <?php the_field( 'hero_textbox_padding_top_bot' ) ?>rem <?php the_field( 'hero_textbox_padding_left_right' ) ?>rem;"> 		
		    		<?php if( get_field('hero_line_1_c') ): ?>	
						<h1 style="color:<?php the_field( 'hero_line_1_c' ) ?>; font-size:<?php the_field( 'hero_line_1_s' ) ?>px;">
							<?php the_field( 'hero_line_1' ) ?>
						</h1>
					<?php endif; ?>
					
					<?php if( get_field('hero_line_2_c') ): ?>	
						<p style="color:<?php the_field( 'hero_line_2_c' ) ?>; font-size:<?php the_field( 'hero_line_2_s' ) ?>px;">
							<?php the_field( 'hero_line_2' ) ?>
						</p>
					<?php endif; ?>
					
					
					<?php if( get_field('add_button') ): ?>	
						<a class="btn btn-primary" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
					<?php endif; ?>
					
					<?php if( get_field('use_front_page_form') ): ?>
						<?php gravity_form( get_field('front_page_form')['id'], false, false ) ?>
					<?php endif; ?>	
	    		</div>
    		</div>
    	</div>
	</div>
</div>

	
<?php /* Old Hero */ ?>

<?php /*

<div class="hero">
	<div class="wrap">
		<img src="<?php the_field( 'background_image' ); ?>" alt="" />
	</div>
    
    <div class="form-wrap wrap">
    	<div class="gform-container">
			<h1 style="color:<?php the_field( 'hero_line_1_c' ) ?>; font-size:<?php the_field( 'hero_line_1_s' ) ?>px;"><?php the_field( 'hero_line_1' ) ?></h1>
			<p style="color:<?php the_field( 'hero_line_2_c' ) ?>; font-size:<?php the_field( 'hero_line_2_s' ) ?>px;"><?php the_field( 'hero_line_2' ) ?></p>
			<?php gravity_form( get_field('front_page_form')['id'], false, false ) ?>
    	</div>
	</div>
</div>

*/ ?>