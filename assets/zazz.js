( function( $ ) {

	//Homepage Featured Carousel
	$( '.h-home-carousel' ).find( '.h-unslider' ).unslider( {
		autoplay: true,
		speed: 700,
		delay: 3000
	} );

	if ( $( window ).width() > 800 ) {

		//Latest News Marquee
		$( '.h-latest-news' ).find( '.h-unslider' ).unslider( {
			autoplay: true,
			speed: 1500,
			delay: 6000
		} );

		//Homepage Category Carousels
		$( '.h-carousel-row.h-unslider').unslider( {
			autoplay: true,
			speed: 700,
			delay: 6000, 
			nav: false,
			arrows: {
				prev: '<a class="unslider-arrow prev"><i class="fa fa-chevron-circle-left"></i></a>',
				next: '<a class="unslider-arrow next"><i class="fa fa-chevron-circle-right"></i></a>',
			}
		} );
	}

} )( jQuery );