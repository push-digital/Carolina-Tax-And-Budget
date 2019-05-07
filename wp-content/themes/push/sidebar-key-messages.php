<?php 
	$useKeyMessages = get_field('use_key_messages');
	$keyBold = get_field('key_message_title_bold');
	$keyRegular = get_field('key_message_title_regular');
	$messages = get_field('key_messages');
?>

<?php if( $useKeyMessages ): ?>	
	
	<div id="key-messages" class="key-messages-wrapper">
		<div class="wrap">
			
			<h2><strong><?php echo $keyBold; ?></strong> <?php echo $keyRegular; ?></h2>
			
			<?php if( have_rows('key_messages') ): ?>
			
				<div class="inner-wrap">
					
					<?php while( have_rows('key_messages') ): the_row(); 
						$icon = get_sub_field('key_message_icon');
						$message = get_sub_field('key_message_text');
					?>
				
						<div class="row align-items-center">
				
							<?php if( $icon ): ?>
								<div class="col-lg-2 col-sm-2 col-3 message-icon">
									<img class="img-fluid message-icon" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt'] ?>" />
								</div>
							<?php endif; ?>
											
							<?php if( $message ): ?>
								<div class="col-lg-10 col-sm-10 col-12">
									<p class="mb-0"><?php echo $message; ?></p>
								</div>
							<?php endif; ?>
				
						</div>
				
					<?php endwhile; ?>
			
				</div>
			
			<?php endif; ?>
					
		</div>
	</div>
	
<?php endif; ?>




<?php /*
	
<div class="key-messages-wrapper">
	<div class="wrap">
		<h2><strong>Key</strong> Messages</h2>
		
		<div class="inner-wrap">
			
			<div class="row align-items-center">
				<div class="col-lg-1 col-sm-2 col-2">
					<img src="https://pushdigitalhosting.com/templates/advocacy/wp-content/uploads/2019/02/icon-placeholder.png" class="img-fluid message-icon" alt="" style=""/>
				</div>
				<div class="col-lg-11 col-sm-10 col-10">
					<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adispcing elit, sed do eusmod tempor incididunt ut labore et dolre magna aliqua.  Ut enim ad minim veniam.</p>
				</div>
			</div>
			
			<div class="row align-items-center">
				<div class="col-lg-1 col-sm-2 col-2">
					<img src="https://pushdigitalhosting.com/templates/advocacy/wp-content/uploads/2019/02/icon-placeholder.png" class="img-fluid message-icon" alt="" style=""/>
				</div>
				<div class="col-lg-11 col-sm-10 col-10">
					<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adispcing elit, sed do eusmod tempor incididunt ut labore et dolre magna aliqua.  Ut enim ad minim veniam.</p>
				</div>
			</div>
			
		</div>
	</div>
</div>

*/ ?>