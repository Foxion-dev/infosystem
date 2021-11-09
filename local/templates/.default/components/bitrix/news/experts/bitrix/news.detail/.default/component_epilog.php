<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм добавления отзыва и т.д.
global $USER, $APPLICATION;
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.experts-post-mail', function (event) {
            event.preventDefault();
            var $go = "expertsPostMail";
            var $title = $(this).text();
            var $hidden = '<input name="EXPERT" type="hidden" value="'+ $(this).attr('data-name') +'">'+ ($(this).attr('rel')?'<input name="BCC" type="hidden" value="'+ $(this).attr('rel') +'">':'');
            /* console.log($(this).attr('data-name'));
            console.log($(this).attr('rel')); */
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var textInput  = '<div class="form-group"><label>Имя:<span class="starrequired">*</span></label><input name="NAME_USER" type="text" class="form-control input-lg req" placeholder="Ваше имя"></div>';
            var textInput0  = '<div class="form-group"><label>Ваш e-mail:<span class="starrequired">*</span></label><input name="EMAIL_USER" type="text" class="form-control input-lg e-mail req" placeholder=""></div>';
            var checkInput  =
            '<div class="form-group">\
            <label class="cbLabel">\
            <input id="sendCopy" type="checkbox" name="sendCopy" class="req" required value="1">\
            <span></span> Нажимая на кнопку «Отправить» я соглашаюсь с <a href="/about/user_agreement/" target="_blank">Пользовательским соглашением</a> и <a href="/about/privacy/" target="_blank">Политикой конфиденциальности</a></label></div>';
            var textInput1  = '<div class="form-group"><label>Телефон:<span class="starrequired">*</span></label><input name="TELEFON_USER" type="text" class="form-control input-lg phone req" placeholder=""></div>';
            var hiddenInput1  = '<input type="hidden" name="CODE" value="'+$(this).text()+'">';
            var hiddenInput2  = '<input type="hidden" name="ELEMENT_NAME" value="'+$(this).attr("data-name")+'">';
            var textarea0 = '<div class="form-group"><label>Ваше сообщение:<span class="starrequired">*</span></label><textarea name="COMMENT_USER" class="form-control input-lg req" rows="3" placeholder="Ваше сообщение"></textarea></div>';
            var textBody = messegeText +
            '<form id="user-reviews-add" action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax"><?=bitrix_sessid_post()?>' +
            hiddenInput1 +
            hiddenInput2 + '<div class="row input-form"><div class="col-12">'  +
            textInput +
            textInput0 + ' </div><div class="col-12"> ' +
            textInput1  +
            textarea0 +
            checkInput +
            $hidden + '<input name="go" type="hidden" value="'+ $go +'"><input type="submit" style="display: none;" value="Y"></div></div></form>';
            showMessageForm(textBody, $title, "Закрыть", "Отправить", 1);
            $('.modal-backdrop').addClass('modal-backdrop-inverse');
            $('input.phone').mask('+7 (999) 999-9999');
            return false;
        });
    });
</script><?