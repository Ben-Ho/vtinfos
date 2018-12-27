var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');

onReady.onRender('.kwcClass', function (el) {
    el.find(".kwcClass__talkSearch").keyup(function() {
        var searchQuery = $(".kwcClass__talkSearch").val().toLowerCase();
        el.find(".kwfUp-talksTalk").each(function(index, talkEl) {
            if (talkEl.innerText.toLowerCase().indexOf(searchQuery) >= 0) {
                $(talkEl).show();
            } else {
                $(talkEl).hide();
            }
        });
    });
});
