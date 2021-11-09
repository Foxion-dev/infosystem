<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock'))
return;

Loc::loadMessages(__FILE__);

class galleryGo extends \CBitrixComponent
{
    //
    public static function PR($PREVIEW_PICTURE, $arSize, $filter=Null){
        $arPR = array();
        $arPR = array_merge(array('ID' => $PREVIEW_PICTURE), array_change_key_case(CFile::ResizeImageGet(
            $PREVIEW_PICTURE,
            $arSize,
            ($filter ? $filter : BX_RESIZE_IMAGE_EXACT),
            true
        ),CASE_UPPER));
        return $arPR;
    }

    // формирует шаблон вывода для функции галлерее на главной страничке и т.д.
    public static function getPhotoArr($PHOTOS){
        $res = "";
        if(!empty($PHOTOS['VALUE'])){
            //
            $photoArr = [];
            foreach($PHOTOS['VALUE'] as $p=>$val){
                $photoArr[$p] = ['VALUE'=>$val,'DESCRIPTION'=>$PHOTOS['DESCRIPTION'][$p]];
            }
            $photoArr = array_chunk($photoArr, 3, false);
            for ($ps=0; $ps<2; $ps++){
                if(!empty($photoArr[$ps])){
                    //
                }
            }
        }
        return $res;
    }
}