jQuery(function($){

	// $('.post-listing').append( '<button class="load-more">Load More</button>' );
	// var button = $('.post-listing .load-more');
	var page = 2;
	var loading = false;

	jQuery('body').on('click', '.load-more', function(){
		if( ! loading ) {
			loading = true;
			jQuery(this).remove();
			var data = {
				action: 'be_ajax_load_more',
				page: page,
				query: beloadmore.query,
			};
			$.post(beloadmore.url, data, function(res) {
				if( res.success) {
					jQuery('.post-listing').append( res.data );
					// $('.post-listing').hide().append( res.data ).fadeIn(500); // to have fadeIn effect
					// $('.post-listing').append( button );
					page = page + 1;
					loading = false;
				} else {
					// console.log(res);
				}
			}).fail(function(xhr, textStatus, e) {
				// console.log(xhr.responseText);
			});
		}
	});

});