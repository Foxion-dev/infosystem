<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php"); // первый общий пролог
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/acs/include.php"); // инициализация модуля
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/acs/prolog.php"); // пролог модуля

// подключим языковой файл
IncludeModuleLangFile(__FILE__);
//
if(!CModule::IncludeModule("acs")) return;

// получим права доступа текущего пользователя на модуль
$POST_RIGHT = $APPLICATION->GetGroupRight("acs");
// если нет прав - отправим к форме авторизации с сообщением об ошибке
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$sTableID = "tbl_notification_section"; // ID таблицы
$oSort = new CAdminSorting($sTableID, "id", "desc"); // объект сортировки
$lAdmin = new CAdminList($sTableID, $oSort); // основной объект списка

/* ФИЛЬТР */

// проверку значений фильтра для удобства вынесем в отдельную функцию
function CheckFilter()
{
    global $FilterArr, $lAdmin;
    foreach ($FilterArr as $f) global $$f;

    // В данном случае проверять нечего.
    // В общем случае нужно проверять значения переменных $find_имя
    // и в случае возниконовения ошибки передавать ее обработчику
    // посредством $lAdmin->AddFilterError('текст_ошибки').

    return count($lAdmin->arFilterErrors)==0; // если ошибки есть, вернем false;
}

// опишем элементы фильтра
$FilterArr = Array(
    "find",
    "find_type",
   /* "find_id",
    "find_code",
    "find_SELECT_ID",
    "find_name",*/
);

// инициализируем фильтр
$lAdmin->InitFilter($FilterArr);

// если все значения фильтра корректны, обработаем его
if (CheckFilter())
{
    // создадим массив фильтрации для выборки CRubric::GetList() на основе значений фильтра
    $arFilter = Array(
        "id"    => ($find!="" && $find_type == "id"? $find:$find_id),
        //"parent_id"  => $find_parent_id, //($find!="" && $find_type == "category_id"? $find:$find_category_id),
        //"code"  => $find_code,
        //"SELECT_ID"  => $find_SELECT_ID,
        //"name"  => $find_name,
    );
}

/*  КОНЕЦ ФИЛЬТРА */


/*  ОБРАБОТКА ДЕЙСТВИЙ НАД ЭЛЕМЕНТАМИ СПИСКА */

// сохранение отредактированных элементов
if($lAdmin->EditAction() && $POST_RIGHT=="W")
{
    // пройдем по списку переданных элементов
    foreach($FIELDS as $ID=>$arFields)
    {
        //AddMessage2Log("\n".var_export($ID, true). " \n \r\n ", "ID");
        //AddMessage2Log("\n".var_export($arFields, true). " \n \r\n ", "arFields");

        if(!$lAdmin->IsUpdated($ID))continue;
        //
        $SET = array();
        if(count($arFields)>0){
            // параметры POST летащие и т.д.
            foreach ($arFields as $k=>$fieldsValue) {
                $SET[] = "cat.`".$k."` = '".$fieldsValue."'";
            }
            // сохраним изменения каждого элемента
            /* global $DB;
            $DB->StartTransaction();
            $ID = IntVal($ID);
            $SQL = "UPDATE `a_ads_dict_enums` as cat SET ".(count($SET)>0 ? implode(", ",$SET):"")." WHERE cat.`id` =  ".$ID."";
            $dbResult = $DB->Query($SQL, true);
            $DB->Commit();
            if(!$dbResult){
                $lAdmin->AddGroupError("Ошибка", $ID);
            } */
        }
    }
}

