$(document).ready(function(){
	// HTML markup implementation, overlap mode
	$( '#menu' ).multilevelpushmenu({
		containersToPush: [$( '#pushobj' )],
		menuWidth: '228px',
		menuHeight: '100%'
	});

	var $windowWidth = $(window).width();
	var $width = $windowWidth - 228;
	$('#pushobj>.container').css('width', $width);
	var $windowHeight = $(window).height();
	var $height = $windowHeight - 70;
	$('#pushobj>.container').css('height', $height);
	$('#pushobj>.container form input').addClass('col-xs-12 col-md-3');
});

$(window).resize(function () {
	$( '#menu' ).multilevelpushmenu( 'redraw' );
	var $windowWidth = $(window).width();
	var $width = $windowWidth - 228;
	$('#pushobj>.container').css('width', $width);
	var $windowHeight = $(window).height();
	var $height = $windowHeight - 70;
	$('#pushobj>.container').css('height', $height)
});
