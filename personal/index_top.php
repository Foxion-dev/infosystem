<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
global $USER, $APPLICATION;
if($USER->IsAuthorized() && CModule::IncludeModule('iblock') && CModule::IncludeModule("sale")):
//
    $UP = [];
    $UPN = []; // имя, фам, отчетво
    $USER_ID = $USER->GetID();
    $filter = array("ID"=>$USER_ID);
    $UF = array("UF_STATUS","UF_OGRM","UF_OKPO","UF_INN","UF_KPP","UF_URA","UF_FCA","UF_BR","UF_DR");
    $FIELDS = array("ID","LOGIN","NAME","LAST_NAME","SECOND_NAME","EMAIL","PERSONAL_PHONE","WORK_COMPANY","PERSONAL_ZIP","PERSONAL_CITY","PERSONAL_STATE","PERSONAL_STREET","WORK_POSITION");
    $arParameters = array("FIELDS"=>$FIELDS, "SELECT"=>$UF);
    $rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $arParameters); // выбираем пользователей
    if($rsUsersProp = $rsUsers->GetNext()){
        $UP = $rsUsersProp;
        $UPN[] = $rsUsersProp['LAST_NAME'];
        $UPN[] = $rsUsersProp['NAME'];
        $UPN[] = $rsUsersProp['SECOND_NAME'];
    }
