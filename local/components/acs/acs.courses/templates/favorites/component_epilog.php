<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
global $USER, $APPLICATION;
if(count($arParams['UF_CALENDAR'])) {
    $arJson = [];
    $arr = [];
    foreach ($arResult['ITEMS'] as $ITEM) {
        if (!in_array($ITEM['ID'], $arParams['UF_CALENDAR'])) continue;
        $arr[] = $ITEM['ID'];
        $arJson['jq']['addClass']['.user-add-notice[rel="'.$ITEM['ID'].'"]'] = 'active';
        $arJson['jq']['html']['.user-add-notice[rel="'.$ITEM['ID'].'"]'] = '<i class="fa fa-calendar" aria-hidden="true"></i> Курс добавлен в календарь';
    }
    if(count($arJson)){ ?>
        <script type="text/javascript">
            $(document).ready(function(){
                var res = <?=json_encode($arJson)?>;
                if(res.jq){ JQ(res.jq); }
            });
        </script>
    <? }
    /**/
}
//
if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == "addCalendarUserNotice" && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock")){
    //
    $arJson = [];
    $error = [];
    $result = false;
    $get = $_REQUEST; // сюда нужно включить алгоритм очистки и т.д.
    $get['USER_ID'] = $USER->GetID();
    $get['ID_EVENT'] = false;
    if(!$USER->IsAuthorized()){
        $arJson['error'] = '<span class="errorTextModal">Для добавление в курса мой календарь, зарегистрируйтесь или авторизуйтесь</span>';
        $arJson['title'] = "Сообщение";
        return $arJson;
    }
    if(intval($get['ID'])>0){
        //
        $ob = HiWrapper::id(6);
        $rsData = $ob->getList([
            "select" => ["ID","UF_USER","UF_EVENT"],
            "order" => ["ID" => "DESC"],
            "filter" => ["UF_USER"=>$get['USER_ID'],'UF_EVENT'=>intval($get['ID'])]
        ]);
        if($arData = $rsData->Fetch()){
            $get['ID_EVENT'] = $arData;
        }
        //  если есть событие то его удаляем, если нет то добавляем
        if($get['ID_EVENT'] && intval($get['ID_EVENT']['ID'])>0){
            $ob->delete(intval($get['ID_EVENT']['ID']));
            // JS api
            $arJson['jq']['removeClass'] = ['.user-add-notice[rel="'.$get['ID'].'"]' => 'active'];
            $arJson['jq']['html']['.user-add-notice[rel="'.$get['ID'].'"]'] = '<i class="fa fa-calendar" aria-hidden="true"></i> Установить уведомления';
        }else{
            $dataFields = [
                "UF_USER" => $get['USER_ID'],
                "UF_EVENT" => intval($get['ID']),
                "UF_DATE" => date('d.m.Y H:i', time()),
            ];
            $ob_ = $ob->add($dataFields);
            // JS api
            $arJson['jq']['addClass'] = ['.user-add-notice[rel="'.$get['ID'].'"]' => 'active'];
            $arJson['jq']['html']['.user-add-notice[rel="'.$get['ID'].'"]'] = '<i class="fa fa-calendar" aria-hidden="true"></i> Курс добавлен в календарь';
        }
        //
    }else{
        // ошибка добавления
        $arJson['error'] = 'ID ?';
        $arJson['title'] = "Ошибка добавления";
    }
    //
    $APPLICATION->RestartBuffer();
    print json_encode($arJson);
    die();
}
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.user-add-notice', function (event) {
            event.preventDefault();
            var $val = $(this).attr("rel"), $title = $(this).text();
            var $doAction = ($(this).hasClass('active')?'delete':'add');
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?=POST_FORM_ACTION_URI?>",
                data: {go:"addCalendarUserNotice", title:$title, ID:$val, doAction:$doAction},
                success: function(res){
                    closeWait();
                    if(res.jq){ JQ(res.jq); }
                    if(res.alert){ showMessage(res.alert, res.title, res.cansel); }
                    if(res.error){ showMessage(res.error, res.title, res.cansel); }
                }
            });
            return false;
        });
    });
</script><?