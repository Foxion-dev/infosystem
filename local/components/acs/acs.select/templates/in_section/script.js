$(document).ready(function(){
	$('.search-panel-2').on('change','#coursers-line-name',function(){
		getCoursesList();
	});
	$('.nearest-courses').on('click','.bx-pagination a',function(e){
		e.preventDefault();
		var formres_=$('#coursers-line-form').serializeArray(),link=this.href;
        setHistoty(link);
		if(link.indexOf('ajaxCoursesList')>=0){}else{link+='&ajaxCoursesList=Y';}
		$.ajax({
			url:link,
			data:formres_,
			method:'POST',
			success:function(res){
				$('.catalog-section-courses')[0].outerHTML=res;
				//$('.catalog-section-courses')[0].scrollIntoView();
				$('#navigation')[0].scrollIntoView();
				enableButton();
			}
		})
	})
});
$(window).on('popstate', function() {
    location.reload(true);
});

function setHistoty(hist){
    $(window).on('popstate', function() {
        location.reload(true);
    });
    if(hist){
        if (hist.match("ajaxCoursesList=Y$")) {
            var end = hist.replace('?ajaxCoursesList=Y', '');
            window.history.pushState('', '', end);
        }else{
            var end = hist.replace('ajaxCoursesList=Y&', '');
            window.history.pushState('', '', end);
        }
    }
}
function enableButton(){
    if(window.b24form){
        for(var xc = 0;xc<window.b24form.forms.length;xc++) Bitrix24FormLoader.init(window.b24form.forms[xc]);
    }
}
function getCoursesList(){
	var formres_=$('#coursers-line-form').serializeArray();
	$.ajax({
		url:location.pathname+'?ajaxCoursesList=Y',
		data:formres_,
		method:'POST',
		success:function(res){
			$('.catalog-section-courses')[0].outerHTML=res;
			enableButton();
		}
	});
}