Kwf.onJElementReady('.cssClass', function (el) {
    $(el).find('.filter').keyup(function (input) {
        var searchQuery = $(input.currentTarget).val().toUpperCase();
        $(el).find('li').each(function (index, element) {
            var html = $(element).find('span').html().toUpperCase();
            if (html.indexOf(searchQuery) == -1) {
                $(element).addClass('filtered');
            } else {
                $(element).removeClass('filtered');
            }
        });
    });
});