?>
<div class="container the-cards personal-user">
    <div class="row">
        <div class="col-12" style="margin-bottom: 10px;">
            <div class="the-cards-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="personal-user-bottom">
                        <i class="fa fa-user" aria-hidden="true"></i><br />
                        <div class="row">
                        	<div class="col-auto">
                        		 <table style="margin-left: 17px">
		                        	<tr>
		                        		<td><b>Имя:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["NAME"] == "" ? "-" : $UP["NAME"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>Фамилия:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["LAST_NAME"]== "" ? "-" : $UP["LAST_NAME"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>Отчество:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["SECOND_NAME"]== "" ? "-" : $UP["SECOND_NAME"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>E-mail:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["EMAIL"]== "" ? "-" : $UP["EMAIL"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>Телефон:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["PERSONAL_PHONE"]== "" ? "-" : $UP["PERSONAL_PHONE"]?></td>
		                        	</tr>
		                        </table>
                        	</div>
                        	<div class="col-auto">
                        		 <table style="margin-left: 17px">
		                        	<tr>
		                        		<td><b>Компания:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["WORK_COMPANY"] == "" ? "-" : $UP["WORK_COMPANY"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>Должность:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["WORK_POSITION"]== "" ? "-" : $UP["WORK_POSITION"]?></td>
		                        	</tr>
		                        	<tr>
		                        		<td><b>Город:</b></td>
		                        		<td style="padding:  0px 0px 0px 10px;"><?=$UP["PERSONAL_CITY"]== "" ? "-" : $UP["PERSONAL_CITY"]?></td>
		                        	</tr>
		                        </table>
                        	</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12" style="text-align: right;">
                    	<div style="padding: 10px;">
                    	<?/*
                    	<button type="submit" style="width: auto;" class="personal-user-button button button--common button--primary" onclick="window.location.replace('/personal/')">Мои курсы</button>
                    	<button type="submit" style="width: auto;" class="personal-user-button button button--common button--primary" onclick="window.location.replace('/personal/calendar/')">Избранные курсы</button>
                    	*/?>
                    	<button type="submit" style="width: auto;padding: 22px 40px;" class="personal-user-button button button--common button--primary" onclick="window.location.replace('/personal/order/')">Мои заказы</button>
                    	<button type="submit" style="width: auto;padding: 22px 40px;" class="personal-user-button button button--common button--primary" onclick="window.location.replace('/personal/private/')">Редактировать профиль</button>
                    	</div>
                    </div>
                    <?/*
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 personal-user-right">
                      <div class="personal-user-text-left" style="padding: 20px 20px;">
                        <? //p($UP,'p'); ?>
                        <div class="personal-user-work-position">
                          <label>Должность</label>
                          <h5><?=$UP['WORK_POSITION']?$UP['WORK_POSITION']:'укажите должность?'?></h5>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div style="padding: 20px 20px; ">
                        <? //p($UP,'p'); ?>
                        <div class="personal-user-work-position">
                          <label>Компания</label>
                          <h5><?=$UP['WORK_COMPANY']?$UP['WORK_COMPANY']:'укажите компанию?'?></h5>
                        </div>
                        <button type="submit" class="personal-user-button button button--common button--primary" onclick="window.location.replace('/personal/private/')">Реквизиты</button>
                      </div>
                    </div>*/?>
                </div>
                <?/*<? if(!empty($UP['UF_STATUS'])): ?>
                    <? //
                    $rsGender = CUserFieldEnum::GetList([],["ID"=>$arUser["UF_STATUS"]]);
                    while($arGender = $rsGender->GetNext()) {
                        //
                        if($arGender['ID']==$UP['UF_STATUS']){
                            ?><div class="UF_STATUS">Статус: <?=$arGender['VALUE']?></div><?
                        }
                    } ?>
                <? endif; ?>
                <? if(!empty($UP['PERSONAL_PHONE'])): ?><p>Телефоны:<br> <?=$UP['PERSONAL_PHONE']?></p><? endif; ?>
                <? if(!empty($UP['EMAIL'])): ?><p>e-mail:<br> <?=$UP['EMAIL']?></p><? endif; ?>
                <? if(!empty($UP['PERSONAL_ZIP'])): ?><p>Адрес:<br> <?=implode(" ",[$UP['PERSONAL_ZIP'],$UP['PERSONAL_CITY'],$UP['PERSONAL_STATE'],$UP['PERSONAL_STREET']])?></p><? endif; ?>
                <? if(!empty($UP['WORK_COMPANY'])): ?><p>Название организации:<br> <?=$UP['WORK_COMPANY']?></p><? endif; ?>*/?>
            </div>
        </div>
        <?/*<div class="col-12 col-md-12 col-lg-6" style="margin-bottom: 10px;">
            <div class="the-cards-body">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="personal-user-right-bottom">
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 personal-user-right-right">
                        <div class="personal-user-text personal-user-text-left">
                          <? if(!empty($UP['UF_STATUS'])){ ?>
                            <? //
                            $rsGender = CUserFieldEnum::GetList([],["ID"=>$arUser["UF_STATUS"]]);
                            if($arGender = $rsGender->GetNext()){
                              //
                              if($arGender['ID']==$UP['UF_STATUS']){
                                ?>Статус: <span class="personal-user-status"><?=$arGender['VALUE']?></span><?
                              }
                            }else{ ?>Статус: <span class="personal-user-status">новичок</span><? } ?>
                          <?  }else{ ?>Статус: <span class="personal-user-status">новичок</span><? } ?>
                        </div>
                      </div>
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 personal-user-body">
                          <div class="personal-user-text">
                              мои Бонусы: <a href="/personal/account/" class="personal-user-bonuses">
                                  <? if($arr = CSaleUserAccount::GetByUserID($UP['ID'], "RUB")){ ?>
                                      <?=number_format($arr["CURRENT_BUDGET"], 0, '', ' ')?>
                                  <? }else{ echo '0'; } ?>
                                </a>
                          </div>
                          <a class="personal-user-bonuses-url" href="/personal/account/"  data-toggle="tooltip" data-placement="bottom" data-original-title="Пополнить личный счет 1 бонус = 1 руб.">Пополнить</a>
                      </div>
                    </div>
                  </div>
                  <div class="personal-user-right-gift">
                    <span class="gift-catalog-header">Купите за бонусы</span>
                    <div class="gift-catalog">
                      <a href="/gift/" class="gift-catalog-10"></a>
                      <a href="/gift/" class="gift-catalog-20"></a>
                      <a href="/gift/" class="gift-catalog-30"></a>
                      <a href="/gift/" class="gift-catalog-40"></a>
                      <a href="/gift/" class="gift-catalog-50"></a>
                    </div>
                    <button type="submit" data-toggle="tooltip" data-placement="bottom" data-original-title="Каталог подарков за бонусы" class="personal-user-button-right button button--common button--primary" onclick="window.location.replace('/gift/')">Каталог подарков</button>
                  </div>
                </div>
              </div>
                <?/*<div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                    <div style="border-bottom: 1px solid #77b509; height: 72px;">
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="border-right: 1px solid #77b509;">
                          <div style="padding-top: 25px; text-align: center; font-size: 18px; text-transform: uppercase;     font-family: 'OpenSans-ExtraBold', Arial, Tahoma, Sans-Serif;">
                            статус: новичок
                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                          <div style="padding-top: 25px; text-align: center; font-size: 18px; text-transform: uppercase;     font-family: 'OpenSans-ExtraBold', Arial, Tahoma, Sans-Serif;">
                            мои Бонусы: 898
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-lg-12">
                    <div style="height: 100%"></div>
                  </div>
                </div>*/?>
                <?/*<p style="line-height: 24px;">
                    <? if(!empty($UP['UF_OGRM'])): ?>ОГРН: <?=$UP['UF_OGRM']?><br><? endif; ?>
                    <? if(!empty($UP['UF_OKPO'])): ?>ОКПО: <?=$UP['UF_OKPO']?><br><? endif; ?>
                    <? if(!empty($UP['UF_INN'])): ?>ИНН: <?=$UP['UF_INN']?><br><? endif; ?>
                    <? if(!empty($UP['UF_KPP'])): ?>КПП: <?=$UP['UF_KPP']?><br><? endif; ?>
                    <? if(!empty($UP['UF_URA'])): ?>Юридический адрес: <?=$UP['UF_URA']?><br><? endif; ?>
                    <? if(!empty($UP['UF_FCA'])): ?>Фактический адрес: <?=$UP['UF_FCA']?><br><? endif; ?>
                    <? if(!empty($UP['UF_BR'])): ?>Банковские реквизиты: <?=$UP['UF_BR']?><br><? endif; ?>
                    <? if(!empty($UP['UF_DR'])): ?>Директор: <?=$UP['UF_DR']?><? endif; ?>
                </p>*/?>
        <?/*    </div>
        </div>*/?>
    </div>
</div>
<? endif; ?>