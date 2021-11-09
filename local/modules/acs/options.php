<h1>Настройка модуля</h1>

<?
$module_id = "acs";
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
$RIGHT = $APPLICATION->GetGroupRight($module_id);
if($RIGHT >= "R") :
/// Читаем данные и формируем для вывода, вызов параметра и т.д.
/// $USER_NAME_MOYSKLAD = COption::GetOptionString("acs", "USER_NAME_MOYSKLAD", "");
$arAllOptions = Array(
    array("ACS_AGENT_DAYS", "Количество дней до уведомления о начале курса", array("text"), "6"),
);

$aTabs = array(
    array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "perfmon_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
    array("DIV" => "edit2", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "perfmon_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

CModule::IncludeModule($module_id);

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults) > 0 && $RIGHT=="W" && check_bitrix_sessid())
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/perfmon/prolog.php");

    if(strlen($RestoreDefaults)>0)
        COption::RemoveOption("WE_ARE_CLOSED_TEXT_TITLE");
    else
    {
        foreach($arAllOptions as $arOption)
        {
            $name=$arOption[0];
            $val=$_REQUEST[$name];
            // @todo: проверка безопасности должна быть тут!
            COption::SetOptionString($module_id, $name, $val);
        }
    }

    ob_start();
    $Update = $Update.$Apply;
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
    ob_end_clean();
}

?>
<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($module_id)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    $arNotes = array();
    foreach($arAllOptions as $arOption):
        $val = COption::GetOptionString($module_id, $arOption[0], $arOption[3]);
        $type = $arOption[2];
        if(isset($arOption[4]))
            $arNotes[] = $arOption[4];
        ?>
        <tr>
            <td width="40%" nowrap <?if($type[0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
                <?if(isset($arOption[4])):?>
                    <span class="required"><sup><?echo count($arNotes)?></sup></span>
                <?endif;?>
                <label for="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo $arOption[1]?>:</label>
            <td width="60%">
                <?if($type[0]=="checkbox"):?>
                    <input type="checkbox" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
                <?elseif($type[0]=="text"):?>
                    <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>"><?if($arOption[0] == "slow_sql_time") echo GetMessage("PERFMON_OPTIONS_SLOW_SQL_TIME_SEC")?>
                <?elseif($type[0]=="textarea"):?>
                    <textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
                <?endif?>
            </td>
        </tr>
    <?endforeach?>
    <tr><td colspan="2">
        <? /*$org_ = MoySklad::getOrg();
        if($org_ && count($org_)){
            foreach ($org_ as $org){
                print '<div style="border-bottom: 1px dashed #e1e1e1; height: 10px; margin-bottom: 10px;"></div>';
                foreach ($org as $code=>$pv){
                    print "<div><small>".$code." : ".$pv."</small><div>";
                }
                print '<div style="border-bottom: 1px dashed #e1e1e1; height: 10px; margin-bottom: 10px;"></div>';
            }
        }*/ ?>
    </td></tr>
    <?$tabControl->BeginNextTab();?>
    <?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
    <?$tabControl->Buttons();?>
    <input <?if ($RIGHT<"W") echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
    <input <?if ($RIGHT<"W") echo "disabled" ?> type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
    <?if(strlen($_REQUEST["back_url_settings"])>0):?>
        <input <?if ($RIGHT<"W") echo "disabled" ?> type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
        <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
    <?endif?>
    <input type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
    <?=bitrix_sessid_post();?>
    <?$tabControl->End();?>
</form>
<?
//p(COption::GetOptionString("acs", "USER_NAME_MOYSKLAD", ""),'p');
//p(COption::GetOptionString("acs", "USER_PASSWORD_MOYSKLAD", ""),'p');
if(!empty($arNotes))
{
    echo BeginNote();
    foreach($arNotes as $i => $str)
    {
        ?><span class="required"><sup><?echo $i+1?></sup></span><?echo $str?><br><?
    }
    echo EndNote();
}
?>
<?endif;?>

<? // информационная подсказка, про статусы и т.д.
echo BeginNote();?>
<?echo 'Тут можно указать за какое количество дней нужно отправлять уведомление пользователям которые добавили курс в личный календарь <br>'; ?>
<?echo 'Тип почтового события <a href="/bitrix/admin/type_edit.php?EVENT_NAME=NOTICE_USER" target="_blank">NOTICE_USER</a>  шаблон отправки писем для УВЕДОМЛЯТОРА <a href="/bitrix/admin/message_edit.php?ID=50">ID=50</a><br>'; ?>
<?echo 'Агент на хитах <a href="/bitrix/admin/agent_edit.php?ID=64&lang=ru" target="_blank">AcsAgent::Notice();</a>'; ?>
<?echo EndNote();?>
