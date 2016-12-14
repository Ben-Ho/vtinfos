var onReady = require('kwf/on-ready');
var $ = require('jQuery');
//responsiveEl('.kwcClass', [400, 800]);
onReady.onRender('.kwcClass', function (el) {
//     $(window).scroll(function (event, a, b, c, d) {
//         if ($(window).scrollTop() == 0) {
//             $('body').removeClass('scrolled');
//         } else {
//             $('body').addClass('scrolled');
//         }
//     });

    $(el).find('.mobileTitle').click(function(event) {
        if ($(event.currentTarget).find('.title').hasClass('gt400'))
            return;
        if ($(event.currentTarget).hasClass('logout'))
            return;
        var menu = $(el).find('.menuMain');
        if (menu.height() == 0) {
            menu.height('auto');
            var height = menu.height();
            menu.height(0);
            menu.animate({
                height: height
            });
        } else {
            menu.height(0);
        }
    });

    $(el).find('ul.menu > li').hover(
        function (event) {
            if (!$(event.currentTarget).closest('.title').hasClass('gt400'))
                return;
            // Reset old values
            $(event.currentTarget).closest('ul').children('li').removeClass('hover');
            $(event.currentTarget).closest('ul').find('ul.subMenu').css('display', 'none');
            $(event.currentTarget).closest('.menuMain').height(40);

            $(event.currentTarget).addClass('hover');
            if ($(event.currentTarget).find('ul').length > 0) {
                $(event.currentTarget).closest('.menuMain').height(80);
                $(event.currentTarget).find('ul.subMenu').css('display', 'table');
            }
        }, function (event) {}
    );

    $(el).find('.mobileTitle .languages').click(function(event) {
        $(event.currentTarget).closest('.title').find('.language').toggleClass('shown');
        event.stopPropagation();
    });
});
