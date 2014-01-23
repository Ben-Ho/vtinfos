Ext.ns('vtinfos');
vtinfos.Structure = Ext.extend(Ext.Panel,
{
    layout: 'border',
    initComponent : function()
    {
        var talksGrid = new Kwf.Auto.GridPanel({
            region: 'east',
            width: 300,
            split: true,
            controllerUrl: '/admin/talks/speakers-to-talks',
        });

        var speakersGrid = new Kwf.Auto.GridPanel({
            controllerUrl: '/admin/talks/speakers',
            height: 400,
            split: true,
            region: 'south',
            bindings: [{
                queryParam: 'speaker_id',
                item: talksGrid
            }]
        });
        var congregationsGrid = new Kwf.Auto.GridPanel({
            controllerUrl: '/admin/talks/congregations',
            region: 'center',
            split: true,
            bindings: [{
                queryParam: 'congregation_id',
                item: speakersGrid
            }]
        });
        var centerRegion = new Ext.Panel({
            layout: 'border',
            region: 'center',
            split: true,
            items: [congregationsGrid, speakersGrid]
        });
        var circleGrid = new Kwf.Auto.GridPanel({
            controllerUrl: '/admin/talks/circles',
            width: 120,
            split: true,
            region: 'center',
            bindings: [{
                queryParam: 'circle_id',
                item: congregationsGrid
            }]
        });
        var circleGroupGrid = new Kwf.Auto.GridPanel({
            controllerUrl: '/admin/talks/circle-groups',
            height: 200,
            split: true,
            region: 'north',
            bindings: [{
                queryParam: 'group_id',
                item: circleGrid
            }]
        });
        var circlePanel = new Ext.Panel({
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
Ext.reg('vtinfos.structure', vtinfos.Structure);
