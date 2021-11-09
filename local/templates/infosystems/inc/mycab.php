<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<? global $USER; ?>
<? if($USER->IsAuthorized() && CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')){ ?>
    <!--<a href="/personal/" class="button button--common button--primary login-button"><span class="glyphicon glyphicon-search"></span> персональный раздел</a>-->
    <div id="mycabBody">
        <button type="button" class="button button--common button--primary login-button" id="mycab" data-toggle="dropdown">
            <span><?=$USER->GetEmail();?></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="mycab">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/">Личный кабинет</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/order/">Мои заказы</a></li>
            <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/refill-balance/"><span class="glyphicon glyphicon-piggy-bank"></span> Кошелёк</a></li>-->
            <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/private/">Настройки</a></li>-->
            <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/favorites/"><span class="fa fa-heart"></span> Избранное</a></li>-->
            <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/"><span class="glyphicon glyphicon-envelope"></span>  Мои подписки</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/personal/savedsearch/"><span class="glyphicon glyphicon-th-list"></span>  Сохраненные запросы</a></li>-->
            <li role="presentation"><a role="menuitem" tabindex="-1" href="?logout=yes">Выход</a></li>
        </ul>
    </div>

<? } ?>
