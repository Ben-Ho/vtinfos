var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');
var getViewport = require('web/commonjs/getViewport');

onReady.onRender('.kwcClass', function (el) {
    $(el).find('.kwcClass__logout').click(function(event) {
        event.stopPropagation();
    });
    $(el).find('.kwcClass__mobileTitle').click(function(event) {
        if (getViewport().width >= 768) return;

        var menu = $(el).find('.kwfUp-menuMain');
        if (menu.height() == 0) {
            menu.css('max-height', '100vh');
            $(el).find('.kwcClass__mobileTitle').addClass('open');
        } else {
            menu.css('max-height', '0');
            $(el).find('.kwcClass__mobileTitle').removeClass('open');
        }
    });

    $(el).find('.kwcClass__mobileTitle .kwcClass__languages').click(function(event) { // klick auf icon
        $(event.currentTarget).closest('.kwcClass').find('.kwfUp-language').toggleClass('shown'); // einblenden von language-select
        event.stopPropagation();
    });
});
