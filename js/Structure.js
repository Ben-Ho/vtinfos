Ext2.ns('vtinfos');
vtinfos.Structure = Ext2.extend(Ext2.Panel,
{
    layout: 'border',
    initComponent : function()
    {
        var talksGrid = new Kwf.Auto.GridPanel({
            title: trl('Vorträge des ausgewählten Redners'),
            region: 'east',
            width: 420,
            split: true,
            controllerUrl: KWF_BASE_URL+'/admin/talks/speakers-to-talks'
        });

        var speakersGrid = new Kwf.Auto.GridPanel({
            title: trl('Redner'),
            controllerUrl: KWF_BASE_URL+'/admin/talks/speakers',
            height: 400,
            split: true,
            region: 'south',
            bindings: [{
                queryParam: 'speaker_id',
                item: talksGrid
            }]
        });
        var congregationsGrid = new Kwf.Auto.GridPanel({
            title: trl('Versammlungen'),
            controllerUrl: KWF_BASE_URL+'/admin/talks/congregations',
            region: 'center',
            split: true,
            bindings: [{
                queryParam: 'congregation_id',
                item: speakersGrid
            }]
        });
        var centerRegion = new Ext2.Panel({
            layout: 'border',
            region: 'center',
            split: true,
            items: [congregationsGrid, speakersGrid]
        });
        var circleGrid = new Kwf.Auto.GridPanel({
            title: trl('Kreise'),
            controllerUrl: KWF_BASE_URL+'/admin/talks/circles',
            width: 120,
            split: true,
            region: 'center',
            bindings: [{
                queryParam: 'circle_id',
                item: congregationsGrid
            }]
        });
        var circleGroupGrid = new Kwf.Auto.GridPanel({
            title: trl('Kreisgruppen'),
            controllerUrl: KWF_BASE_URL+'/admin/talks/circle-groups',
            height: 200,
            split: true,
            region: 'north',
            bindings: [{
                queryParam: 'group_id',
                item: circleGrid
            }]
        });
        var circlePanel = new Ext2.Panel({
            layout: 'border',
            region: 'west',
            split: true,
            width: 240,
            items: [circleGroupGrid, circleGrid]
        });

        this.items = [circlePanel, centerRegion, talksGrid];
        vtinfos.Structure.superclass.initComponent.call(this);
    }
});
Ext2.reg('vtinfos.structure', vtinfos.Structure);

Ext2.util.Format.name = function(value, p, record, rowIndex, colIndex, store, column) {
    var list = column.editor.field.initialConfig.store.data;
    for (var i = 0; i < list.length; i++) {
        if (list[i][0] == value) {
            return list[i][1];
        }
    }
    return 'Keine Auswahl';
};
