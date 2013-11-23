Ext.onReady(function() {
    MODx.load({ xtype: 'marvin-page-location-type'});
});

Marvin.page.LocationType = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'marvin-panel-location-type'
            ,renderTo: 'marvin-panel-location-type-div'
        }]
    });
    Marvin.page.LocationType.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.page.LocationType,MODx.Component);
Ext.reg('marvin-page-location-type',Marvin.page.LocationType);
