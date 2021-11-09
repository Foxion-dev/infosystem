/* $(document).ready(function(){
	getPopularCourses()
	getClosestCourses();
	$('#coursers-line-form').on('change','select',function(){setTimeout(function(){getPopularCourses();getClosestCourses();},200);});
	$('.nearest-courses').on('click','.bx-pagination a',function(e){
		e.preventDefault();
		var formres_=$('#coursers-line-form').serializeArray();
		var link=this.href;
		$.ajax({
			url:link,
			data:formres_,
			method:'POST',
			success:function(res){
				$('.nearest-courses').find('.container>.row>.col-12').empty();
				$('.nearest-courses').find('.container>.row>.col-12')[0].innerHTML=res;
				$('.info-block')[0].scrollIntoView();
				enableButton();
			}
		});
	})
}) */
function getCoursesReviews(){
	var formres_=$('#coursers-line-form').serializeArray();
	$.ajax({
		url:'/courses/?ajax_coursesReviews=Y',
		data:formres_,
		method:'POST',
		success:function(res){
			$('.reviews.reviews-nofon')[0].outerHTML=res;
		}
	})
}
function getPopularCourses(){
	var formres_=$('#coursers-line-form').serializeArray();
	$.ajax({
		url:'/courses/?ajax_courses=Y',
		data:formres_,
		method:'POST',
		success:function(res){
			$('.popular-coursers.popular-coursers-2').empty();
			$('.popular-coursers.popular-coursers-2')[0].innerHTML=res;
		}
	})
}
function getClosestCourses(){
	var formres_=$('#coursers-line-form').serializeArray();
	$.ajax({
		url:'/courses/?ajax_coursesClosest=Y',
		data:formres_,
		method:'POST',
		success:function(res){
			$('.nearest-courses').find('.container>.row>.col-12').empty();
			$('.nearest-courses').find('.container>.row>.col-12')[0].innerHTML=res;
			enableButton();
		}
	});
}
function enableButton(){ for(var xc = 0;xc<window.b24form.forms.length;xc++) Bitrix24FormLoader.init(window.b24form.forms[xc]);}
function getCoursesList(){
	var formres_=$('#coursers-line-form').serializeArray();
	$.ajax({
		url:'/courses/?ajax_coursesList=Y',
		data:formres_,
		method:'POST',
		success:function(res){
			//$('.nearest-courses').find('.container>.row>.col-12').empty();
			//$('.nearest-courses').find('.container>.row>.col-12')[0].innerHTML=res;
		}
	});
	
}