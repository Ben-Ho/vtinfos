var onReady = require('kwf/on-ready');
var $ = require('jQuery');
var getViewport = require('web/commonjs/getViewport');

onReady.onRender('.kwcClass', function (el) {
    $(el).find('.mobileTitle').click(function(event) {
        if (getViewport().width >= 768) return;

        if ($(event.currentTarget).hasClass('logout'))
            return;

        var menu = $(el).find('.menuMain');
        if (menu.height() == 0) {
            menu.css('max-height', '100vh');
            $(el).find('.mobileTitle').addClass('open');
        } else {
            menu.css('max-height', '0');
            $(el).find('.mobileTitle').removeClass('open');
        }
    });

    $(el).find('.mobileTitle .languages').click(function(event) {
        $(event.currentTarget).closest('.title').find('.language').toggleClass('shown');
        event.stopPropagation();
    });
});
