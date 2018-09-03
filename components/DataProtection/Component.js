var onReady = require('kwf/commonjs/on-ready');
onReady.onRender('.kwcClass', function (el, config) {
    if (config.dataProtectionAccepted) {
        el.remove();
    }
    el.find('button.later').on('click', function() {
        el.remove();
    });
});
