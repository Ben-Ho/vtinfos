var onReady = require('kwf/on-ready');
var $ = require('jQuery');
var getViewport = require('web/commonjs/getViewport');

onReady.onRender('.kwcClass', function (el) {
    $(el).find('ul.menu > li').hover(
        function (event) {
            if (getViewport().width < 768) return;
            // Reset old values
            $(event.currentTarget).closest('ul').children('li').removeClass('hover');
            $(event.currentTarget).closest('ul').find('ul.subMenu').css('display', 'none');
            $(event.currentTarget).closest('.menuMain').height(41);

            $(event.currentTarget).addClass('hover');
            if ($(event.currentTarget).find('ul').length > 0) {
                $(event.currentTarget).closest('.menuMain').height(80);
                $(event.currentTarget).find('ul.subMenu').css('display', 'table');
            }
        }, function (event) {}
    );
});
