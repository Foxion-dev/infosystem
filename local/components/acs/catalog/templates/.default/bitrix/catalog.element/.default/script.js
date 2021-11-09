$(document).ready(function(){
    $('.program-event h3').on('click',function(){
      //  $(this).closest('li').find('.program-event-text').toggleClass('hide');
    });
    $('.program-event h3').closest('li').on('click',function(e){
        
        
        if($(e.target)[0].nodeName=='LI'||$(e.target)[0].nodeName=='H3')
        $(this).closest('li').find('.program-event-text').toggleClass('hide');
    });
    if($('.program-event').find('li .program-event-text.hide').length==1){
        $('.program-event').find('li .program-event-text.hide').removeClass('hide');
    }
    dots=false;
    navText=['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'];
     if($('.experts.experts-nofon .slider_ .sliders .slide').length>1){
         dots=true;
     }else{
         dots=false;
         navText=[];
     }
     $('.experts.experts-nofon .slider_ .sliders .slide').closest('div').css('display','inline-block')
     $('.experts.experts-nofon .slider_ .sliders').owlCarousel({
         items: 1,
         center: true,
         loop: true,
         nav: dots,
         autoplay:false,
         navText: navText,
         dots: dots,
        /* animateOut: 'slideOutDown',
         animateIn: 'slideInDown'*/
     });

    $('.experts-items-person-description').each(function(i,e){
        $(e).css('line-height','18px');
        height=0;
        for(var f=0;f<$(e).children().length;f++){
            height+=$($(e).children()[f]).height();
        }
        if(height>300){
            $(e).addClass('more');
        }
        if($(e).hasClass('more')){
            
            if(($($(e).children()[0]).height()+14)>75){
                var height = 18*3;
                $($(e).children()[0]).height(height);
                $($(e).children()[0]).css('overflow','hidden');
            }
            $($(e).children()[1]).css('opacity','0');
        }
    })
})