// обработка одиночных и групповых действий
//пока закомител и т.д.
if(($arID = $lAdmin->GroupAction()) && $POST_RIGHT=="W")
{
    // если выбрано "Для всех элементов"

    if($_REQUEST['action_target']=='selected')
    {
        /**/
        $lAdmin->AddGroupError("ОПЕРАЦИИ НАД ВСЕМИ ЭЛЕМЕНТАМИ НЕ ПРЕДУСМОТРЕННЫ");
    }

    //AddMessage2Log("\n".var_export($_REQUEST, true). " \n \r\n ", "REQUEST");
    //AddMessage2Log("\n".var_export($arID, true). " \n \r\n ", "arID");

    // пройдем по списку элементов
    foreach($arID as $ID)
    {
        if(strlen($ID)<=0)continue;
        $ID = IntVal($ID);

        // для каждого элемента совершим требуемое действие
        switch($_REQUEST['action'])
        {
            // удаление
            case "delete":
                /**/
                /* global $DB;
                $DB->StartTransaction();
                $SQL = "DELETE FROM `a_ads_dict_enums` WHERE `a_ads_dict_enums`.`id` =  ".$ID."";
                $dbResult = $DB->Query($SQL, true);
                $DB->Commit();
                if(!$dbResult){
                    $lAdmin->AddGroupError("Ошибка удаления", $ID);
                }else{
                    CAdminMessage::ShowMessage(array("MESSAGE"=>"Удалено id ".$ID, "TYPE"=>"OK"));
                } */
                $lAdmin->AddGroupError("ОПЕРАЦИИ НАД ЭЛЕМЕНТАМИ НЕ ПРЕДУСМОТРЕННЫ", $ID);
                break;

            // активация/деактивация
            case "activate":
            case "deactivate":
                $active = ($_REQUEST['action']=="activate"?"Y":"N");
                // обновляем и т.д.
                /* global $DB;
                $DB->StartTransaction();
                $SQL = "UPDATE `a_ads_dict_enums` as cat SET cat.`active` = '".$active."' WHERE cat.`id` =  ".$ID."";
                $dbResult = $DB->Query($SQL, true);
                $DB->Commit();
                if(!$dbResult){
                    $lAdmin->AddGroupError("Ошибка", $ID);
                }
                */
                $lAdmin->AddGroupError("ОПЕРАЦИИ НАД ЭЛЕМЕНТАМИ НЕ ПРЕДУСМОТРЕННЫ", $ID);
                break;
            //  модерация
            /**/
        }
    }
} // end GroupAction

/* Конец Обработки действия над элементами в таблитце */

/* ВЫБОРКА ЭЛЕМЕНТОВ СПИСКА */

// выберем список параметров
//AddMessage2Log("\n".var_export($arFilter, true). " \n \r\n ", "arFilterNull");
//AddMessage2Log("\n".var_export($_REQUEST, true). " \n \r\n ", "REQUEST_FILTER");
//
$arFilter = array_filter($arFilter, 'strlen');  // удаляем Null
$FL = $_SERVER["DOCUMENT_ROOT"].'/local/modules/acs/EVENT_SEND.txt';
$sect = unserialize(file_get_contents($FL));
$sect = $sect?$sect:[];
//p(count($arFilter),'p');
//p(count($sect),'p');

// p($sect,'p');
//exit();
/* кривой алгоритм фильтрации и т.д.
if($arFilter){
    foreach ($arFilter as $k_=>$kv_){
        // p($k_.' '.$kv_,'p');
        switch ($k_){
            case 'name':
                foreach ($sect as $fk_=>$filter_){
                    if(stripos($filter_[$k_],$kv_) === false){ unset($sect[$fk_]); }
                }
                break;
            default:
                foreach ($sect as $fk_=>$filter_){
                    if($filter_[$k_]!=$kv_){ unset($sect[$fk_]); }
                }
        }
        //
    }
} */
// простой алгоритм сортировки очень интересный и т.д.
$code  = array_column($sect, ($_REQUEST['by']?$_REQUEST['by']:"DATE"));
array_multisort($code, ($_REQUEST['order']=="asc"?SORT_ASC:SORT_DESC), $sect);
// конец алгоритма сортировки и т.д.

//
$rsData = new CDBResult();
$rsData->InitFromArray($sect);
// $rsData->NavStart(($_REQUEST['SIZEN_1']?intval($_REQUEST['SIZEN_1']):20),false);
//AddMessage2Log("\n".var_export($arFilter, true). " \n \r\n ", "arFilter");

// преобразуем список в экземпляр класса CAdminResult
$rsData = new CAdminResult($rsData, $sTableID);
// отправим вывод переключателя страниц в основной объект $lAdmin
// $lAdmin->NavText($rsData->GetNavPrint("Параметры"));

/* ПОДГОТОВКА СПИСКА К ВЫВОДУ */
$lAdmin->AddHeaders(array(
    array("id" =>"DATE",
        "content"  =>"Дата отправки",
        "sort"    =>"DATE",
        "default"  =>true,
    ),
    array("id"   =>"COUNT",
        "content"  =>"Количество отправок",
        "sort"   =>"COUNT",
        "default"  =>true,
    ),
    array("id"   =>"EVENT_SEND",
        "content"  =>"Кому",
        "sort"   =>"EVENT_SEND",
        "default"  =>true,
    ),

));

