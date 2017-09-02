// Use react for this.
	( function( $ ) {
		function viewscreenURL( canonical ) {
			return canonical + '?viewscreen=1';
		}

		var $links = $( '.m-viewer .links a' );
		var $viewscreen = $( '.m-viewer .viewscreen' );

		$viewscreen.attr( 'src', viewscreenURL( $links.first().attr( 'href' ) ) );

		$links.on( 'mouseenter click', function( evt ) {
			evt.preventDefault();

			if ( $( this ).hasClass('active') ) {
				return;
			}

			$viewscreen.attr( 'src', viewscreenURL( $( this ).attr( 'href' ) ) );
			$links.removeClass( 'active' );
			$( this ).addClass( 'active' );
			$links.find( '.arrow' ).remove();
			var arrow_size = ( $( this ).height() + ( parseInt( $( this ).css( 'padding' ) ) * 2 ) ) / 2;
			$( this ).append( '<div class="arrow" style="border-top-width: ' + arrow_size + 'px; border-bottom-width: ' + arrow_size + 'px"></div>' );
		} ); 

		$links.first().trigger( 'mouseenter');
	} )( jQuery );
