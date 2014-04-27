$(document).ready(function(){
	// HTML markup implementation, overlap mode
	$( '#menu' ).multilevelpushmenu({
		containersToPush: [$( '#pushobj' )],
		menuWidth: '228px',
		menuHeight: '100%'
	});
});

$(window).resize(function () {
	$( '#menu' ).multilevelpushmenu( 'redraw' );
});
