<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); LocalRedirect('/academy/news/', false, '301 Moved Permanently'); exit(); ?>

<? //
function get_date($date){
    if(!$date) return '';
    $am = [
        'Января' => '01',
        'Февраля' => '02',
        'Марта' => '03',
        'Апреля' => '04',
        'Мая' => '05',
        'Июня' => '06',
        'Июля' => '07',
        'Августа' => '08',
        'Сентября' => '09',
        'Октября' => '10',
        'Ноября' => '11',
        'Декабря' => '12',
    ];
    $date = explode(' ',$date);
    return $date[0].".".$am[$date[1]].".".$date[2];
}
$pg = json_decode(file_get_contents(dirname(__FILE__)."/pgs.txt"));
// $pg = array_reverse($pg);
p(count($pg),'p');
foreach ($pg as $k=>&$p):
    $p = (array)$p;
    // if(!$p['date']) continue;
    $p['date'] = get_date($p['date']);
    if($k==675){ $p['date'] = '02.07.2015'; }
    if($k==268){ $p['date'] = '18.11.2009'; }
    if($k==269){ $p['date'] = '27.10.2009'; }
    if($k==266){ $p['date'] = '15.10.2009'; }
    if($k==409){ $p['date'] = '06.09.2011'; }
    if($k==478){ $p['date'] = '19.11.2012'; }
    if($k==152){ $p['date'] = '19.10.2016'; }
   /* if(strlen(trim($p['date']))==0){
        p($k." ".$p['date']." ".$p['title']." ".$p['link']." ".$p['urls'],'p');
        p($p['teaser'],'p');
    }*/
    $p['sort'] = strtotime($p['date']);
    //p($k." ".$p['date']." ".$p['sort']." ".$p['title']." ".$p['link']." ".$p['urls'],'p');
endforeach;

print '<hr>';
array_multisort (array_column($pg, 'sort'), SORT_ASC, $pg);
if(CModule::IncludeModule("iblock") && CModule::IncludeModule("main")) {
    foreach ($pg as $k => $p):
        //if ($k == 4) break;
        p($k . " " . $p['date'] . " " . $p['sort'] . " " . $p['title'] . " " . $p['link'] . " " . $p['urls'], 'p');
        //p($p,'p');
        // DETAIL_TEXT_TYPE = 'html'
        // PREVIEW_TEXT_TYPE = 'html'
        /*
        $el = new CIBlockElement;
        $arField = [
            "MODIFIED_BY" => 1,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => 1,
            "PROPERTY_VALUES" => [],
            "NAME" => $p['title'],
            "CODE" => Cutil::translit($p['title'], "ru", ["replace_space" => "-", "replace_other" => "-"]),
            "ACTIVE" => "Y", // активен
            'ACTIVE_FROM' => $p['date'],
            "PREVIEW_TEXT" => $p['teaser'],
            "PREVIEW_TEXT_TYPE" => 'html',
            "DETAIL_TEXT" => html_entity_decode($p['content']),
            "DETAIL_TEXT_TYPE" => 'html',
        ];
        */
        // p($arField,'p');
        /*
        $ELEMENT_ID = $el->Add($arField);
        p($ELEMENT_ID,'p');
        */
    endforeach;
}