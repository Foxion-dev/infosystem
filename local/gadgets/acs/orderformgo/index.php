<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION, $CACHE_MANAGER, $DB;
//
CJSCore::Init(array('jquery'));
//
$arGadgetParams["COUNT"] = ($arGadgetParams["COUNT"] ? $arGadgetParams["COUNT"] : 10);
$arGadgetParams["UF_CODE"] = ($arGadgetParams["UF_CODE"] ? $arGadgetParams["UF_CODE"] : "ALL");

// logic
if(CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')){

// delete comment
if(!empty($_REQUEST['delete_comment_id_form']) && $_REQUEST['go'] == "DELLCOMITFORM"){

    // AddMessage2Log("\n".var_export($_REQUEST, true). " \n \r\n ", "REQUEST_");

    // для админки
    ob_end_clean(); // да
    ob_end_clean(); // сдохни
    ob_end_clean(); // ты
    ob_end_clean(); // гребаный
    ob_end_clean(); // буффер
    //
    $arJson = array();
    $commentId = intval($_REQUEST['delete_comment_id_form']);
    //
    if(!HiWrapper::id(3)->delete($commentId)){
        $arJson['alert'] = 'Ошибка удаления комментария '.$commentId;
    }else{
        //
    }
    $arJson['html'] = "#comment_form_".$commentId;
    print json_encode($arJson);
    die();
}

// p($arGadgetParams,'p');

$arResult = [];
//
    // https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=5753&LESSON_PATH=3913.5062.5748.5063.5753
    $query = HiWrapper::id(3)->getList(['order'=>['UF_REQUEST_DATE'=>'DESC'],'limit'=>$arGadgetParams['COUNT']]);
    while( $item = $query->fetch()){
        $item['UF_REQUEST_DATE'] = $item['UF_REQUEST_DATE']->format("d.m.Y H:i");
        $arResult['ITEMS'][] = $item;
    }

if (empty($arResult['ITEMS'])){ return; }

$APPLICATION->SetAdditionalCSS('/local/gadgets/acs/orderformgo/style.css');

if(count($arResult['ITEMS'])>0){ ?>

<div class="bx-gadgets-info prmedia-last-comments">
	<table class="bx-gadgets-info-site-table">
		<tr>
			<td align="left" valign="top">
				<div class="bx-gadgets-text">
					<? foreach ($arResult['ITEMS'] as $arItem): ?>
						<div class="comment_items" id="comment_form_<?=$arItem['ID']?>">
							<span class="delete-comment dell-form-id" data-id="<?=$arItem['ID']?>" title="Удалить"></span>
							<div class="comment_items_date">
                                <?=$arItem['UF_REQUEST_DATE']?>
                            </div>
                            <a class="comment_items_title" href="#" target="_blank"><?=$arItem['UF_NAME']?> / <?=$arItem['UF_TELEFON']?> / <?=$arItem['UF_EMAIL_USER']?></a>
							<div class="comment_items_body"><?=$arItem['UF_MESSAGE']?></div>
                            <div class="lnClass"></div>
						</div>
					<? endforeach ?>
				</div>
                <div class="allUrl"><a target="_blank" href="/bitrix/admin/message_edit.php?ID=49"><?=GetMessage('ORDER_INFO')?></a>  / <a target="_blank" href="/bitrix/admin/highloadblock_rows_list.php?ENTITY_ID=3&lang=ru"><?=GetMessage('COMMENTS_OLL')?></a></div>
			</td>
		</tr>
	</table>
</div>

<script type="text/javascript">
    $(document).on("click", ".prmedia-last-comments .dell-form-id", function(event){
        event.preventDefault();
        var id = $(this).attr("data-id");
        BX.showWait();
        $.ajax({
            url: "<?=POST_FORM_ACTION_URI?>",
            type: "POST",
            dataType: "JSON",
            data: {go: "DELLCOMITFORM", delete_comment_id_form: id},
            success: function (res){
                BX.closeWait();
                /* console.log(res.html); */
                $(res.html).hide(300);
            },
            error: function (res){
                BX.closeWait();
            }
        });
        return false;
    });
</script>

<? } /* end ITEMS */ ?>

<? }  /* end modules */ ?>