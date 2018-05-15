require('./Component.scss');
var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');
var getViewport = require('web/commonjs/getViewport');

onReady.onRender('.kwcClass', function (el) {
    $(el).find('.kwcClass__mobileTitle').click(function(event) {
        debugger
        if (getViewport().width >= 768) return;

        if ($(event.currentTarget).hasClass('kwcClass__logout'))
            return;

        var menu = $(el).find('.kwfUp-menuMain');
        if (menu.height() == 0) {
            menu.css('max-height', '100vh');
            $(el).find('.kwcClass__mobileTitle').addClass('open');
        } else {
            menu.css('max-height', '0');
            $(el).find('.kwcClass__mobileTitle').removeClass('open');
        }
    });

    $(el).find('.kwcClass__mobileTitle .kwcClass__languages').click(function(event) {
        $(event.currentTarget).closest('.kwcClass__title').find('.kwcClass__language').toggleClass('shown');
        event.stopPropagation();
    });
});
