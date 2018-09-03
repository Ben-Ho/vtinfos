var onReady = require('kwf/commonjs/on-ready');
onReady.onRender('.kwcClass', function (el) {
    el.closest('.dataProtection').remove();
});
