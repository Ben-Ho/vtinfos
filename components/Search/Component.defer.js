var onReady = require('kwf/commonjs/on-ready');

onReady.onRender('.kwcClass', function(el, config) {
    
    var app = require('web/components/Search/reactjs/app');
    app.render(el.find('.kwcBem__application').get(0), config);
});
