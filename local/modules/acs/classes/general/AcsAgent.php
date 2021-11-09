<?php

class AcsAgent{
    // за стколько по времени AcsAgent::DAYS()
    public static function DAYS(){
        $DAYS_ = COption::GetOptionString("acs", "ACS_AGENT_DAYS", 6);
        $DAYS_ = ($DAYS_?intval($DAYS_):6);
        return $DAYS_;
    }
    // отправка сообщенией агентом AcsAgent::Notice()
    public static function Notice(){
        //
        global $DB;
        if(CModule::IncludeModule("main") && CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")){
            $idArr = []; // ID - курсов
            $UCA = []; // список пользователей с курсами отправки
            $eventArr = [];
            $DAYS = self::DAYS();  // берем уведомление за 6 дней, интервал 1 день т.е. 24 часа
            $PROPERTY_DATE_START = date('Y-m-d', strtotime('+'.$DAYS.' days'));
            $PROPERTY_DATE_END = date('Y-m-d', strtotime('+'.($DAYS+1).' days')); // 86400 секунд 24 часа
            $IBLOCK_ID =  2;
            $arSelect = ["ID","NAME","IBLOCK_ID","SECTION_ID","CODE","DETAIL_PAGE_URL","PREVIEW_PICTURE","PROPERTY_DATE","PROPERTY_CITY","PROPERTY_MANAGER.NAME"];
            $arFilter = ["IBLOCK_ID"=>$IBLOCK_ID,"ACTIVE"=>"Y",">PROPERTY_DATE"=>$PROPERTY_DATE_START,'<PROPERTY_DATE'=>$PROPERTY_DATE_END];
            //$arFilter = ["IBLOCK_ID"=>$IBLOCK_ID,"ACTIVE"=>"Y",">PROPERTY_DATE"=>'2019-12-29','<PROPERTY_DATE'=>'2019-12-30'];
            $res = CIBlockElement::GetList(['PROPERTY_DATE'=>'ASC','SORT'=>'ASC'], $arFilter, false,false, $arSelect);
            while($arFields = $res->GetNext()){
                $idArr[] = $arFields['ID'];
                $eventArr[$arFields['ID']] = $arFields;
                //p($arFields,'p');
            }
            //AddMessage2Log("\n".var_export($idArr, true). " \n \r\n ", "idArr");
            if(count($idArr)){
                $GP = AcsApi::getPriseArr($idArr); // стоимость курса и т.д.
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
                            $PREVIEW_PICTURE = AcsApi::isHttps().$_SERVER['SERVER_NAME'].$PR['SRC'];
                        }else{ $PREVIEW_PICTURE = AcsApi::isHttps().$_SERVER['SERVER_NAME'].PRM::SRC(500); }
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
                            'DETAIL_PAGE_URL' => $eventArr[$row['UF_EVENT']]['DETAIL_PAGE_URL']?AcsApi::isHttps().$_SERVER['SERVER_NAME'].$eventArr[$row['UF_EVENT']]['DETAIL_PAGE_URL']:'',
                            'PROPERTY_CITY_VALUE' => $eventArr[$row['UF_EVENT']]['PROPERTY_CITY_VALUE'],
                            'PREVIEW_PICTURE' => $PREVIEW_PICTURE,
                            'PROPERTY_MANAGER_NAME' => $eventArr[$row['UF_EVENT']]['PROPERTY_MANAGER_NAME'],
                            'PRISE' => $GP[$row['UF_EVENT']]?number_format($GP[$row['UF_EVENT']], 0, '', ' ').' руб.':'',
                        ];
                    }
                }
                // алгоритм отправки сообщения пользователям и т.д.
                //AddMessage2Log("\n".var_export($UCA, true). " \n \r\n ", "UCA");
                //AddMessage2Log("\n".var_export($_SERVER["DOCUMENT_ROOT"]."/local/modules/acs/lib/mail.php", true). " \n \r\n ", "SERVER");
                if(count($UCA)){
                    /* NOTICE_USER шаблон писем для отправки сообщения и т.д.
                    #USER_NAME# - Имя
                    #USER_ID# - ID
                    #USER_LOGIN# - Логин
                    #USER_EMAIL# - E-Mail пользователя
                    #MESSAGE_THEME# - Тема сообщения
                    #MESSAGE_HTML# - Сообщение
                    #BCC# - Скрытая копия */
                    foreach ($UCA as &$U) {
                        /* имя пользователя и т.д. */
                        $USER_NAME = [$U['USER_NAME'],$U['USER_SECOND_NAME'],$U['USER_LAST_NAME']];
                        $USER_NAME = array_filter($USER_NAME, 'strlen');
                        $USER_NAME = (count($USER_NAME)?$USER_NAME:['ID - '.$U['UF_USER'],$U['USER_LOGIN'],$U['USER_EMAIL']]);
                        //
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
                            'USER_EMAIL' => trim($U["USER_EMAIL"]), // емайл пользователя куда отправляем сообшение
                            'MESSAGE_THEME' => htmlspecialchars('Осталось '.$DAYS.' дней до начало курсов.'),
                            'MESSAGE_HTML' => $html,
                        ];
                        //
                        if(CEvent::SendImmediate("NOTICE_USER", 's1', $arEventFields)){
                            $U['EVENT_SEND'] = 1;
                            //AddMessage2Log("\n".var_export('ok', true). " \n \r\n ", "ok");
                        }else{
                            $U['EVENT_SEND'] = 0;
                        }
                    }
                } // алгоритм отправки
            } // end $idArr

            // запись отчета в файл для анализа и т.д.
            $FL = $_SERVER["DOCUMENT_ROOT"].'/local/modules/acs/EVENT_SEND.txt';
            $reportArr = unserialize(file_get_contents($FL));
            $reportArr = $reportArr?$reportArr:[];
            array_unshift($reportArr, ['DATE'=>time(),'COUNT'=>count($UCA), 'EVENT_SEND'=>$UCA, 'ID_ELEM'=>$idArr]);
            $reportArr = array_slice($reportArr, 0, 10);   // возвращает срез массива 10 элементов
            file_put_contents($FL, serialize($reportArr));
        }
        return "AcsAgent::Notice();";
    }
}