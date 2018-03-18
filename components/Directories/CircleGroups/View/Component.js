require('./Component.scss');
var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');
var responsiveEl = require('kwf/commonjs/responsive-el');
responsiveEl('.kwcClass', [400, 800]);
onReady.onRender('.kwcClass', function (el) {
    $(el).children().each(function (index, element) {
        if (index % 2 == 0) {
            $(element).addClass('second');
        }
        if (index % 3 == 0) {
            $(element).addClass('third');
        }
        $(element).click(function (event) {
            var element = $(event.target).closest('.kwcClass');
            if (element.hasClass('gt400')) return true;
            var circleGroupElement = $(event.target).closest('.directoriesCircleGroupsDetail');
            if (circleGroupElement.hasClass('selected')) return true;
            element.find('.directoriesCircleGroupsDetail').each(function (index, element) {
                $(element).removeClass('selected');
            });
            circleGroupElement.addClass('selected');
            $('html,body').animate({
                scrollTop: Math.max(circleGroupElement.offset().top - 50, 0)
            }, 1000);
            event.stopPropagation();
            return false;
        });
    });
});
