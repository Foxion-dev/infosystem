
var MainObject = {
    init: function() {
        $.mask.definitions['~'] = "[+-]";
        $('input.phone').mask('+7 (999) 999-9999');
        $('input.phone-mask').mask('+9 (999) 999-9999');
        /**/
        $('body').on('click','.commercial-offer', function (event) {
            event.preventDefault();
            var $go = "CommercialOffer";
            var $val = $(this).attr("rel"), $title = $(this).text(), $zakaz = $(this).attr("data-zakaz");
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: block;">Заполните простую форму ниже. Мы свяжемся с вами в кратчайшее время!</div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var textInput  = '<div class="form-group"><label>Фамилия, Имя и Отчество:<span class="starrequired">*</span></label><input name="NAME_USER" type="text" class="form-control input-lg req" placeholder="Ваше Ф.И.О"></div>';
            var textMail  = '<div class="form-group col-6"><label>Ваш e-mail:<span class="starrequired">*</span></label><input name="EMAIL_USER" type="text" class="form-control input-lg e-mail req" placeholder=""></div>';
            var textPhones  = '<div class="form-group col-6"><label>Телефон:<span class="starrequired">*</span></label><input name="TELEFON_USER" type="text" class="form-control input-lg phone req" placeholder=""></div>';
            var textCount = '<div class="row">'+ textMail + textPhones +'</div>';
            /**/
            var textInput01  = '<div class="form-group"><label>Ваша должность:<span class="starrequired">*</span></label><input name="WORK_USER" type="text" class="form-control input-lg req" placeholder="Например коммерческий директор"></div>';
            var textInput02  = '<div class="form-group col-6"><label>Количество человек:<span class="starrequired">*</span></label><input name="NUM_USER" type="text" class="form-control input-lg req" placeholder="Например 2 шт."></div>';
            var textInput03  = '<div class="form-group"><label>Сроки обучения (от/до):<span class="starrequired">*</span></label><div class="row"><div class="col-6"><input name="USER_TIME_FROM" type="text" class="form-control input-lg term req" placeholder=""></div><div class="col-6"><input name="USER_TIME_BEFORE" type="text" class="form-control input-lg term req" placeholder=""></div></div></div>';
            var textInput04  = '<div class="form-group col-6"><label>Место обучения:<span class="starrequired">*</span></label><input name="CITY_USER" type="text" class="form-control input-lg req" placeholder="Москва (город)"></div>';
            var checkInput  = '<div class="form-group"><label class="cbLabel"><input type="checkbox" name="sendCopy" class="req" value="1"><span></span> Согласен(на) на обработку персональных данных</label></div>';
            /**/
            var CS = '<div class="form-group"><label>КП в официальной или неофициальной форме?:<span class="starrequired">*</span></label><select name="USER_CS" type="text" class="form-control input-lg req"><option value="officer">КП официальное</option><option value="notofficer">КП не официальное</option></select></div>';
            var dispatch  = '<div class="form-group"><label class="cbLabel"><input type="checkbox" name="DISPATCH" class="" value="Y" checked><span></span> Я соглашаюсь получать новостные рассылки АИС</label></div>';
            var refinement = '<div class="form-group"><label>Уточняющая информация:</label><textarea name="COMMENT" cols="2" type="text" class="form-control input-lg" placeholder=""></textarea></div>';
            /**/
            var hiddenInput0  = '<input type="hidden" name="ID" value="'+$val+'">';
            var hiddenInput1  = '<input type="hidden" name="CODE" value="'+$(this).text()+'">';
            var hiddenInput2  = '<input type="hidden" name="ELEMENT_NAME" value="'+$(this).attr("data-name")+'">';
            var textBody = '<form action="/" method="post" role="form" class="SubmitFormAjax commercialOffer">' + hiddenInput0 + hiddenInput1 + hiddenInput2 + messegeText + '<div class="row input-form"><div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">'  + textInput + textInput01 + textCount  + dispatch  + checkInput  + ' </div><div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"> ' + '<div class="row">' + textInput02 + textInput04 + '</div>' + textInput03  + CS + refinement + '<input name="go" type="hidden" value="'+ $go +'"><input type="submit" style="display: none;" value="Y"></div></div></form>';
            showMessageForm(textBody, $zakaz, "Закрыть", "Отправить", 2);
            $('.modal-backdrop').addClass('modal-backdrop-inverse');
            $('input.phone').mask('+7 (999) 999-9999');
            $('input.term').mask('99.99.9999');
            return false;
        });
        /**/
        $('body').on('click','.file-value-handout', function (event) {
            event.preventDefault();
            var $val = $(this).attr("rel"), $titleFiles = $(this).attr("title");
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/",
                data: {go:"fileValueHandout", goMetod:"fileValueHandoutForm", title:$titleFiles, rel:$val},
                success: function(res){
                    closeWait();
                    if(res.html){
                        showMessageForm(res.html, res.title, res.cansel, res.submit, res.mClass);
                        $('input.phone').mask('+7 (999) 999-9999');
                    }
                    if(res.error){ showMessage(res.error, res.title, res.cansel); }
                    if(res.alert){ showMessage(res.alert, res.title, res.cansel); }
                }
            });
            return false;
        });
        /**/
        $('body').on('click','a.email', function (event) {
            /*event.preventDefault();
            var val = $(this).attr("rel");
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var textInput  = '<div class="form-group"><label>Имя *</label><input name="NAME" type="text" class="form-control input-lg req" placeholder="Ваше имя"></div>';
            var checkInput  = '<div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> Согласен(на) на обработку персональных данных</label></div>';
            var textInput1  = '<div class="form-group"><label>Телефон *</label><input name="TELEFON" type="text" class="form-control input-lg req phone" placeholder=""></div>';
            var textInput2  = '<div class="form-group"><label>Ваш e-mail *</label><input name="EMAIL_USER" type="text" class="form-control input-lg req" placeholder=""></div>';
            var textInput2  = textInput2 + '<div class="form-group"><label>Тема *</label><select name="THEMES_USER" type="text" class="form-control input-lg req"><option value="question" '+(val=="question"?"selected":"")+'>Оставить вопрос специалисту</option><option value="advertising" '+(val=="advertising"?"selected":"")+'>Вопрос сотрудничества/рекламы</option><option value="help" '+(val=="help"?"selected":"")+'>Не нашел в каталоге?</option></select></div>';
            var textInput2  = textInput2 + '<div class="form-group"><label>Комментарий *</label><textarea name="COMMENT" cols="2" type="text" class="form-control input-lg req" placeholder=""></textarea></div>';
            var textBody = '<form action="/" method="post" role="form" class="SubmitFormAjax">' + messegeText + '<div class="row input-form"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' + textInput + ' ' + textInput1 + textInput2 + checkInput  +'<input name="go" type="hidden" value="orderMaterial"><input type="submit" value="Ok" style="display: none"></div></div></form>';
            showMessageForm(textBody, "Сообщение", "Закрыть", "Отправить", 1);
            /*$(".popup-form").append('<div class="modal-button-close hidden-xs"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></div>');
            $('.modal-backdrop').addClass('modal-backdrop-inverse');
            $('input.phone').mask('+7 (999) 999-9999');
            /*$("select[name='THEMES_USER']").niceSelect();
            return false;*/
        });
        /* submit_class */
        $('body').on('click', '.submit_class', function (event) {
            event.preventDefault();
            var form = $(this).parent().parent("div.modal-content").find("form input.submit-form");
            /* если есть input.submit-form то вызываем addFormSubmit если нет его то вызываем красавицу addFormSubmitNew */
            form = ((form.length != 0)?form:$(this).parent().parent("div.modal-content").find("form input[type='submit']"));
            form.click();
            return false;
        });
        /* fancybox its cool */
        $(".fancy").fancybox({maxWidth: 800, maxHeight: 600, padding:3});
        $(".fancybox").fancybox({maxWidth: 800, maxHeight: 600, padding:3});
        $(".fancybox-media").fancybox({
            'openEffect'  : 'none',
            'closeEffect' : 'none',
            'helpers' : {
                'media' : {}
            }
        });
        /**/
        $('body').on("submit", "form.SubmitFormAjax", addFormSubmitNew);
        $('body').on('click', '.submit-form', addFormSubmit);
        $('body').on('click', '.bx-rating-disabled', function (event) {
            event.preventDefault();
            showMessage('Чтобы проголосовать авторизуйтесь или зарегистрируйтесь');
            return false;
        });
        /**/
        $('body').on('click','#mycab',function(event){
            event.preventDefault();
            $("#mycabBody ul.dropdown-menu").slideToggle(100);
            $(this).toggleClass("active");
            return false;
        });
        /* add favorit */
        $('body').on('click','.favor', function (event) {
            event.preventDefault();
            var $val = $(this).attr("data-item"), $title = $(this).text();
            var $doAction = ($(this).hasClass('active')?'delete':'add');
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/",
                data: {go:"addFavoritUser", title:$title, ID:$val, doAction:$doAction},
                success: function(res){
                    closeWait();
                    if(res.jq){ JQ(res.jq); }
                    if(res.alert){ showMessage(res.alert, res.title, res.cansel); }
                    if(res.error){ showMessage(res.error, res.title, res.cansel); }
                }
            });
            return false;
        });
        /* add myCalendar */
        $('body').on('click','.myCalendar', function (event) {
            event.preventDefault();
            var $val = $(this).attr("data-item"), $title = $(this).text();
            var $doAction = ($(this).hasClass('active')?'delete':'add');
            showWait();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/",
                data: {go:"addCalendarUser", title:$title, ID:$val, doAction:$doAction},
                success: function(res){
                    closeWait();
                    if(res.jq){ JQ(res.jq); }
                    if(res.alert){ showMessage(res.alert, res.title, res.cansel); }
                    if(res.error){ showMessage(res.error, res.title, res.cansel); }
                }
            });
            return false;
        });
        /* tooltip */
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('body').on('click','.popular-coursers-filter-click', function (event) {
            event.preventDefault();
            $('#smartfilter').modal();
            return false;
        });
        /* .footer-menu-section .footer-menu .heading */
        $('body').on('click','.footer-menu-section .footer-menu h5.heading', function (event) {
            event.preventDefault();
            $(this).parent().find('ul.menu-list').toggle(300);
            return false;
        });
        /* .search-root-item-click */
        $('body').on('click','.search-root-item-click',function(event){
            event.preventDefault();
            $("div.search-panel").slideToggle(300);
            $(this).toggleClass("search-root-item-click-active");
            /*$("body").getNiceScroll().hide();*/
            // $("body").getNiceScroll().resize();
            console.log('56565');
            return false;
        });
    }
}
/*Для показа во весь экран отзывов*/
var showMessageRev = function(text, title, cansel, mClass){
    /**/
    $(".popup-form").remove();
    $(".modal-backdrop").remove();
    var modalClass = ["modal-sm","modal-mid","modal-fh"];
    var mClass = (mClass ? mClass: 0);
    var cansel = (cansel ? cansel : false);
    var submit = (submit ? submit : "Отправить");
    var title = (title ? title : "Сообщение");
    var modalHeader = $('<div/>').addClass('modal-header').append('<h4 class="modal-title" id="popup-form">'+ title +'</h4>' + '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>');
    var modalBody = $('<div/>').addClass('modal-body').append(text);
    var modalFooter = (cansel ? $('<div/>').addClass('modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal">'+ cansel +'</button>') : '');
    /**/
    var modalContent = $('<div/>').addClass('modal-content').append(modalHeader).append(modalBody).append(modalFooter);
    var modalDialog = $('<div/>').addClass('modal-dialog').addClass(modalClass[mClass]).html(modalContent);
    var popup = $('<div/>').addClass('popup-form').addClass('modal').addClass('fade').attr("tabindex", -1).attr("role", "dialog").attr("aria-labelledby", "popup-form").append(modalDialog).appendTo('body');
    $('.popup-form').modal();
	//$('.modal-fh').css('max-height', $(window).height() * 0.7).css('width', 'auto').css('height', $(window).height() * 0.7);;
}
/**/
var showMessage = function(text, title, cansel, mClass){
    /**/
    $(".popup-form").remove();
    $(".modal-backdrop").remove();
    var modalClass = ["modal-sm","modal-md","modal-lg"];
    var mClass = (mClass ? mClass: 0);
    var cansel = (cansel ? cansel : false);
    var submit = (submit ? submit : "Отправить");
    var title = (title ? title : "Сообщение");
    var modalHeader = $('<div/>').addClass('modal-header').append('<h4 class="modal-title" id="popup-form">'+ title +'</h4>' + '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>');
    var modalBody = $('<div/>').addClass('modal-body').append(text);
    var modalFooter = (cansel ? $('<div/>').addClass('modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal">'+ cansel +'</button>') : '');
    /**/
    var modalContent = $('<div/>').addClass('modal-content').append(modalHeader).append(modalBody).append(modalFooter);
    var modalDialog = $('<div/>').addClass('modal-dialog').addClass(modalClass[mClass]).html(modalContent);
    var popup = $('<div/>').addClass('popup-form').addClass('modal').addClass('fade').attr("tabindex", -1).attr("role", "dialog").attr("aria-labelledby", "popup-form").append(modalDialog).appendTo('body');
    $('.popup-form').modal();
}

