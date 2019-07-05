$(document).ready(function() {
	$('.pic a').imgPreview({
    containerID: 'imgPreviewWithStyles',
    srcAttr: 'rel',
    imgCSS: {
        
    }, 
    onHide: function(link){
        $('span', this).remove();
    }
	});
	$('ul#photos').innerfade({
		speed: 2000,
		timeout: 7000,
		type: 'sequence',
		containerheight: '285px'
	});
});