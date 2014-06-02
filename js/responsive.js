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
	var $windowHeight = $(window).height();
	var $height = $windowHeight - 70;
	$('#pushobj').css('height', $height);
});

$(window).resize(function () {
	$( '#menu' ).multilevelpushmenu( 'redraw' );
	var $windowWidth = $(window).width();
	var $width = $windowWidth - 228;
	$('#pushobj').css('width', $width);
	var $windowHeight = $(window).height();
	var $height = $windowHeight - 70;
	$('#pushobj').css('height', $height);
});
