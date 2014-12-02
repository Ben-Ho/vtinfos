Kwf.onJElementReady('.cssClass', function (el) {
    el.find('.calculateTime').click(function (event) {
        Ext.Ajax.request({
            url: '/admin/component/edit/Map_Detail_Drivetime_Component/Calculate/json-index',
            params: {
                congregationId: $(event.currentTarget).data('congregation-id'),
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
