( function( $ ) {

	//Latest News Marquee
	$( '.h-latest-news' ).find( '.unslider' ).unslider( {
		autoplay: true,
		speed: 1500,
		delay: 6000
	} );

	//Homepage Featured Carousel
	$( '.h-home-carousel' ).find( '.unslider' ).unslider( {
		autoplay: true,
		speed: 700,
		delay: 3000
	} );

	//Homepage Category Carousels
	$( '.h-carousel-row.unslider').unslider( {
		autoplay: true,
		speed: 700,
		delay: 3000
	} );


	console.log("Great Success!");

} )( jQuery );