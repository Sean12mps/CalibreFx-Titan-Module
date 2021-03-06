jQuery( document ).ready( function ( $ ) {


	$( window ).on( 'titan::build', function () {

		var toggleUI = $( '<span></span>', {
			'text' : '',
			'class' : 'titan-toggle-ui dashicons dashicons-arrow-down-alt2'
		} );
		
		$( '.cfx_titan-post-meta-heading' ).append( toggleUI );
	} );


	$( window ).on( 'titan::manipulate', function () {

		$( '.set_actions' ).hide();

		$.each( $( '.set_actions' ), function( index, val ) {

			var chk = $( val ).find( 'input[type=checkbox]' );

			if ( $( chk ).is( ':checked' ) ) {

				var separator = $( '<div></div>', {
					'class' : 'separator'
				} );

				$( val ).before( separator );
			}
		} );
	} );


	$( window ).on( 'titan::bindings', function () {

		$( '.cfx_titan-post-meta-heading' ).on( 'click', function () {

			var targets = $( this ).attr( 'toggle' );

			$( this ).toggleClass( 'open' );
			$( '.'+ targets +'' ).toggle( 'fast' );
		} );

	} );



	$( window ).trigger( 'titan::build' );
	$( window ).trigger( 'titan::manipulate' );
	$( window ).trigger( 'titan::bindings' );
} );