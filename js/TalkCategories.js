Ext2.ns('vtinfos');
vtinfos.TalkCategories = Ext2.extend(Ext2.Panel,{
    layout: 'border',
    initComponent: function ()
    {
        var translationGrid = new Kwf.Auto.GridPanel({
            title: trl('Übersetzungen'),
            region: 'center',
            split: true,
            controllerUrl: KWF_BASE_URL+'/admin/talks/talk-category-translations'
        });
        var talksGrid = new Kwf.Auto.GridPanel({
            title: trl('Kategorien'),
            region: 'west',
            width: 500,
            split: true,
            controllerUrl: KWF_BASE_URL+'/admin/talks/talk-categories',
            bindings: [{
                queryParam: 'category_id',
                item: translationGrid
            }]
        });
        this.items = [talksGrid, translationGrid];
        vtinfos.Structure.superclass.initComponent.call(this);
    }
});
Ext2.reg('vtinfos.talkCategories', vtinfos.TalkCategories);
