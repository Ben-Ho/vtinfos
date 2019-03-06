var onReady = require('kwf/commonjs/on-ready');
onReady.onRender('.kwcClass', function(el, config) {
    el.on('click', function(ev) {
        el.toggleClass('kwcBem--open');
    });
});