// вывод и т.д.
while($arRes = $rsData->NavNext(true, "f_")):
    // p($arRes['EVENT_SEND'],'p');
    // создаем строку. результат - экземпляр класса CAdminListRow
    $row =& $lAdmin->AddRow($f_DATE, $arRes);
    //
    $row->AddViewField("DATE",date("d.m.Y H:i", $f_DATE));
    $row->AddViewField("COUNT",$f_COUNT);
    //
    $ESA = [];
    if(count($arRes['EVENT_SEND'])){
        foreach ($arRes['EVENT_SEND'] as $are) {
            $ESA[] = $are['USER_EMAIL'];
        }
    }
    $row->AddViewField("EVENT_SEND",'<small>'.implode(', ',$ESA).'</small>');
    //

    //
    /* контекстное меню */
    $arActions = Array();
    // разделитель
    $arActions[] = array("SEPARATOR"=>true);
    // если последний элемент - разделитель, почистим мусор.
    if(is_set($arActions[count($arActions)-1], "SEPARATOR"))
        unset($arActions[count($arActions)-1]);

    // применим контекстное меню к строке
    $row->AddActions($arActions);

endwhile;


// резюме таблицы
$lAdmin->AddFooter(
    array(
        array("title"=>GetMessage("MAIN_ADMIN_LIST_SELECTED"), "value"=>$rsData->SelectedRowsCount()), // кол-во элементов
        array("counter"=>true, "title"=>GetMessage("MAIN_ADMIN_LIST_CHECKED"), "value"=>"0"), // счетчик выбранных элементов
    )
);

// групповые действия
$lAdmin->AddGroupActionTable(Array(
    "delete"=>"Удалить", // удалить выбранные элементы
    "activate"=>"Активировать", // активировать выбранные элементы
    "deactivate"=>"Деактивировать", // деактивировать выбранные элементы
    // "modern"=>GetMessage("LIST_MODERN"), // отмодерировать выбранные элементы
));

/*  АДМИНИСТРАТИВНОЕ МЕНЮ */
// сформируем меню из одного пункта - добавление параметра и т.д.
$aContext = [];
$aContext = [
    /*[
        "TEXT"=>"Синхронизовать разделы",
        "LINK"=>"moysklad_section_sync.php?lang=".LANG,
        "TITLE"=>"Синхронизовать разделы",
        "ICON"=>"btn_new",
    ],*/
];

// и прикрепим его к списку
$lAdmin->AddAdminContextMenu($aContext);

/* ВЫВОД */
// альтернативный вывод
$lAdmin->CheckListMode();

// здесь будет вся серверная обработка и подготовка данных

$APPLICATION->SetTitle("Отчеты уведомления"); // установка заголовка
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

/* ВЫВОД ФИЛЬТРА */
// создадим объект фильтра
$oFilter = new CAdminFilter(
    $sTableID."_filter",
    array(
        "ID",
        //GetMessage("find_code"),
        //GetMessage("find_SELECT_ID"),
        //GetMessage("find_name"),
        //GetMessage("find_value"),
        //GetMessage("find_param_id"),
        //GetMessage("find_parent_id"),
    )
); ?>

<style>
    option.select_children_Y{ font-weight: bold !important; font-size: 13px; background: #e7e7e7;  color: #000; min-height: 1.9em !important; line-height: 1.9em !important; }
    option.select_level_0{ font-weight: bold !important; font-size: 15px !important; background: #e7e7e7;  color: #000; min-height: 1.9em !important; line-height: 1.9em !important; }
</style>
<?/*<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td><b><?=GetMessage("prm_f_find")?>:</b></td>
        <td>
            <input type="text" size="25" name="find" value="<?echo htmlspecialchars($find)?>" title="<?=GetMessage("prm_f_find_title")?>">
            <?
            $arr = array(
                "reference" => array(
                    "ID",
                    //"Категория (category_id)",
                    //GetMessage("title_name"),
                ),
                "reference_id" => array(
                    "id",
                    //"category_id",
                    //"title",
                )
            );
            echo SelectBoxFromArray("find_type", $arr, $find_type, "", "");
            ?>
        </td>
    </tr>
    <tr>
        <td><?="ID"?>:</td>
        <td>
            <input type="text" name="find_id" size="47" value="<?echo htmlspecialchars($find_id)?>">
        </td>
    </tr>
    <?
    $oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"find_form"));
    $oFilter->End();
    ?>
</form>*/?>

<?
// выведем таблицу списка элементов
$lAdmin->DisplayList();
?>

<? // информационная подсказка, про статусы и т.д.
echo BeginNote();?>
<?echo "Отчеты уведомления берутся из файла '/local/modules/acs/EVENT_SEND.txt' десять последних уведомлений "; ?>
<?echo EndNote();?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>
