/**
 * dynupdate.js: Dynamic update of product content for VirtueMart

 */

if (typeof Virtuemart === "undefined") var Virtuemart = {};
jQuery(function ($) {
    "use strict";

    // Фикса для картинок.
    $('img').each(function (index, element) {
        $(this).attr('src', $(this).attr('data_src'))
    });


    Virtuemart.OPTselectedIndexMove = 1;// сдвигать индексы выбранных OPT на n елементов

    var everPushedHistory = false;
    var everFiredPopstate = false;


    // Установить обработчик для динамического обновления
    Virtuemart.updateDynamicUpdateListeners = function () {

        console.log('Virtuemart.updateDynamicUpdateListeners');

        jQuery('*[data-dynamic-update=1]').each(function (i, el) {
            var nodeName = el.nodeName;
            el = jQuery(el);
            //	console.log('updateDynamicUpdateListeners '+nodeName, el);
            switch (nodeName) {
                case 'A':
                    el[0].onclick = null;
                    el.off('click', Virtuemart.updL);
                    el.on('click', Virtuemart.updL);
                    break;
                default:
                    el[0].onchange = null;
                    el.off('change', Virtuemart.upd).off('change', Virtuemart.cvFind);
                    el.on('change', Virtuemart.upd).addClass('on');
            } // end switch
        });
    }; // end updateDynamicUpdateListeners

    // Отметить графические фмльтры.
    // и повесить на них обработчик события
    Virtuemart.checkedGrafFilters = function () {
        console.log('Virtuemart.checkedGrafFilters');

        jQuery('*[data-dynamic-update=1]').each(function (i, el) {
            // Найти в selest отмеченный option получить его текст для поиска и выделения граф. фильтра
            var dataSelectOpt = $(el).find('option:selected').text();
            //  Получить номер строки в которой находиться нужный нам граф фильтр
            var rowEl = $('.obj_selectorParenID_' + i);
            // сделать выбранным граф фильтр.
            rowEl.find('[title=' + dataSelectOpt + ']').parent().addClass('checkedProp');
            //  Обработчик события по клику не граф фильтр.
            rowEl.children('.wrapProperty').on('click', function () {
                //  Получить название свойства продукта
                var titleText = $(this).children().attr('title');
                //  Узнать строку в которой находиться селект
                var indexRow = $(this).closest('.filterRow').attr('indexselectelement');
                //  Находим нужный нам селект
                var selectEl = $('.product-field.product-field-type-C').find('select').eq(indexRow);

                // снять selected со всех option
                $(selectEl).find('option').each(function (i, e) {
                    $(e).removeAttr("selected");
                });
                //  найти оптионс с нужным свойством товара
                var opt = $(selectEl).find('option[value="' + titleText + '"]');
                // Если option не найден создаем
                if (opt.length === 0) {
                    $(selectEl).append($($('<option>', {text: titleText, value: titleText, selected: 'selected',})));
                } else {
                    opt.attr("selected", "selected");
                } // end if

                Virtuemart.getParamsF(this)
                if ($(this).closest('.productdetails-view') [0]) {
                    $(selectEl).trigger('change');
                } else {
                    return false;
                } // end if
            });
        });
    };// end function


    Virtuemart.getParamsF = function (t) {

        console.log('Virtuemart.getParamsF');

        var strInp = $(t).closest('.wrapGrafFilters').children('input');
        var s = strInp.val()
        var p_s = JSON.parse(s)

        eval(p_s.value);
    }// end function


    // Поиск URL Для выбранного продукта
    Virtuemart.SRCImg = '';


    Virtuemart.SET_Filters = function () {
        var $ = jQuery;
        $('.selectProperty')
        /*.on('hover', function  (){
            if( $('#zoom_01')[0]  ){
                // Для карточки товаров
                var img = $(this).closest('div.productdetails').find('#zoom_01');
                if( Virtuemart.SRCImg.length==0 ){
                    Virtuemart.SRCImg  =  img.attr('src');
                } // end if
            }else{
                //  Для страницы категории
                var img = $(this).closest('div.product').find('.browseProductImage');
                if( Virtuemart.SRCImg.length==0 ){
                    Virtuemart.SRCImg  =  img.attr('src');
                } // end if
            }
            Virtuemart.FILT = this;
            Virtuemart.serche (this);
    })*/.on('click', function () {

            delete Virtuemart.SelectorVariants;

            Virtuemart.FILT = this;
            Virtuemart.serche(this);
            var parrentProduct = $(this).closest('.product');
            $(parrentProduct).find('.product_s_desc').html(Virtuemart.AddFiltrParam.product_s_desc);

            $(parrentProduct).find('.product_sku').html(Virtuemart.AddFiltrParam.product_sku);
            $(parrentProduct).find('span.PricesalesPrice').html(Virtuemart.AddFiltrParam.prices + ' грн.');
            $(parrentProduct).find('.h-pr-title > a').html(Virtuemart.AddFiltrParam.product_name);


            /* console.log ($(parrentProduct) );
            console.log (Virtuemart.AddFiltrParam);*/


            $(parrentProduct).find('.checkedProp').removeClass('checkedProp');
            $(parrentProduct).find('.PRODUCT_virtuemart_product_id').val(Virtuemart.AddFiltrParam.virtuemart_product_id)

            $(this).parent('.wrapProperty').addClass('checkedProp');
            Virtuemart.SRCImg = '';
            Virtuemart.serche(this);
        });
    }


    $('.selectProperty')
    /*.on('hover', function  (){
        if( $('#zoom_01')[0]  ){
            // Для карточки товаров
            var img = $(this).closest('div.productdetails').find('#zoom_01');
            if( Virtuemart.SRCImg.length==0 ){
                Virtuemart.SRCImg  =  img.attr('src');
            } // end if
        }else{
            //  Для страницы категории
            var img = $(this).closest('div.product').find('.browseProductImage');
            if( Virtuemart.SRCImg.length==0 ){
                Virtuemart.SRCImg  =  img.attr('src');
            } // end if
        }
        Virtuemart.FILT = this;
        Virtuemart.serche (this);
    })*/
    /*.mouseleave(function(){
        if( $('#zoom_01')[0]  ){
            $('#zoom_01').attr('src' , Virtuemart.SRCImg  );
        }else{
            if( Virtuemart.SRCImg.length !== 0 ){
                var img = $(Virtuemart.FILT).closest('div.product').find('.browseProductImage');

            console.log (img.attr('src') );
                img.attr('src' , Virtuemart.SRCImg  );
            } // end if
        }
        Virtuemart.SRCImg ='';
    });*/

    Virtuemart.SET_Filters()

    INIT_SLiderProduct();

    function INIT_SLiderProduct() {

        console.log('INIT_SLiderProduct');

        if ($('.productdetails')[0]) {
            return false;
        } // end if

        $('.product.span3')
            .on('hover', function () {
                $(this).addClass('TIMER_Stop')
            }).mouseleave(function () {
            $(this).removeClass('TIMER_Stop')
        });

        // Слайдер картинок.

        setTimeout(ProductSlider, 1000)

        function ProductSlider() {
            // Найти все фильтры
            $('.wrap_obj').each(function (i, e) {
                var el = $(e).find('.checkedProp');
                if (!el[0]) {
                    $(e).children('.wrapProperty').first().addClass('checkedProp');
                    var el = $(e).find('.checkedProp');
                } // end if
                setInterval(function () {
                    if ($(e).closest('.product.span3').hasClass('TIMER_Stop')) {
                        return false;
                    } // end if
                    var el = $(e).find('.checkedProp');
                    var nextEl = el.next('.wrapProperty');
                    if (!nextEl[0]) {
                        $(e).children('.wrapProperty').removeClass('checkedProp')
                        $(e).children('.wrapProperty').first().addClass('checkedProp');
                        var nextEl = $(e).find('.checkedProp');

                    } // end if

                    var tEl = nextEl.children('.selectProperty');
                    Virtuemart.serche(tEl);
                    tEl.trigger('hover')
                    tEl.trigger('click')
                    return false;
                }, 5000)
            });
        }
    }// end function

    Virtuemart.serche = function (t) {
        console.log('Virtuemart.serche');
        Virtuemart.getParamsF(t)
        var SelectorVariants = Virtuemart.SelectorVariants;

        var checkedOptions = [];
        var ElementEvent = $(t).attr('title');
        var IndexEL = parseInt($(t).closest('.filterRow').attr('indexselectelement'))

        // Найти родительский контейнер.
        var conteynerParent = $(t).closest('.product-field-display');
        // Колекция родственных селектов
        var selectFamely = $(conteynerParent).find('select');
        //  Получить index элемента который вызвал событие.
        var indexElEvent = IndexEL;

        //  Получить значение элемента вызвавшего событие
        var valElementEvent = $(t).attr('title');

        // Найти все товары у которых есть свойство как у элемента вызвашего событие
        var newDict = [];
        var index;

        $(SelectorVariants.variants).each(function (i, e) {
            // если такое свойство есть сохраняем в массив всю строку
            if (e [indexElEvent + Virtuemart.OPTselectedIndexMove] === valElementEvent) {
                newDict[i] = e;
                index = i;
            } // end if
        });


        // Заполнить массив выбранными опциями селектов из семейства.
        $(selectFamely).each(function (i, e) {
            checkedOptions[i + Virtuemart.OPTselectedIndexMove] = $(e).val();
        });


        // Данные фильтра.
        var FilterParam = newDict[newDict.length - 1];
        //  Дополнительные параметры товара.
        Virtuemart.AddFiltrParam = SelectorVariants.media[newDict.length - 1];

        // Найти и сохранить адрес дефолтной картинки
        if ($('#zoom_01')[0]) {
            // Поиск изображения для детали продукта
            var img = $('#zoom_01')
        } else {
            // Поиск изображения для страницы категории
            var img = $(t).closest('div.product').find('.browseProductImage');
        }
        img.attr('src', 'http://' + location.hostname + '/' + Virtuemart.AddFiltrParam.file_url);

    }// end function


    Virtuemart.upd  = function (event) {
       //  console.log(Virtuemart.upd);
        event.preventDefault();


        var checkedOptions = [];
        var ElementEvent = $(this).val();
        //   ---------------------------------------------------------------------------------------------------------------
        //  Справочник свойств и URL
        // var SelectorVariants = getSelectorVariants();
        var SelectorVariants = Virtuemart.SelectorVariants;

        // Найти родительский контейнер.
        var conteynerParent = $(this).closest('.product-field-display');
        // Колекция родственных селектов
        var selectFamely = $(conteynerParent).find('select');
        //  Получить index элемента который вызвал событие.
        var indexElEvent = selectFamely.index(this);
        //  Получить значение элемента вызвавшего событие
        var valElementEvent = $(this).val();

//   ---------------------------------------------------------------------------------------------------------------		


        // Найти все товары у которых есть свойство как у элемента вызвашего событие
        var newDict = [];


        /**
         * Добавлено Gartes !!!
         */
       if (typeof SelectorVariants === typeof undefined ) {return}

        $(SelectorVariants.variants).each(function (i, e) {
            // если такое свойство есть сохраняем в массив всю строку
            if (e [indexElEvent + Virtuemart.OPTselectedIndexMove] === valElementEvent) {
                newDict[i] = e;
            } // end if
        });

        // Заполнить массив выбранными опциями селектов из семейства.
        $(selectFamely).each(function (i, e) {
            checkedOptions[i + Virtuemart.OPTselectedIndexMove] = $(e).val();
        });


        var colin_big = 0;
        var Result_Line;
        $(newDict).each(function (i, line) {
            var col = 0; //  Количество совпадений (Временное)
            $(eval(line)).each(function (index, element) {
                if (index < Virtuemart.OPTselectedIndexMove) {
                    return;
                } // end if
                if (element == checkedOptions[index]) {
                    col++;
                } // end if
            });
            if (colin_big < col) {
                colin_big = col;
                Result_Line = line;
            } // end if
        });
        var url = Result_Line[0];


        if (typeof url === typeof undefined || url === false) {
            url = jQuery(el).val();
        }
        if (url != null) {
            url = url.replace(/amp;/g, '');
            Virtuemart.setBrowserNewState(url);
            Virtuemart.updateContent(url);
        }
    }; // end upd


    // Add to cart and other scripts may check this variable and return while
    // the content is being updated.
    Virtuemart.isUpdatingContent = false;

    Virtuemart.updateContent = function (url, callback) {
        console.log('Virtuemart.updateContent');

        if (Virtuemart.isUpdatingContent) return false;

        Virtuemart.isUpdatingContent = true;

        var urlSuf = 'tmpl=component&format=html';
        var glue = '&';

        if (url.indexOf('&') == -1 && url.indexOf('?') == -1) {
            glue = '?';
        }

        url += glue + urlSuf;

        jQuery.ajax({
            url: url,
            dataType: 'html',
            success: function (data) {
                var title = $(data).filter('title').text();
                jQuery('title').text(title);
                var el = $(data).find(Virtuemart.containerSelector);
                if (!el.length) el = $(data).filter(Virtuemart.containerSelector);
                if (el.length) {
                    Virtuemart.container.html(el.html());
                    Virtuemart.updateCartListener();
                    Virtuemart.updateDynamicUpdateListeners();
                    //Virtuemart.getColorSelectElements();
                    Virtuemart.checkedGrafFilters();
                    if (Virtuemart.updateImageEventListeners) {
                        Virtuemart.updateImageEventListeners();
                    }
                    if (Virtuemart.updateChosenDropdownLayout) {
                        Virtuemart.updateChosenDropdownLayout();
                    }
                }
                Virtuemart.isUpdatingContent = false;
                if (callback && typeof(callback) === "function") {
                    callback();
                }

                $('.selectProperty')
                    .on('hover', function () {
                        if ($('#zoom_01')[0]) {
                            // Для карточки товаров
                            var img = $(this).closest('div.productdetails').find('#zoom_01');
                            if (Virtuemart.SRCImg.length == 0) {
                                Virtuemart.SRCImg = img.attr('src');
                            } // end if
                        } else {
                            //  Для страницы категории
                            var img = $(this).closest('div.product').find('.browseProductImage');
                            if (Virtuemart.SRCImg.length == 0) {
                                Virtuemart.SRCImg = img.attr('src');
                            } // end if
                        }

                        Virtuemart.FILT = this;
                        Virtuemart.serche(this);

                    })
                    .mouseleave(function () {
                        if ($('#zoom_01')[0]) {
                            $('#zoom_01').attr('src', Virtuemart.SRCImg);
                        } else {
                            if (Virtuemart.SRCImg.length !== 0) {
                                var img = $(Virtuemart.FILT).closest('div.product').find('.browseProductImage');
                                // console.log ( Virtuemart.SRCImg);
                                img.attr('src', Virtuemart.SRCImg);
                            } // end if
                        }
                        Virtuemart.SRCImg = '';
                    })
                    .on('click', function () {
                        var parrentProduct = $(this).closest('.product');
                        $(parrentProduct).find('.product_s_desc').html(Virtuemart.AddFiltrParam.product_s_desc);
                        $(parrentProduct).find('.checkedProp').removeClass('checkedProp');
                        $(parrentProduct).find('.PRODUCT_virtuemart_product_id').val(Virtuemart.AddFiltrParam.virtuemart_product_id)

                        $(this).parent('.wrapProperty').addClass('checkedProp');
                        Virtuemart.SRCImg = '';

                        console.log(Virtuemart.AddFiltrParam);
                    });

            } // success
        });
        Virtuemart.isUpdatingContent = false;
    } // end function


    // GALT: this method could be renamed into more general "updateEventListeners"
    // and all other VM init scripts placed in here.
    Virtuemart.updateCartListener = function () {
        console.log(Virtuemart.updateCartListener);
        // init VM's "Add to Cart" scripts
        Virtuemart.product(jQuery(".product"));
        //Virtuemart.product(jQuery("form.product"));
        jQuery('body').trigger('updateVirtueMartProductDetail');
        //jQuery('body').trigger('ready');
    }

    Virtuemart.updL = function (event) {
        console.log('Virtuemart.updL');

        event.preventDefault();
        var url = jQuery(this).attr('href');
        Virtuemart.setBrowserNewState(url);
        Virtuemart.updateContent(url);
    }; // end function

    Virtuemart.updForm = function (event) {

        console.log('Virtuemart.updForm');

        cartform = jQuery("#checkoutForm");
        carturl = cartform.attr('action');
        if (typeof carturl === typeof undefined || carturl === false) {
            carturl = jQuery(this).attr('url');
            console.log('my form no action url, try attr url ', cartform);
            if (typeof carturl === typeof undefined || carturl === false) {
                carturl = 'index.php?option=com_virtuemart&view=cart';
                console.log('my form no action url, try attr url ', carturl);
            }
        }
        urlSuf = 'tmpl=component';
        carturlcmp = carturl;
        if (carturlcmp.indexOf(urlSuf) == -1) {
            var glue = '&';
            if (carturlcmp.indexOf('&') == -1 && carturlcmp.indexOf('?') == -1) {
                glue = '?';
            }
            carturlcmp += glue + urlSuf;
        }

        cartform.submit(function () {
            jQuery(this).vm2front("startVmLoading");
            if (Virtuemart.isUpdatingContent) return false;
            Virtuemart.isUpdatingContent = true;
            //console.log('my form submit url',carturlcmp);
            jQuery.ajax({
                type: "POST",
                url: carturlcmp,
                dataType: "html",
                data: cartform.serialize(), // serializes the form's elements.
                success: function (datas) {

                    if (typeof window._klarnaCheckout !== "undefined") {
                        window._klarnaCheckout(function (api) {
                            console.log(' updateSnippet suspend');
                            api.suspend();
                        });
                    }


                    var el = jQuery(datas).find(Virtuemart.containerSelector);
                    if (!el.length) el = jQuery(datas).filter(Virtuemart.containerSelector);
                    if (el.length) {
                        Virtuemart.container.html(el.html());
                        //Virtuemart.updateCartListener();
                        //Virtuemart.updDynFormListeners();
                        //Virtuemart.updateCartListener();

                        if (Virtuemart.updateImageEventListeners) Virtuemart.updateImageEventListeners();
                        if (Virtuemart.updateChosenDropdownLayout) Virtuemart.updateChosenDropdownLayout();
                    }
                    Virtuemart.setBrowserNewState(carturl);
                    Virtuemart.isUpdatingContent = false;
                    jQuery(this).vm2front("stopVmLoading");
                    if (typeof window._klarnaCheckout !== "undefined") {
                        window._klarnaCheckout(function (api) {
                            console.log(' updateSnippet suspend');
                            api.resume();
                        });
                    }
                },
                error: function (datas) {
                    alert('Error updating cart');
                    Virtuemart.isUpdatingContent = false;
                    jQuery(this).vm2front("stopVmLoading");
                },
                statusCode: {
                    404: function () {
                        Virtuemart.isUpdatingContent = false;
                        jQuery(this).vm2front("stopVmLoading");
                        alert("page not found");
                    }
                }
            });
            return false; // avoid to execute the actual submit of the form.
        });
    }; // end function

    Virtuemart.updFormS = function (event) {

        console.log(Virtuemart.updFormS);

        Virtuemart.updForm();
        jQuery("#checkoutForm").submit();
    }; // end function

    Virtuemart.updDynFormListeners = function () {

        console.log('Virtuemart.updDynFormListeners');

        jQuery('#checkoutForm').find('*[data-dynamic-update=1]').each(function (i, el) {
            var nodeName = el.nodeName;
            el = jQuery(el);
            //console.log('updDynFormListeners ' + nodeName, el);
            switch (nodeName) {
                case 'BUTTON':
                    el[0].onchange = null;
                    el.off('click', Virtuemart.updForm);
                    el.on('click', Virtuemart.updForm);
                default:
                    el[0].onchange = null;
                    el.off('click', Virtuemart.updFormS);
                    el.on('click', Virtuemart.updFormS);
                    break;
            }
        });

    }; // end function


    Virtuemart.setBrowserNewState = function (url) {

        console.log('Virtuemart.setBrowserNewState');

        if (typeof window.onpopstate == "undefined")
            return;
        var stateObj = {
            url: url
        }
        everPushedHistory = true;
        try {
            history.pushState(stateObj, "", url);
        }
        catch (err) {
            // Fallback for IE
            window.location.href = url;
            return false;
        }
    };  // end function

    Virtuemart.browserStateChangeEvent = function (event) {

        console.log('Virtuemart.browserStateChangeEvent');

        // Fix. Chrome and Safari fires onpopstate event onload.
        // Also fix browsing through history when mixed with Ajax updates and
        // full updates.
        if (!everPushedHistory && event.state == null && !everFiredPopstate)
            return;

        everFiredPopstate = true;
        var url;
        if (event.state == null) {
            url = window.location.href;
        } else {
            url = event.state.url;
        }
        Virtuemart.updateContent(url);
    };  // end function

    Virtuemart.updateDynamicUpdateListeners();
    // Создать html графических фильтров
    //  Virtuemart.getColorSelectElements();
    //  Отметить выбранные  графические фильтры
    Virtuemart.checkedGrafFilters();
    window.onpopstate = Virtuemart.browserStateChangeEvent;

});


