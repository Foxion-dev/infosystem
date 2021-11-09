<?
if(CModule::IncludeModule('iblock')){
	//CIBlockProperty()
	$filter = $this->arParams['ACTIVE_FILTER'];
	$sort = $this->arParams['ACTIVE_SORT'];
	$GLOBALS[$filter]=[];
	$GLOBALS[$sort]=[];
	$iblock=$this->arParams['IBLOCK_ID'];
	if(!empty($_GET['SORT'])){
		if(explode(',',$_GET['SORT'])[0]=='DATES'){
			$GLOBALS[$sort]['PROPS']='PROPERTY_DATE';	
		}else{
			$GLOBALS[$sort]['PROPS']='CATALOG_PRICE_1';
		}
		$GLOBALS[$sort]['ORDER']=explode(',',$_GET['SORT'])[1].',nulls';
	}
	//if(!empty($_GET['SORT'])){
	//	$GLOBALS[$sort]['PROPS']='CATALOG_PRICE_1';
	//	$GLOBALS[$sort]['ORDER']=$_GET['SORT'];
	//}


	if(!empty($_GET['DATE']) && false){
		if(stripos($_GET['DATE'],'.')==2){
			$date = $_GET['DATE'];
			$date = explode('.',$date);
			$GLOBALS[$filter]['PROPERTY_DATES'] = $date[1].'-'.$date[0].'%';
		}else{
			$GLOBALS[$filter]['PROPERTY_DATES'] ='%'.$_GET['DATE'].'%';
		}
	}
	
	if(!empty($_GET['DATE'])){
		foreach(array_keys($_GET['DATE']) as $key){
			if(stripos($_GET['DATE'][$key],'.')==2){
				$date = $_GET['DATE'][$key];
				$date = explode('.',$date);
				$GLOBALS[$filter]['PROPERTY_DATES'][] = $date[1].'-'.$date[0].'%';
			}else{
				$GLOBALS[$filter]['PROPERTY_DATES'][] ='%'.$_GET['DATE'][$key].'%';
			}		
		}
	}
	unset($key);

	
	if(!empty($_GET['FORM_TRAINING'])&&$_GET['FORM_TRAINING']!='all'){
		$GLOBALS[$filter]['PROPERTY_FORM_TRAINING_NEW']=$_GET['FORM_TRAINING'];
	}
	if(!empty($_GET['VENDOR'])&&$_GET['VENDOR']!='all'){
		$GLOBALS[$filter]['PROPERTY_VENDOR']=$_GET['VENDOR'];
	}
	if(!empty($_GET['NEW'])&&$_GET['NEW']=='Y'){
		$GLOBALS[$filter]['PROPERTY_NEWPRODUCT']='Да';
	}
	if(!empty($_GET['FREE'])){
		$GLOBALS[$filter]['CATALOG_PRICE_1']=0;
	}
	if(empty($_GET['OPEN'])){
		$GLOBALS[$filter]['>PROPERTY_DATES']=array(date('Y-m-d').' 23:59:59', false);
	}else{
		//unset($GLOBALS[$filter]['>PROPERTY_DATES']);
		$GLOBALS[$filter]['PROPERTY_DATES']=false;
	}
	$filter_value=[
		'IBLOCK_ID'=>$iblock,
	];
	
	
	if(empty($this->arParams['SECTION_ID'])){
		$filter_value['SECTION_ID']=$this->arParams['SECTION_ID'];
		$filter_value['INCLUDE_SUBSECTIONS']='Y';
		$filter_value['SECTION_GLOBAL_ACTIVE']='Y';
	}else{
		
	}
	$res=CIBlockElement::GetList([],$filter_value,false,false,['PROPERTY_DATES','PROPERTY_FORM_TRAINING_NEW']);
	$vendors=[];
	$res_vendor=CIBlockElement::GetList(['SORT' => 'ASC'],['IBLOCK_ID'=>27, 'ACTIVE' => 'Y'],false,false,['ID','NAME']);
	while($r_v=$res_vendor->Fetch()){
		$vendors[$r_v['ID']]=$r_v;
		$vendors[$r_v['ID']]['SELECTED']=false;
		if(!empty($_GET['VENDOR'])&&$_GET['VENDOR']==$r_v['ID']){
			$vendors[$r_v['ID']]['SELECTED']=true;
		}
	}
	$form_training=[];
	$dates=[];
	while($r=$res->Fetch()){

		if(!empty($r['PROPERTY_FORM_TRAINING_NEW_VALUE'])){
			//$form_training[]=$r['PROPERTY_FORM_TRAINING_NEW_VALUE'];
			$form_training[$r['PROPERTY_FORM_TRAINING_NEW_ENUM_ID']]['NAME']=$r['PROPERTY_FORM_TRAINING_NEW_VALUE'];
			$form_training[$r['PROPERTY_FORM_TRAINING_NEW_ENUM_ID']]['ID']=$r['PROPERTY_FORM_TRAINING_NEW_ENUM_ID'];
		}
		$dates[]=explode(' ',$r['PROPERTY_DATES_VALUE'])[0];
	}


	//$form_training=array_unique($form_training);

	$dates=array_unique($dates);
	$filter_date=[];
	foreach($dates as $date_for_filter){
		if(!empty($date_for_filter))
			$filter_date[]=explode('.',$date_for_filter)[2];
	}
	$filter_date=array_flip(array_unique($filter_date));
	foreach($filter_date as &$year){
		$year=[];
	}
	unset($year);
	foreach($dates as $date_for_filter){
		if(!empty($date_for_filter)){
			$compose_date=explode('.',$date_for_filter);
			$filter_date[$compose_date[2]][]=$compose_date[1];
		}
	}
	$months=[
		'01'=>'Январь',
		'02'=>'Февраль',
		'03'=>'Март',
		'04'=>'Апрель',
		'05'=>'Май',
		'06'=>'Июнь',
		'07'=>'Июль',
		'08'=>'Август',
		'09'=>'Сентябрь',
		'10'=>'Октябрь',
		'11'=>'Ноябрь',
		'12'=>'Декабрь'
	];
	foreach($filter_date as $year=>&$d){
		$d=array_unique($d);
		sort($d);
		$tmp_d=array_flip($d);
		$d=[];
		$d['MONTHS']=$tmp_d;
		$d['SELECTED']=false;
		if(!empty($_GET['DATE'])&&$_GET['DATE']==$year){
			$d['SELECTED']=true;	
		}

		foreach($d['MONTHS'] as $key=>&$month){
			$month=[
				'NAME'=>$months[$key],
				'SELECTED'=>false
			];
			if(!empty($_GET['DATE'])&& in_array($key.'.'.$year, $_GET['DATE'])){
				$month['SELECTED']=true;
			}
		}
		unset($key);
		unset($month);
	}
	
	unset($d);
	foreach($form_training as $key=>&$f_t){
		$tmp_name=$f_t;
		$f_t=[
			'NAME'=>$tmp_name['NAME'],
			'VALUE'=>$tmp_name['ID'],
			'SELECTED'=>false
		];
		if(!empty($_GET['FORM_TRAINING'])&&$_GET['FORM_TRAINING']==$tmp_name['ID']){
			$f_t['SELECTED']=true;
		}
	}
	unset($f_t);
	$this->arResult['VENDORS']=$vendors;
	$this->arResult['DATES']=$filter_date;
	$this->arResult['FORM_TRAINING']=$form_training;
	$this->IncludeComponentTemplate(); 	
}
