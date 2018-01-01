var onReady = require('kwf/on-ready');

onReady.onRender('.kwcClass', function(el, config) {
    process.env.NODE_ENV = config.node_env;

    var app = require('web/components/Search/reactjs/app');
    app.render(el.find('.kwcBem__application').get(0), config);
});
