<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('acs'))
return;

Loc::loadMessages(__FILE__);

class acsCalendarEvent extends \CBitrixComponent
{
    /* выводит ID элементов события для фильтрации по календарю и т.д. */
    public function getArrEvent($USER_ID){
        $arrEvent = [];
        if($USER_ID && CModule::IncludeModule('acs')){
            $rsDataEvent = HiWrapper::id(6)->getList(["select"=>["ID","UF_USER","UF_EVENT"],"order"=>["UF_EVENT"=>"DESC"],"filter"=>["UF_USER"=>$USER_ID]]);
            while($arDataEvent = $rsDataEvent->Fetch()){
                if(intval($arDataEvent['UF_EVENT'])>0)
                    $arrEvent[] = intval($arDataEvent['UF_EVENT']);
            }
            $arrEvent = array_unique($arrEvent);
        }
        return $arrEvent;
    }

}