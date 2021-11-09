$(document).ready(function(){
	getmobileBg('.banner-slider .slide[data-mobilebg]');
	$(window).resize(function(){
		getmobileBg('.banner-slider .slide[data-mobilebg]')	
	});
});
var getmobileBg = function(elem){
	$(elem).each(function(){
		$(this).attr('data-desktopbg', $(this).css('background-image'));
		if($(window).width() < 768){
			console.log('1');
			if($(this).css('background-image') != $(this).data('mobilebg')){
				$(this).css('background-image', $(this).data('mobilebg'));
			}
		}else{
			console.log('2');
			if($(this).css('background-image') != $(this).data('desktopbg')){
				$(this).css('background-image', $(this).data('desktopbg'));
			}
		}
	})
};