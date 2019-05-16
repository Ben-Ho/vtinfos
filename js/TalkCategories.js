Ext2.ns('vtinfos');
vtinfos.TalkCategories = Ext2.extend(Ext2.Panel,{
    layout: 'border',
    initComponent: function ()
    {
        var talkRelation = new Kwf.Auto.AssignGridPanel({
            gridAssignedControllerUrl: '/admin/talks/talk-categories-to-talks',
            gridDataControllerUrl: '/admin/talks/talks',
            title: trl('Vorträge'),
            region: 'south',
            height: 700,
            gridDataHeight: 350,
            split: true
        });

        var translationGrid = new Kwf.Auto.GridPanel({
            title: trl('Übersetzungen'),
            region: 'center',
            split: true,
            controllerUrl: '/admin/talks/talk-category-translations'
        });
        var talksGrid = new Kwf.Auto.GridPanel({
            title: trl('Kategorien'),
            region: 'west',
            width: 500,
            split: true,
            controllerUrl: '/admin/talks/talk-categories',
            bindings: [{
                queryParam: 'category_id',
                item: translationGrid
            },{
                queryParam: 'category_id',
                item: talkRelation
            }]
        });
        this.items = [talksGrid, translationGrid, talkRelation];
        vtinfos.Structure.superclass.initComponent.call(this);
    }
});
Ext2.reg('vtinfos.talkCategories', vtinfos.TalkCategories);
