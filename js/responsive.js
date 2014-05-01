$(document).ready(function(){
	// HTML markup implementation, overlap mode
	$( '#menu' ).multilevelpushmenu({
		containersToPush: [$( '#pushobj' )],
		menuWidth: '228px',
		menuHeight: '100%'
	});

	var $windowWidth = $(window).width();
	var $width = $windowWidth - 228;
	$('#pushobj').css('width', $width);
});

$(window).resize(function () {
	$( '#menu' ).multilevelpushmenu( 'redraw' );
	var $windowWidth = $(window).width();
	var $width = $windowWidth - 228;
	$('#pushobj').css('width', $width);
});
