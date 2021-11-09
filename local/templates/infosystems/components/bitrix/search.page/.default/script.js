$(document).ready(function(){
    $('select#search-category-in').niceSelect();
    $('select.search-category-in').niceSelect();
	var textName = '';
	$('.search-category-in .list .option').each(function(){
		
		if($(this).hasClass('selected')){
			textName = $(this).text();
			$(this).closest('.nice-select').find('.current').text(textName);
		}
	})
})