/* showMessageForm */
var showMessageForm = function(text, title, cansel, submit, mClass){
    $(".popup-form").remove();
    $(".modal-backdrop").remove();
    var modalClass = ["modal-sm","modal-md","modal-lg"];
    var mClass = (mClass ? mClass: 0);
    var cansel = (cansel ? cansel : "Закрыть");
    var submit = (submit ? submit : "Отправить");
    var title = (title ? title : "Сообщение");
    var modalHeader = $('<div/>').addClass('modal-header').append('<h5 class="modal-title" id="popup-form">'+ title +'</h5>' + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    var modalBody = $('<div/>').addClass('modal-body').addClass('showMessageForm').append(text);
    var modalFooter = $('<div/>').addClass('modal-footer').append('<!--<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">'+ cansel +'</button>-->' +' '+ '<button type="button" class="button button--common button--primary submit_class">'+ submit +'</button>');
    /**/
    var modalContent = $('<div/>').addClass('modal-content').append(modalHeader).append(modalBody).append(modalFooter);
    var modalDialog = $('<div/>').addClass('modal-dialog').addClass('modal-order').addClass(modalClass[mClass]).html(modalContent);
    var popup = $('<div/>').addClass('popup-form').addClass('modal').addClass('fade').attr("tabindex", -1).attr("role", "dialog").attr("aria-labelledby", "popup-form").append(modalDialog).appendTo('body');
    $('.popup-form').modal();
}

var showWait = function (text) {
    $(".showWait").remove();
    var scrolled = window.pageYOffset || document.documentElement.scrollTop; /* узнаем отступ от прокрутки окна чтобы было видно загрузчик и т.д. */
    scrolled = scrolled + 20;
    var sw = $('<div/>').addClass('showWait').css('top', scrolled+'px').append('<img src="/local/templates/infosystems/images/ajax/index.double-ring-spinner.svg">').appendTo('body');
    return false;
}

var closeWait = function () {
    $(".showWait").remove();
    return false;
}

/* функция скачивания файла и т.д. */
var downloadFile = function(filePath) {
    var link = document.createElement('a');
    link.href = filePath;
    link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
    link.click();
}

/* addFormSubmitNew */
var addFormSubmitNew = function (event) {
    event.preventDefault();
    var req = $(this).find('.req');
    var error = false;
    var url = $(this).attr("action");
    req.each(function() {
        /* если не checkbox */
        if($(this).attr('type') != "checkbox") {
            if ($(this).val() == "") {
                $(this).css('border-color', 'red');
                if ($(this).parent().find('.req-notice').length == 0) {
                    $(this).parent().append('<span class=req-notice>Заполните пожалуйста все поля</span>');
                }
                error = true;
            } else {
                $(this).css('border-color', '#8cd50b');
                $(this).parent().find('.req-notice').remove();
            }
        }
        /* если он checkbox */
        if($(this).attr('type') == "checkbox") {
            if($(this).prop("checked") == false){
                $(this).parent().find('span').css('border-color', 'red');
                /*if ($(this).parent().find('.req-notice').length == 0) {
                    $(this).parent().append('<span class=req-notice>заполните обязательное поле</span>');
                }*/
                error = true;
            }else{
                $(this).parent().find('span').css('border-color', '#8cd50b');
                $(this).parent().find('.req-notice').remove();
            }
        }
    });
    if(error){
        return false;
    }
    showWait();
    $.ajax({
        url: url,
        type: $(this).attr("method"),
        dataType: "JSON",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (res){
            closeWait();
            /*$(".js_popup").fadeOut(300);*/
            if(res.redirect_URL){
                if(res.html){ showMessage(res.html, res.title, res.cansel); }
                window.location.replace(res.redirect_URL);
            }else if(res.error){
                /**/
                showMessage(res.error, res.title, res.cansel);
            }else if(res.alert){
                /**/
                showMessage(res.alert, res.title, res.cansel);
                if(res.jq){ JQ(res.jq);	}
            }else if(res.reload){
                window.location.replace(document.URL);
            }else if(res.setcookie){
                /**/
                setcookie(res.setcookie, res.value, res.expires, res.path, res.domain, res.secure);
                /*setCookies(res.setcookie, res.value);*/
                if(res.jq){ JQ(res.jq); }
                if(res.redirect_link){ window.location.replace(res.redirect_link); }
            }else if(res.jq){
                /**/
                JQ(res.jq);
            }else if(res.download){
                /**/
                if(res.html){ showMessage(res.html, res.title, res.cansel); }
                downloadFile(res.download);
            }else{
                /**/
            }
        },
        error: function (res){
            closeWait();
        }
    });
    return false;
}

/* addFormSubmit */
var addFormSubmit = function(event, obj){
    event.preventDefault();
    $form = $(event.currentTarget);
    $form = $(this).filter('form');
    /**/
    if(!$form.length)
        $form = $(this).parents('form');
    if(
        (($form.attr('action') &&
            ($form.attr('action').substr(0, 1) == '/')) || $form.attr('action') === '') &&
        (!$form.parents('#panel').length)
    ){
        event.preventDefault();
        showWait();
        var data = $form.serialize();
        var action = $form.attr('action');
        /**/
        $.ajax({
            url: action,
            data: data,
            type: "POST",
            dataType: 'json',
            context: $form,
            success: function(res){
                /**/
                closeWait();
                /*$(".js_popup").fadeOut(300);*/
                if(res.redirect_URL){
                    if(res.html){ showMessage(res.html, res.title, res.cansel); }
                    window.location.replace(res.redirect_URL);
                }else if(res.error){
                    /**/
                    showMessage(res.error, res.title, res.cansel);
                }else if(res.alert){
                    /**/
                    showMessage(res.alert, res.title, res.cansel);
                    if(res.jq){ JQ(res.jq);	}
                }else if(res.reload){
                    window.location.replace(document.URL);
                }else if(res.setcookie){
                    /**/
                    setcookie(res.setcookie, res.value, res.expires, res.path, res.domain, res.secure);
                    /*setCookies(res.setcookie, res.value);*/
                    if(res.jq){ JQ(res.jq); }
                    if(res.redirect_link){ window.location.replace(res.redirect_link); }
                }else if(res.jq){
                    /**/
                    JQ(res.jq);
                }else if(res.download){
                    /**/
                    if(res.html){ showMessage(res.html, res.title, res.cansel); }
                    downloadFile(res.download);
                }else{
                    /**/
                }
            },
            error: function(res){
                closeWait();
            }
        });
        return false;
    }

}

/* JQ */
var JQ = function(jq) {
    $.each(jq, function(i, n){
        /**/
        switch (i) {
            case "remove":
                $.each(n, function(select, value){
                    /**/
                    $(select).remove();
                });
                break;
            case "val":
                $.each(n, function(select, value){
                    /**/
                    $(select).val(value);
                });
                break;
            case "html":
                $.each(n, function(select, value){
                    /**/
                    $(select).html(value);
                });
                break;
            case "text":
                $.each(n, function(select, value){
                    /**/
                    $(select).text(value);
                });
                break;
            case "addClass":
                $.each(n, function(select, value){
                    /**/
                    $(select).addClass(value);
                });
                break;
            case "removeClass":
                $.each(n, function(select, value){
                    /**/
                    $(select).removeClass(value);
                });
                break;
            case "prepend":
                $.each(n, function(select, value){
                    /**/
                    $(select).prepend(value);
                });
                break;
            case "append":
                $.each(n, function(select, value){
                    /**/
                    $(select).append(value);
                });
                break;
            case "hide":
                $.each(n, function(select, value){
                    /**/
                    $(select).hide(value);
                });
                break;
            case "show":
                $.each(n, function(select, value){
                    /**/
                    $(select).show(value);
                });
                break;
            case "attr":
                $.each(n, function(select, value){
                    /**/
                    $(select).attr({"rel":value});
                });
                break;
            case "attributeName":
                $.each(n, function(select, value){
                    /**/
                    $.each(value, function(atr, px){
                        $(select).attr(atr, px);
                    });
                });
                break;
            case "CSS":
                $.each(n, function(select, value){
                    /**/
                    $.each(value, function(atr, px){
                        $(select).css(atr, px);
                        //$(select).attr(atr, px);
                    });
                });
                break;
            case "reset":
                $.each(n, function(select, value){
                    /**/
                    $(select).trigger('reset');
                });
                break;
            case "replaceWith":
                $.each(n, function(select, value){
                    /**/
                    $(select).replaceWith(value);
                });
                break;
            /* default: alert('***'); */
        }
    });
}

/*  unserialize  */
var unserialize = function(inp) {
    /* original by: Arpad Ray (mailto:arpad@php.net) */
    error = 0;
    if (inp == "" || inp.length < 2) {
        errormsg = "input is too short";
        return;
    }
    var val, kret, vret, cval;
    var type = inp.charAt(0);
    var cont = inp.substring(2);
    var size = 0, divpos = 0, endcont = 0, rest = "", next = "";

    switch (type) {
        case "N": // null
            if (inp.charAt(1) != ";") {
                errormsg = "missing ; for null";
            }
            // leave val undefined
            rest = cont;
            break;
        case "b": // boolean
            if (!/[01];/.test(cont.substring(0,2))) {
                errormsg = "value not 0 or 1, or missing ; for boolean";
            }
            val = (cont.charAt(0) == "1");
            rest = cont.substring(1);
            break;
        case "s": // string
            val = "";
            divpos = cont.indexOf(":");
            if (divpos == -1) {
                errormsg = "missing : for string";
                break;
            }
            size = parseInt(cont.substring(0, divpos));
            if (size == 0) {
                if (cont.length - divpos < 4) {
                    errormsg = "string is too short";
                    break;
                }
                rest = cont.substring(divpos + 4);
                break;
            }
            if ((cont.length - divpos - size) < 4) {
                errormsg = "string is too short";
                break;
            }
            if (cont.substring(divpos + 2 + size, divpos + 4 + size) != "\";") {
                errormsg = "string is too long, or missing \";";
            }
            val = cont.substring(divpos + 2, divpos + 2 + size);
            rest = cont.substring(divpos + 4 + size);
            break;
        case "i": // integer
        case "d": // float
            var dotfound = 0;
            for (var i = 0; i < cont.length; i++) {
                cval = cont.charAt(i);
                if (isNaN(parseInt(cval)) && !(type == "d" && cval == "." && !dotfound++)) {
                    endcont = i;
                    break;
                }
            }
            if (!endcont || cont.charAt(endcont) != ";") {
                errormsg = "missing or invalid value, or missing ; for int/float";
            }
            val = cont.substring(0, endcont);
            val = (type == "i" ? parseInt(val) : parseFloat(val));
            rest = cont.substring(endcont + 1);
            break;
        case "a": // array
            if (cont.length < 4) {
                errormsg = "array is too short";
                return;
            }
            divpos = cont.indexOf(":", 1);
            if (divpos == -1) {
                errormsg = "missing : for array";
                return;
            }
            size = parseInt(cont.substring(1, divpos - 1));
            cont = cont.substring(divpos + 2);
            val = new Array();
            if (cont.length < 1) {
                errormsg = "array is too short";
                return;
            }
            for (var i = 0; i + 1 < size * 2; i += 2) {
                kret = unserialize(cont, 1);
                if (error || kret[0] == undefined || kret[1] == "") {
                    errormsg = "missing or invalid key, or missing value for array";
                    return;
                }
                vret = unserialize(kret[1], 1);
                if (error) {
                    errormsg = "invalid value for array";
                    return;
                }
                val[kret[0]] = vret[0];
                cont = vret[1];
            }
            if (cont.charAt(0) != "}") {
                errormsg = "missing ending }, or too many values for array";
                return;
            }
            rest = cont.substring(1);
            break;
        case "O": // object
            divpos = cont.indexOf(":");
            if (divpos == -1) {
                errormsg = "missing : for object";
                return;
            }
            size = parseInt(cont.substring(0, divpos));
            var objname = cont.substring(divpos + 2, divpos + 2 + size);
            if (cont.substring(divpos + 2 + size, divpos + 4 + size) != "\":") {
                errormsg = "object name is too long, or missing \":";
                return;
            }
            var objprops = unserialize("a:" + cont.substring(divpos + 4 + size), 1);
            if (error) {
                errormsg = "invalid object properties";
                return;
            }
            rest = objprops[1];
            var objout = "function " + objname + "(){";
            for (key in objprops[0]) {
                objout += "" + key + "=objprops[0]['" + key + "'];";
            }
            objout += "}val=new " + objname + "();";
            eval(objout);
            break;
        default:
            errormsg = "invalid input type";
    }
    return (arguments.length == 1 ? val : [val, rest]);
}

/* explode */
var explode = function( delimiter, string ) {	// Split a string by string
    /**/
    var emptyArray = { 0: '' };

    if ( arguments.length != 2
        || typeof arguments[0] == 'undefined'
        || typeof arguments[1] == 'undefined' )
    {
        return null;
    }

    if ( delimiter === ''
        || delimiter === false
        || delimiter === null )
    {
        return false;
    }

    if ( typeof delimiter == 'function'
        || typeof delimiter == 'object'
        || typeof string == 'function'
        || typeof string == 'object' )
    {
        return emptyArray;
    }

    if ( delimiter === true ) {
        delimiter = '1';
    }

    return string.toString().split ( delimiter.toString() );
}

var InheritUtmTags = {
	UtmStr: "",
	Init: function(){
		var SText = window.location.search;
		var SArray = [];
		var i;
		
		if(SText.length > 0){
			SText = SText.replace(/^\?/,"");
			SArray = SText.split("&");
			for(i in SArray){
				if(SArray[i].match(/^utm_source/)){
					this.SetUtm(SArray[i]);
				} else if(SArray[i].match(/^utm_medium/)){
					this.SetUtm(SArray[i]);
				} else if(SArray[i].match(/^utm_campaign/)){
					this.SetUtm(SArray[i]);
				}	
			}
			
			if(this.UtmStr.length > 0){
				$("a[href]").each(function(){
					var Href = $(this).attr("href");
					var Flag = false;
					if(Href.match(/^\//) || Href.match(/^http/)){
						if(Href.match(/\?/)){
							Href += "&";
						} else {
							Href += "?";
						}
						Href += InheritUtmTags.UtmStr;
						$(this).attr("href",Href);
					}

				});
			}
		}		
	},
	SetUtm:function(Text){
		if(Text.length > 0){
			if(this.UtmStr.length > 0){
				this.UtmStr += "&";
			}
			this.UtmStr += Text
		}
	}
}

$(document).ready( function() {
	
	if(typeof $.cookie("sit_at_home") == "undefined"){
		$("#SitAtHome").modal("show");
		$.cookie("sit_at_home","1", { expires: 1, path: '/' })
	}
	
	InheritUtmTags.Init();
    /* the Main */
    MainObject.init();
    /* Oll */
     $('select#coursers-line').niceSelect();
     $('select#coursers-line-name').niceSelect();
     $('select#search-category').niceSelect();
     $('select.niceSelect').niceSelect();
    // if($("#bx-panel").length == 0){ $("body").niceScroll({cursorcolor:"#777", cursorwidth:"15px", cursorborderradius:"1px", cursorborder:"0px solid #eee", zindex:"9999", horizrailenabled:false,  disablemutationobserver: true}); }
    /* меню логотипа АИС */
    $(".net-menu .net-menu-logo .logo-bg, .net-menu .net-menu-logo .logo").hover(function(){
        var $sel_ = '.net-menu .net-menu-logo .logo-bg';
        $($sel_).css("box-shadow", "0 0 70px 0 rgba(140, 213, 11, .5)");
        $($sel_).css("-webkit-box-shadow", "0 0 70px 0 rgba(140, 213, 11, .5)");
    }, function(){
        var $sel_ = '.net-menu .net-menu-logo .logo-bg';
        $($sel_).css("box-shadow", "0 0 0px 0 rgba(140, 213, 11, .5)");
        $($sel_).css("-webkit-box-shadow", "0 0 0px 0 rgba(140, 213, 11, .5)");
    });
    $(".net-menu .net-menu-logo .logo-bg, .net-menu .net-menu-logo .logo").click(function(){
        window.location.replace('/academy/');
    });

    /**/
    $('.burger-button').on('click', function () {
        $(this).toggleClass('is-active');
        if ($(this).hasClass('is-active')) {
            $('.burger-menu').addClass('show');
        } else {
            $('.burger-menu').removeClass('show');
        }
        var wh = $(window).height() - 120;
        $('.burger-menu').height(wh);
        
    });
    /**/
    $('.menu-top-list .menu-item').on('mouseover', function () {
        $(this).addClass('is-active');
    });
    $('.menu-top-list .menu-item').on('mouseleave', function () {
        $(this).removeClass('is-active');
    });
    /* проверка существования этих областей и т.д. */
    if($(window).width() > 992) {
        if ($("#particles-bg").length != 0) {
            particlesJS.load('particles-bg', '/local/templates/infosystems/js/assets/particlesjs-footer.json', function () {
                /*console.log('callback - particles.js config loaded');*/
            });
        }
        if ($("#particles-bg-2").length != 0) {
            particlesJS.load('particles-bg-2', '/local/templates/infosystems/js/assets/particles-bg-2.json', function () {
                console.log('callback - particles.js config loaded');
            });
        }
        if ($("#particles-bg-3").length != 0) {
            particlesJS.load('particles-bg-3', '/local/templates/infosystems/js/assets/particles-bg-2.json', function () {
                /*console.log('callback - particles.js config loaded');*/
            });
        }
        if ($("#particles-bg-4").length != 0) {
            particlesJS.load('particles-bg-4', '/local/templates/infosystems/js/assets/particles-bg-2.json', function () {
                var e = $("#particles-body-top").offset().top;
                $('#particles-bg-4').css("top", e);
                $('#particles-bg-4').css("z-index", '1');
            });
            /**/
            $(window).scroll(function () {
                var $top = $(window).scrollTop();
                var e = $("#particles-body-top").offset().top;
                if ($top > e) {
                    $('#particles-bg-4').css("top", $top);
                }
                if ($top > (e + 560)) {
                    $('#particles-bg-4').css("z-index", '0');
                } else {
                    $('#particles-bg-4').css("z-index", '1');
                }
            });
        }
        if ($("#particles-bg-5").length != 0) {
            particlesJS.load('particles-bg-5', '/local/templates/infosystems/js/assets/particles-bg-2.json', function () {
                var e = $("section[role='main']").offset().top;
                $('#particles-bg-5').css("top", e);
            });
            $(window).scroll(function () {
                var $top = $(window).scrollTop();
                var e = $("section[role='main']").offset().top;
                if ($top > e) {
                    $('#particles-bg-5').css("top", $top);
                }
            });
        }
        if ($("#particles-courses-left").length != 0) {
            particlesJS.load('particles-courses-left', '/local/templates/infosystems/js/assets/particlesjs-courses-left.json', function () {
                /*console.log('callback - particles.js config loaded');*/
            });
        }
        if ($("#particles-courses-right").length != 0) {
            particlesJS.load('particles-courses-right', '/local/templates/infosystems/js/assets/particlesjs-courses-right.json', function () {
                /*console.log('callback - particles.js config loaded');*/
            });
        }
    }else{
        var arr = ["#particles-bg-2", "#particles-bg-3", "#particles-bg-4", "#particles-bg-5", "#particles-courses-left", "#particles-courses-right"];
        arr.forEach(function(item, i) {
            $(item).remove();
        });
    }

    $(window).on('resize', function() {
        if($(window).width() < 992) {
            var arr = ["#particles-bg-2", "#particles-bg-3", "#particles-bg-4", "#particles-bg-5", "#particles-courses-left", "#particles-courses-right"];
            arr.forEach(function(item, i) {
                $(item).remove();
            });
        }
    });
    /**/
	var loopVal = true;
	if($('.video-reviews-carousel.incourses').length = 1 && $('.video-reviews-carousel.incourses').data('count')<3){
		loopVal = false;
	}
    $('.video-reviews-carousel').owlCarousel({
        dots:true,
        nav:true,
        items:3,
        loop: loopVal,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        responsive: {
            0: {
                items: 1,
                center: true
            },
            768 : {
                items: 2,
                center: false,
                margin: 15
            },
            992: {
                items: 3,
                margin: 30
            }
        }
    });

    $('.banner-slider').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        autoHeight: true,
        autoplay: true,
		autoplayHoverPause:true,
        autoplayTimeout: 6000,
        autoplaySpeed:2000,
        responsive: {
            0: {
                nav: false
            },
            768: {
                nav: true
            }
        }
    });

    $('.courses-slider').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        margin: 5,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplaySpeed:2000,
        /*animateOut: 'slideOutDown',
        animateIn: 'slideInDown'*/
        responsive: {
            0: {
                nav: false
            },
            768: {
                nav: true
            }
        }
    });

    // задает ширину навигации на курсах
    var coursesDots = $('.courses-slider .owl-dots').width();
    $('.courses-slider .owl-nav').width(coursesDots + 100);

    $('.partners-slider').owlCarousel({
        items: 5,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        autoplay: false,
        /*animateOut: 'slideOutDown',
        animateIn: 'slideInDown'*/
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 3
            },
            768: {
                items: 5
            }
        }
    });

    /**/
    /*$('.reviews-items').owlCarousel({
        items: 1,
        center: true,
        loop: false,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        autoplay: false
      
    });*/

    // задает ширину навигации на курсах
    // var reviewsDots = $('.reviews-items .owl-dots').width();
    // $('.reviews-items .owl-nav').width(reviewsDots + 100);

    (function() {
        /*if($('.reviews-items .reviews-items-person').length <= 1) {
            return;
        }*/

        //$('.reviews-items .owl-dot').css('width', 'auto').css('height', 'auto').css('borderRadius', 'none');
        //$('.reviews-items .owl-dots').css('marginTop', '30px').css('marginBottom', '40px').css('height', 'auto');
 
        //$('.reviews-items .slide .reviews-items-person').each(function(i, el) {   
        //   $('.reviews-items .owl-dot')[i].innerHTML = el.outerHTML;
        //});

        //$('.reviews-items .slide .reviews-items-person').css('display', 'none');
    })();

    /**/
    $('.photoLine-items').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        autoplay:false
        /*animateOut: 'slideOutDown',
        animateIn: 'slideInDown'*/
    });
    $('.news_banner').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        autoplay:false
        /*animateOut: 'slideOutDown',
        animateIn: 'slideInDown'*/
    });

    var photoLineDots = $('.photoLine-items .owl-dots').width();
    $('.photoLine-items .owl-nav').width(photoLineDots + 100);
    /**/

    $('.photogallery-slider').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        margin: 30,
        autoplay:true
    });
    // задает ширину навигации на курсах
    var photogalleryDots = $('.photogallery-slider .owl-dots').width();
    $('.photogallery-slider .owl-nav').width(photogalleryDots + 100);

    /**/
    $('.news-line-index').owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        /* animateOut: 'slideOutDown',
         animateIn: 'slideInDown'*/
    });

    // задает ширину навигации на курсах
    var reviewsnewsLineDots = $('.news-line-index .owl-dots').width();
    $('.news-line-index .owl-nav').width(reviewsnewsLineDots + 100);


    $(window).on('load resize', function() {
        if($(window).width() < 768) {
            $('.experts-slider').owlCarousel({
                items: 1,
                center: true,
                loop: true,
                nav: true,
                navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
                dots: true,
                margin: 30,
                autoplay:false
            });
            // задает ширину навигации на курсах
            // var photogalleryDots = $('.experts-slider .owl-dots').width();
            // $('.experts-slider .owl-nav').width(photogalleryDots + 100);
        } else {
            $('.experts-slider').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
        }
    });

    $('.experts-multyslider').owlCarousel({
        items: 4,
        center: false,
        loop: true,
        nav: true,
        navText: ['<div class="button button--round button--secondary icon-caret-left">', '<div class="button button--round button--secondary icon-caret-right">'],
        dots: true,
        margin: 30,
        autoplay:false,
        responsive: {
            0: {
                items: 1,
                center: true
            },
            768: {
                items: 2,
                center: false
            },
            992: {
                items: 3,
                center: true
            },
            1200: {
                items: 4,
                center: false
            }
        }
    });


    var upBtn = document.createElement('div');
    upBtn.className = 'up-btn';
    $('body').append(upBtn);

    $('.up-btn').on('click', function() {        
        $('html, body').animate({
            scrollTop: 0
        }, 300)
    });

    $('.info-block-menu a').on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr('href'); 
        var elemTopPosition = $(link).offset().top;
        $('html, body').animate({
            scrollTop: elemTopPosition - 110
        }, 300);
    });


    /* $("#navbar-menu-click").on("click", function(event){
        event.preventDefault();
        $('.sidebar').slideToggle("slow");
        $(this).toggleClass("active-click");
        if ($(this).hasClass("active-click")){
            $(this).find('i').replaceWith('<i class="fa fa-close" aria-hidden="true"></i>');
        }else{
            $(this).find('i').replaceWith('<i class="fa fa-bars" aria-hidden="true"></i>');
        }
        return false;
    }); */
    /* $('.datepicker').datepicker({
     format: 'dd.mm.yyyy',
     language: 'ru',
     startView: '1',
     startDate: '-3d',
     }); */

     $(document).mouseup(function (e){
        var menu = $(".header-menu");
        var burgerBtn = $(".burger-button");
		if (!menu.is(e.target) && menu.has(e.target).length === 0 && !burgerBtn.is(e.target) && burgerBtn.has(e.target).length === 0) {
            $('.burger-menu').removeClass('show');
            $(".burger-button").removeClass('is-active');
		}
    });
});


