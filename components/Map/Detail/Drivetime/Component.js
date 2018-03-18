require('./Component.scss');
var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');
onReady.onRender('.kwcClass', function (el) {
    el.find('.calculateTime').click(function (event) {
        Ext2.Ajax.request({
            url: KWF_BASE_URL+'/admin/component/edit/Map_Detail_Drivetime_Component/Calculate/json-index',
            params: {
                congregationId: $(event.currentTarget).data('congregation-id'),
                componentId: $(event.currentTarget).data('component-id'),
                kwfSessionToken: Kwf.sessionToken
            },
            success: function(response, options) {
                var result = $.parseJSON(response.responseText);
                $(event.currentTarget).removeClass('calculateTime');
                $(event.currentTarget).addClass('travelTime');
                $(event.currentTarget).html(result.duration);
                $(event.currentTarget).off('click');
            },
        });
    });
});
