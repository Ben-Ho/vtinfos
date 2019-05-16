Ext2.ns('vtinfos');
vtinfos.Talks = Ext2.extend(Ext2.Panel,{
    layout: 'border',
    initComponent: function ()
    {
        var talkChangesGrid = new Kwf.Auto.GridPanel({
            title: trl('Änderungen'),
            region: 'south',
            split: true,
            height: 400,
            controllerUrl: '/admin/talks/talk-changes'
        });
        var translationGrid = new Kwf.Auto.GridPanel({
            title: trl('Übersetzungen'),
            region: 'center',
            split: true,
            controllerUrl: '/admin/talks/talk-translations'
        });
        var talksGrid = new Kwf.Auto.GridPanel({
            title: trl('Vorträge des ausgewählten Redners'),
            region: 'west',
            width: 500,
            split: true,
            controllerUrl: '/admin/talks/talks',
            bindings: [{
                queryParam: 'talk_id',
                item: translationGrid
            },{
                queryParam: 'talk_id',
                item: talkChangesGrid
            }]
        });
        this.items = [talksGrid, translationGrid, talkChangesGrid];
        vtinfos.Structure.superclass.initComponent.call(this);
    }
});
Ext2.reg('vtinfos.talks', vtinfos.Talks);
