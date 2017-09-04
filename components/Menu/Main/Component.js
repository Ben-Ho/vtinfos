var onReady = require('kwf/on-ready');
var $ = require('jQuery');
var getViewport = require('web/commonjs/getViewport');

onReady.onRender('.kwcClass', function (el) {
    el.find('.item').on({
        mouseenter: function(ev) {
            if (getViewport().width < 768) return;

            if ($(ev.currentTarget).find('.subMenu').length) {
                $(ev.currentTarget).find('.subMenu').show();
                $(ev.currentTarget).closest('.menuMain').css('height', '81px');
            } else {
                $(ev.currentTarget).closest('.menuMain').css('height', 'auto');
            }
        },
        mouseleave: function(ev) {
            if (getViewport().width < 768) return;

            if ($(ev.currentTarget).find('.subMenu')) {
                $(ev.currentTarget).find('.subMenu').hide();
            }
        }
    });
});
