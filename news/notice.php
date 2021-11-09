<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// получаем стоимость курса и т.д.
function getPriseArr($PRODUCT_ID_ARR, $CATALOG_GROUP_ID = Null){
    $res = [];
    $CATALOG_GROUP_ID = $CATALOG_GROUP_ID?$CATALOG_GROUP_ID:1;
    $PRODUCT_ID_ARR = is_array($PRODUCT_ID_ARR)?$PRODUCT_ID_ARR:[$PRODUCT_ID_ARR];
    if(count($PRODUCT_ID_ARR) && CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")){
        $db_res = CPrice::GetList(
            ['PRODUCT_ID'=>'ACS'],
            [
                "PRODUCT_ID" => $PRODUCT_ID_ARR,
                "CATALOG_GROUP_ID" => $CATALOG_GROUP_ID,
            ], false, false, ["ID","PRODUCT_ID","PRICE"]
        );
        while ($ar_res = $db_res->Fetch()){
            //
            // $res[$ar_res['PRODUCT_ID']] = number_format($ar_res['PRICE'], 0, '', ' ');
            $res[$ar_res['PRODUCT_ID']] = $ar_res['PRICE'];
        }
    }
    return $res;
}

global $USER, $DB, $APPLICATION;
if($USER->IsAdmin() && CModule::IncludeModule("highloadblock") && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")):
    //
    p(time(),'p');
    p(date('Y-m-d', time()),'p');
    $idArr = [];
    $eventArr = [];
    $DAYS = 6;  // берем уведомление за 6 дней, интервал 1 день т.е. 24 часа
    p(date('Y-m-d', strtotime ('+'.$DAYS.' days')),'p');
    p(date('Y-m-d', strtotime ('+'.($DAYS+1).' days')),'p');
    $IBLOCK_ID =  2;
    $arSelect = ["ID","NAME","IBLOCK_ID","SECTION_ID","CODE","DETAIL_PAGE_URL","PREVIEW_PICTURE","PROPERTY_DATE","PROPERTY_CITY","PROPERTY_MANAGER.NAME"];
    $arFilter = ["IBLOCK_ID"=>$IBLOCK_ID,"ACTIVE"=>"Y",">PROPERTY_DATE"=>'2019-12-29','<PROPERTY_DATE'=>'2019-12-30'];
    $res = CIBlockElement::GetList(['PROPERTY_DATE'=>'ASC','SORT'=>'ASC'], $arFilter, false,false, $arSelect);
    while($arFields = $res->GetNext()){
        $idArr[] = $arFields['ID'];
        $eventArr[$arFields['ID']] = $arFields;
        //p($arFields,'p');
    }
    if(count($idArr)):
        // p($eventArr,'p');
        // p($idArr, 'p');
        $GP = getPriseArr($idArr); // стоимость курса и т.д.
        p($GP,'p');
        $UCA = [];
        $where[] = 'uc.`UF_EVENT` IN ('.implode(" , ",$idArr).')';
        $arSqlOrder[] = "uc.`ID`"." ASC";
        $SQL = 'SELECT uc.*, us.LOGIN as USER_LOGIN, us.NAME as USER_NAME, us.SECOND_NAME as USER_SECOND_NAME, us.LAST_NAME as USER_LAST_NAME, us.EMAIL as USER_EMAIL
                FROM `user_calendar` as uc
                LEFT JOIN `b_user` as us ON us.ID = uc.UF_USER
                '.(count($where)>0 ? ' WHERE '.implode(' AND ', $where):'')
                .(count($arSqlOrder)>0 ? ' ORDER BY '.implode(', ', $arSqlOrder):'');
        if($dbr = $DB->Query($SQL,true)){
            while($row = $dbr->Fetch()){
                // PREVIEW_PICTURE
                if($eventArr[$row['UF_EVENT']]['PREVIEW_PICTURE']){
                    $PR = PRM::PR($eventArr[$row['UF_EVENT']]['PREVIEW_PICTURE'], $arSize = ["width" => 800, "height" => 600]);
                    $PREVIEW_PICTURE = PRM::isHttps().$_SERVER['SERVER_NAME'].$PR['SRC'];
                }else{ $PREVIEW_PICTURE = PRM::isHttps().$_SERVER['SERVER_NAME'].PRM::SRC(500); }
                //p($row, 'p');
                $UCA[$row['UF_USER']]['UF_USER'] = $row['UF_USER'];
                $UCA[$row['UF_USER']]['USER_LOGIN'] = $row['USER_LOGIN'];
                $UCA[$row['UF_USER']]['USER_EMAIL'] = $row['USER_EMAIL'];
                $UCA[$row['UF_USER']]['USER_NAME'] = $row['USER_NAME'];
                $UCA[$row['UF_USER']]['USER_SECOND_NAME'] = $row['USER_SECOND_NAME'];
                $UCA[$row['UF_USER']]['USER_LAST_NAME'] = $row['USER_LAST_NAME'];
                $UCA[$row['UF_USER']]['COURSES'][$row['UF_EVENT']] = [
                    'ID' => $row['UF_EVENT'],
                    'NAME' => $eventArr[$row['UF_EVENT']]['NAME'],
                    'PROPERTY_DATE_VALUE' => ($eventArr[$row['UF_EVENT']]['PROPERTY_DATE_VALUE']?date('d.m.Y H:i',strtotime($eventArr[$row['UF_EVENT']]['PROPERTY_DATE_VALUE'])):''),
                    'DETAIL_PAGE_URL' => $eventArr[$row['UF_EVENT']]['DETAIL_PAGE_URL']?PRM::isHttps().$_SERVER['SERVER_NAME'].$eventArr[$row['UF_EVENT']]['DETAIL_PAGE_URL']:'',
                    'PROPERTY_CITY_VALUE' => $eventArr[$row['UF_EVENT']]['PROPERTY_CITY_VALUE'],
                    'PREVIEW_PICTURE' => $PREVIEW_PICTURE,
                    'PROPERTY_MANAGER_NAME' => $eventArr[$row['UF_EVENT']]['PROPERTY_MANAGER_NAME'],
                    'PRISE' => $GP[$row['UF_EVENT']]?number_format($GP[$row['UF_EVENT']], 0, '', ' ').' руб.':'',
                ];
            }
        }
        // алгоритм отправки сообщения пользователям и т.д.
        if(count($UCA)):
            /* NOTICE_USER шаблон писем для отправки сообщения и т.д.
            #USER_NAME# - Имя
            #USER_ID# - ID
            #USER_LOGIN# - Логин
            #USER_EMAIL# - E-Mail пользователя
            #MESSAGE_THEME# - Тема сообщения
            #MESSAGE_HTML# - Сообщение
            #BCC# - Скрытая копия */
            foreach ($UCA as $U) {
                /* имя пользователя и т.д. */
                $USER_NAME = [$U['USER_NAME'],$U['USER_SECOND_NAME'],$U['USER_LAST_NAME']];
                $USER_NAME = array_filter($USER_NAME, 'strlen');
                $USER_NAME = (count($USER_NAME)?$USER_NAME:['ID - '.$U['UF_USER'],$U['USER_LOGIN'],$U['USER_EMAIL']]);
                p($U, 'p');

                // формируем сообщение и т.д.
                ob_start();
                include($_SERVER["DOCUMENT_ROOT"]."/local/modules/acs/lib/mail.php");
                $html = ob_get_contents();
                ob_end_clean();

                /* отправляем на почту и т.д. */
                $arEventFields = [
                    'USER_NAME' => htmlspecialchars(implode(' ',$USER_NAME)),
                    'USER_ID' => htmlspecialchars(trim($U["UF_USER"])),
                    'USER_LOGIN' => htmlspecialchars(trim($U["USER_LOGIN"])),
                    'USER_EMAIL' => 'otolaa@ya.ru, otolaa@mail.ru, kalabunga82@gmail.com', //trim($U["USER_EMAIL"]),
                    'MESSAGE_THEME' => htmlspecialchars('Осталось '.$DAYS.' дней до начало курсов.'),
                    'MESSAGE_HTML' => $html,
                ];
                // p($arEventFields,'p');
                CEvent::SendImmediate("NOTICE_USER", SITE_ID, $arEventFields);
            }
        endif;
    endif;
endif;