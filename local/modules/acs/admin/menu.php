<?php
IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("acs")>"D"){

    require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/acs/prolog.php");

    $aMenu = array(
        "parent_menu" => "global_menu_services",
        "section" => "acs",
        "sort" => 11, //
        "module_id" => "acs",
        "text" => 'Уведомлятор',
        "title"=> 'Уведомление пользователям которые добавили курс в личный календарь',
        "icon" => "sys_menu_icon",   // sys_menu_icon  bizproc_menu_icon
        "page_icon" => "sys_menu_icon", // sys_menu_icon  bizproc_menu_icon
        "items_id" => "menu_acs",
        "items" => array(
            array(
                "text" => 'Отчеты уведомления',
                "title" => 'Отчеты уведомления',
                "url" => "acs_notification_reports_list.php?lang=".LANGUAGE_ID,
                //"more_url" => array('acs_notification_reports_list.php', 'acs_notification_reports_detail.php'),
            ),
            array(
                "text" => 'Настройки',
                "title" => 'Настройки уведомления',
                "url" => "settings.php?mid=acs&lang=".LANGUAGE_ID,
                //"more_url" => array('acs_gray_list.php', 'acs_gray_list_edit.php'),
            ),
            /*array(
                "text" => 'Дополнительно',
                "title" => 'Дополнительно',
                "items_id" => "acs_menu_ads",
                "items" => array(
                    array(
                        "text" => 'Статистика',
                        "title" => 'Статистика объявлений',
                        "url" => "acs_stat.php?lang=".LANGUAGE_ID,
                        "more_url" => array('acs_stat.php'),
                    ),
                    array(
                        "text" => 'Статистика выходов',
                        "title" => 'Статистика выходов и просмотров',
                        "url" => "acs_static.php?lang=".LANGUAGE_ID,
                        "more_url" => array('acs_static.php'),
                    ),
                    array(
                        "text" => 'Стоп-слова',
                        "title" => 'Стоп-слова, блокирующих подачу объявлений',
                        "url" => "acs_stop_word_list.php?lang=".LANGUAGE_ID,
                        "more_url" => array('acs_stop_word_list.php','acs_stop_word_list_edit.php'),
                    ),
                )
            ),*/
        )
    );
    return $aMenu;
}
return false;