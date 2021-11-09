<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм добавления отзыва и т.д.
global $USER, $APPLICATION;
//p($arResult,'p');
?><script type="text/javascript">
    $(document).ready(function(){
        /* File size */
        function formatBytes(bytes)
        {
            var sizes = ['Bytes', 'kB', 'MB', 'GB', 'TB'];
            if (bytes == 0){return 'n/a';}
            var i = parseInt(Math.log(bytes) / Math.log(1024));
            return Math.round(bytes / Math.pow(1024, i), 2) +' '+ sizes[i];
        }
        /**/
        $('body').on('change',"input[name='file[]']", function (event) {
            event.preventDefault();
            var $li = '';
            $.each(this.files, function( key, value ) {
                console.log(key);
                console.log(value['name']);
                console.log(formatBytes(value['size']));
                $li = $li + '<li><b>'+ formatBytes(value['size']) +'</b>.....<small>'+ value['name'] +'</small></li>';
            });
            $('#upload-file-info').html('<ul>'+$li+'</ul>');
            return false;
        });
        $('body').on('click','.user-add-photo', function (event) {
            event.preventDefault();
            var $go = "UserAddPhoto";
            var $title = $(this).text();
            var $rel = $(this).attr('rel');
            console.log($rel);
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var sec = '<div class="form-group"><label>Год <span class="starrequired">*</span></label><select name="IBLOCK_SECTION_ID" type="text" class="form-control input-lg req"><? foreach ($arResult['SECTION'] as $SEC){ ?><option value="<?=$SEC['ID']?>"><?=$SEC['NAME']?></option><? } ?></select></div>';
            var textInput  = '<div class="form-group"><label>Название для галерей: <span class="starrequired">*</span></label><input name="NAME" type="text" class="form-control input-lg req" placeholder=""></div>';
            var hiddenInput0  = '<input type="hidden" name="PARAMS_HASH" value="<?=$arResult['PARAMS_HASH']?>">';
            var hiddenInput1  = '<input type="hidden" name="USER_ID" value="<?=$USER->GetID()?>">';
            var hiddenInput2  = '<input type="hidden" name="ID" value="'+$rel+'">';
            var files0 = '<div class="form-group"><label class="button button--common button--primary"  style="display:inline-block; text-align: center; padding: 10px 25px;"><input type="file" name="file[]" multiple="multiple" accept="image/x-png,image/gif,image/jpeg" style="display:none">   Добавить фотографии</label> <span class="label label-info" id="upload-file-info"></span></div>';
            var textBody = messegeText + '<form id="user-reviews-add" action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">' + hiddenInput0 + hiddenInput1 + hiddenInput2 + '<div class="row input-form"><div class="col-12">' + sec  + textInput + ' </div><div class="col-12"> ' + files0 + '<input name="go" type="hidden" value="'+ $go +'"><input type="submit" style="display: none;" value="Y"></div></div></form>';
            showMessageForm(textBody, $title, "Закрыть", "Загрузить", 1);
            return false;
        });
    });
</script><?