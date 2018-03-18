Ext2.ns('vtinfos');
vtinfos.Talks = Ext2.extend(Ext2.Panel,{
    layout: 'border',
    initComponent: function ()
    {
        var translationGrid = new Kwf.Auto.GridPanel({
            title: trl('Übersetzungen'),
            region: 'center',
            split: true,
            controllerUrl: KWF_BASE_URL+'/admin/talks/talk-translations'
        });
        var talksGrid = new Kwf.Auto.GridPanel({
            title: trl('Vorträge des ausgewählten Redners'),
            region: 'west',
            width: 500,
            split: true,
            controllerUrl: KWF_BASE_URL+'/admin/talks/talks',
            bindings: [{
                queryParam: 'talk_id',
                item: translationGrid
            }]
        });
        this.items = [talksGrid, translationGrid];
        vtinfos.Structure.superclass.initComponent.call(this);
    }
});
Ext2.reg('vtinfos.talks', vtinfos.Talks);
