<script type="text/javascript">
    jQuery(document).ready(function(){
    	jQuery('.home-testimonial').slick({
        	infinite: true,
			lazyLoad: 'ondemand',
			dots: true,
			speed: 1500,
			fade: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 3000,
			slidesToShow: 1,
			slidesToScroll: 1
    	});
    });
</script>



<?php
	$bgColor = get_field( 'testimonial_bgColor' );
	$testimonials = get_field( 'repeater_testimonials' );
?>

<?php if( get_field('add_testimonials') ): ?>


	<div class="testimonials pt-5 pb-5 text-center" style="background-color: <?php echo $bgColor ?>;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-11 col-md-12">
					<i class="fa fa-2x fa-quote-left"></i>
						
					<?php if( have_rows( 'repeater_testimonials' ) ): ?>
					
					<div class="home-testimonial">
					  <?php while( have_rows( 'repeater_testimonials' ) ): the_row(); 
						$quote = get_sub_field('testimonial_quote' );
						$regular = get_sub_field('testimonial_regular_text' );
						$italic = get_sub_field('testimonial_italic_text' );
					  ?>
					
						<div>
							<blockquote class="blockquote text-center mb-0">
							
								<p class="mb-3"><?php echo $quote ?></p>
								
								<?php if( $italic ): ?>
									<footer class="blockquote-footer">
										<?php if( $regular ): ?>
											<?php echo $regular; ?>
										<?php endif; ?>
										
										<cite title="Source Title"><i><?php echo $italic; ?></i></cite>
									</footer>
								<?php endif; ?>
								
							</blockquote>
						</div>
						
						
						<?php endwhile; ?>
						
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php endif; ?>



			
<?php /*
	
	
<div class="home-testimonial">
	<div>
		<blockquote class="blockquote text-center mb-0">
		
			<p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			<footer class="blockquote-footer"> <cite title="Source Title">John Doe</cite></footer>
		
		</blockquote>
	</div>
	
	<div>
		<blockquote class="blockquote text-center mb-0">
		
			<p class="mb-3">Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Jane Dough</cite></footer>
		
		</blockquote>
	</div>
	
	<div>
		<blockquote class="blockquote text-center mb-0">
		
			<p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Jane Dough</cite></footer>
		
		</blockquote>
	</div>
	
</div>


</div>
</div>
</div>
</div>

*/ ?>