/**
 * сравнивает 2 массива не учитывая порядок элементов
 *
 * @param {Array}
 *            Первый массив
 * @param {Array}
 *            Второй массив
 * @return {Boolean}
 */
function array_compare(arr, arr2) {
    "use strict";
    if (arr.length != arr2.length) return false;
    var on = 0;
    for (var i = 0; i < arr.length; i++) {
        for (var j = 0; j < arr2.length; j++) {
            if (arr[i] === arr2[j]) {
                on++;
                break;
            }
        }
    }
    return on == arr.length ? true : false;
}


function translite(str) {
    var arr = {
        'а': 'a',
        'б': 'b',
        'в': 'v',
        'г': 'g',
        'д': 'd',
        'е': 'e',
        'ж': 'g',
        'з': 'z',
        'и': 'i',
        'й': 'y',
        'к': 'k',
        'л': 'l',
        'м': 'm',
        'н': 'n',
        'о': 'o',
        'п': 'p',
        'р': 'r',
        'с': 's',
        'т': 't',
        'у': 'u',
        'ф': 'f',
        'ы': 'i',
        'э': 'e',
        'А': 'A',
        'Б': 'B',
        'В': 'V',
        'Г': 'G',
        'Д': 'D',
        'Е': 'E',
        'Ж': 'G',
        'З': 'Z',
        'И': 'I',
        'Й': 'Y',
        'К': 'K',
        'Л': 'L',
        'М': 'M',
        'Н': 'N',
        'О': 'O',
        'П': 'P',
        'Р': 'R',
        'С': 'S',
        'Т': 'T',
        'У': 'U',
        'Ф': 'F',
        'Ы': 'I',
        'Э': 'E',
        'ё': 'yo',
        'х': 'h',
        'ц': 'ts',
        'ч': 'ch',
        'ш': 'sh',
        'щ': 'shch',
        'ъ': '',
        'ь': '',
        'ю': 'yu',
        'я': 'ya',
        'Ё': 'YO',
        'Х': 'H',
        'Ц': 'TS',
        'Ч': 'CH',
        'Ш': 'SH',
        'Щ': 'SHCH',
        'Ъ': '',
        'Ь': '',
        'Ю': 'YU',
        'Я': 'YA'
    };
    var replacer = function (a) {
        return arr[a] || a
    };
    return str.replace(/[А-яёЁ]/g, replacer)
}  // end function