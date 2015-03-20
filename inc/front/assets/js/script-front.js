jQuery( function() {

	jQuery( 'body' ).prepend( social_tabs_html );

	jQuery( 'body' ).find( '.opes-wp-social-tabs ul.social-tabs li' ).hover( 
		function() {
			var this_tab = this;

			var slide_id = jQuery( this_tab ).attr( 'id' );


			jQuery( '.opes-wp-social-tabs' ).find( 'ul.social-sliders li' ).each( function( i , el ) {
				if ( jQuery( el ).attr( 'id' ) == slide_id+'-slide' ) {
					jQuery( el ).css( { display: 'block' } );
				} else {
					jQuery( el ).css( { display: 'none' } );
				}
			});

			//console.log( slide_id+'-slide' );
		}
	);

	jQuery( 'body' ).find( '.opes-wp-social-tabs' ).hover( 
		function() {
			var this_tabs = this;

			jQuery( this_tabs ).find( 'ul.social-sliders' ).stop().animate( {left: '-360'} , { duration: 800 , easing: "swing" } );
			//console.log( 'hover' );
		},
		function() {
			var this_tabs = this;

			jQuery( this_tabs ).find( 'ul.social-sliders' ).stop().animate( {left: '0'} , { duration: 400 , easing: "swing" } );
			//console.log( 'unhover' );
		}
	);

/*
	jQuery( '.jdvu-wrap > a.counting' ).live( 'click' , function(e) {

		e.preventDefault();
		e.stopPropagation();

		//alert( 'ok' );

		var reklama_id = jQuery( this ).data( 'countedid' );

		var data = {
			action: 'jdvu_counter',
			reklama_id: reklama_id
		};

		jQuery.ajax({
			url: jdvu_ajaxurl,
			data: data,
			cache: false,
			timeout: 10000,
			type: 'POST',
			dataType: 'html',
			success: function( data ){
				console.log( data );
			},
			error: function( data ){
				console.log( 'błąd' );
			}
		});

		return false;
	});
*/
});