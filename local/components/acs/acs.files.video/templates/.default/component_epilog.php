<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм добавления отзыва и т.д.
global $USER, $APPLICATION;
//p($arResult,'p');
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.user-add-video', function (event) {
            event.preventDefault();
            var $go = "UserAddVideo";
            var $title = $(this).text();
            var $rel = $(this).attr('rel');
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var textInput  = '<div class="form-group"><label>Название для видео: <span class="starrequired">*</span></label><input name="NAME" type="text" class="form-control input-lg req" placeholder=""></div>';
            var textInput1  = '<div class="form-group"><label>Ссылка на youtube.com: <span class="starrequired">*</span></label><input name="YOUTUBE" type="text" class="form-control input-lg req" placeholder="Например: https://www.youtube.com/watch?v=ZSo-4t-Xzfs"></div>';
            var hiddenInput0  = '<input type="hidden" name="PARAMS_HASH" value="<?=$arResult['PARAMS_HASH']?>">';
            var hiddenInput1  = '<input type="hidden" name="USER_ID" value="<?=$USER->GetID()?>">';
            var hiddenInput2  = '<input type="hidden" name="ID" value="'+$rel+'">';
            var files0 = '<div class="form-group"><label class="button button--common button--primary"  style="display:inline-block; text-align: center; padding: 10px 25px;"><input type="file" name="file" accept="image/x-png,image/gif,image/jpeg" style="display:none" onchange="$(\'#upload-file-info\').html(\'<small>\'+this.files[0].name+\'</small>\'); return false;">   Добавить картинку для анонса</label> <span class="label label-info" id="upload-file-info"></span></div>';
            var textBody = messegeText + '<form id="user-reviews-add" action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">' + hiddenInput0 + hiddenInput1 + hiddenInput2 + '<div class="row input-form"><div class="col-12">' + textInput + textInput1 + ' </div><div class="col-12"> ' + files0 + '<input name="go" type="hidden" value="'+ $go +'"><input type="submit" style="display: none;" value="Y"></div></div></form>';
            showMessageForm(textBody, $title, "Закрыть", "Добавить", 1);
            return false;
        });
    });
</script><?