$(document).ready(function(){  
	var isIn = true;/*false;*/
	if($('#review-content').hasClass('isincourses')){
		isIn = true;
		console.log('1');
	}
	/*console.log($('#review-content').hasClass('isincourses'));*/
    $('#review-content').slick({
        dots: false,
        arrows: false,
        infinite: true,
        centerMode: false,
        speed: 1300,
        autoplay: false,
		adaptiveHeight: isIn,
        // autoplaySpeed: 3000,
        easing: 'ease-out',
        draggable: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '#review-name'
    });
    var totalSlides = $('#review-name .slide').length >= 5 ? 5 : $('#review-name .slide').length;
    if ($(window).width() < 991) {
        totalSlides = $('#review-name .slide').length >= 3 ? 3 : $('#review-name .slide').length;
    }
    if ($(window).width() < 578) {
        totalSlides = 1;
    }
	var $slides = $('#review-name .slide');
	if ($slides.length > 1 && $slides.length <= totalSlides) {
    var $slide;
    $slides.each( function(){
        $slide = $(this).clone(true)
            .insertAfter( $slide || $slides.last() )
            .addClass('slick-cloned-2')
            .attr('id', '');
    });
	}
	totalSlides = Math.min(totalSlides, $slides.length);
	
    $('#review-name').slick({
        dots: false,
        arrows: true,
        infinite: true,
        centerMode: true,
        centerPadding: '60px',
        initialSlide: 0,
        speed: 600,
        autoplay: false, 
        easing: 'ease-out',
        draggable: true,
        slidesToShow: totalSlides,
        slidesToScroll: 1,
        asNavFor: '#review-content',
        focusOnSelect: true
    });    

	$('a[href^="http"], a[href^="ftp"]').not('a[href^="https://infosystems.ru/"]').not('a[href^="https://dev.infosystems.ru/"]').click(function(){
		window.open(this.href, "");
		return false;
	});

    /*var lengthSlide = $('#review-name .slick-slide:not(.slick-cloned)').length;*/
	var lengthSlide = $('#review-name').data('countel');

    if(lengthSlide>0){
    $('#REVIEWS').append('<span class="count">1</span><span class="small-total">/' + lengthSlide) + '</span>';
    }else{
		if(lengthSlide == undefined){
			$('#REVIEWS').append('<span class="count">0</span><span class="small-total">/' + 0) + '</span>';
		}else{
			$('#REVIEWS').append('<span class="count">0</span><span class="small-total">/' + lengthSlide) + '</span>';
		}
    }
    $('#review-name').on('afterChange', function(event, slick, currentSlide, nextSlide){
		var num = $(this).find('.slick-slide.slick-active.slick-center .slide.inner').data('num');
		$('#REVIEWS .count').html(num);
        //$('#REVIEWS .count').html(currentSlide + 1);
    });
    $('body').on('click','.cookiesAgreement-module-close-26BEzs',function(){
        $(this).closest('.cookiesAgreement-module-root-2INjMM').remove();
    });
    $('body').on('click','button',function(){
        setCookie('COOKIE_BLOCK','1',{'path':'/','expires':604800*4});
        $(this).closest('.cookiesAgreement-module-root-2INjMM').remove();
    })
});
function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;}
  }
  document.cookie = updatedCookie;
}
