function submitform(e){
	e.closest('form').submit();
}

$(document).ready(function () {
	var owl = $('.start-month-filter'),
		owlOptions = {
			 autoWidth:true,
			 center: false,
			 loop: false,
			 nav: false,
			 autoplay:false,
			 navText: false,
			 dots: false,
		};
   if ( $(window).width() < 768 ) {
        var owlActive = owl.owlCarousel(owlOptions);
    } else {
        owl.addClass('off');
    }

    $(window).resize(function() {
        if ( $(window).width() < 768 ) {
            if ( $('.start-month-filter').hasClass('off') ) {
                var owlActive = owl.owlCarousel(owlOptions);
                owl.removeClass('off');
            }
        } else {
            if ( !$('.start-month-filter').hasClass('off') ) {
                owl.addClass('off').trigger('destroy.owl.carousel');
                owl.find('.owl-stage-outer').children(':eq(0)').unwrap();
            }
        }
    });


	if($('.form_to_scroll').length > 0){
		var scrollTop = $('.form_to_scroll').offset().top,
			heightHeaderfx = $('.header-top').height();
		$(document).scrollTop(scrollTop - heightHeaderfx);
	}
	var flag = false;
	function sendData(form){
		var val = $(document.activeElement).val();
		if($(document.activeElement).attr('name') == 'DATE[]'){
			if($(document.activeElement).closest('li').hasClass('active')){
				$(form).find('input[type="hidden"][value="'+val+'"]').attr('value', '').remove();	
			}else{
				$(form).append('<input type="hidden" name="DATE[]" value="'+val+'" />')
			}
		}
		flag = true;
		$(form).submit();
		return false;
	}
	$('.form.courses-filter.coursers-line-form').submit(function(e) {
		if(!flag && $(document.activeElement).attr('name') == 'DATE[]'){
			
			e.preventDefault();
			sendData($(this));
			
		}
	});
});
