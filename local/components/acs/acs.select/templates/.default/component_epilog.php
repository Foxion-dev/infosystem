<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
global $USER, $APPLICATION;
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('change','#coursers-line', function(event){
            event.preventDefault();
            var $SECTION_ID = $(this).val();
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?=POST_FORM_ACTION_URI?>",
                data: {go:"AcsSelectList", SECTION_ID:$SECTION_ID},
                success: function(res){
                    closeWait();
                    //console.log(res);
                    if(res.jq){
                        JQ(res.jq);
                        $('select#coursers-line-name').niceSelect();
                    }
                }
            });
            return false;
        });
        $('body').on('change','#coursers-line-name', function(event){
            event.preventDefault();
            var $SECTION_ID = $(this).val();
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?=POST_FORM_ACTION_URI?>",
                data: {go:"AcsSelectListChild", SECTION_ID:$SECTION_ID},
                success: function(res){
                    closeWait();
                    console.log(res);
                    if(res.jq){
                        JQ(res.jq);
                    }
                }
            });
            return false;
        });
        /* info-block-body */
        $('body').on('click','div.info-block-body button.button--primary', function(event){
            event.preventDefault();
            var dataReplace =  $(this).attr('data-replace');
            if(dataReplace){
                window.location.replace(dataReplace);
            }
            return false;
        });
        /**/
        $('body').on('click','a.hide-more', function(event){
            event.preventDefault();
            /*$('#infoBlockMyCrop').hide(300);*/
            $('#infoBlockHide').slideToggle("slow");
            /**/
            $(this).toggleClass("active");
            // проверка существования этого класса если он есть то втыкаем - если нет то +
            if ($(this).hasClass("active")){
                $(this).find('span').replaceWith("<span>Скрыть</span>");
                $(this).find('i').replaceWith('<i class="fa fa-chevron-up" aria-hidden="true"></i>');
            }else{
                $(this).find('span').replaceWith("<span>Подробнее</span>");
                $(this).find('i').replaceWith('<i class="fa fa-chevron-down" aria-hidden="true"></i>');
            }
            return false;
        });
    });
</script>