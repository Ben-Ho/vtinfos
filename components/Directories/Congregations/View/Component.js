var onReady = require('kwf/on-ready');
var $ = require('jQuery');
var responsiveEl = require('kwf/responsive-el');
responsiveEl('.kwcClass', [400, 800]);
onReady.onRender('.kwcClass', function (el) {
    $(el).find('.filter').keyup(function (input) {
        var searchQuery = $(input.currentTarget).val().toUpperCase();
        $(el).find('li').each(function (index, element) {
            var html = $(element).find('a').html().toUpperCase();
            if (html.indexOf(searchQuery) == -1) {
                $(element).addClass('filtered');
            } else {
                $(element).removeClass('filtered');
            }
        });
    });
});
