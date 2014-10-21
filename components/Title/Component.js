// Kwf.Utils.ResponsiveEl('.cssClass', []);
Kwf.onJElementReady('.cssClass', function (el) {
    $(window).scroll(function (event, a, b, c, d) {
        if ($(window).scrollTop() == 0) {
            $('body').removeClass('scrolled');
        } else {
            $('body').addClass('scrolled');
        }
    });

    $(el).find('.handle').click(function() {
        var menu = $(el).find('.menuMain');
        if (menu.height() == 0) {
            menu.height('auto');
            var height = menu.height();
            menu.height(0);
            menu.animate({
                height: height
            });
        } else {
            menu.animate({
                height: 0
            });
        }
    });
});
