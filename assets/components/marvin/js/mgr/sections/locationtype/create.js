Ext.onReady(function() {
    MODx.load({ xtype: 'marvin-page-location-type'});
});

Marvin.page.LocationType = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        formpanel: 'marvin-panel-location-type-form'
        ,id: 'marvin-page-location-type'
        ,buttons: [{
            text: _('save')
            ,method: 'remote'
            ,process: 'mgr/locationtype/create'
            ,checkDirty: false
            ,keys: [{
                key: MODx.config.keymap_save || 's'
                ,ctrl: true
            }]
        },{
            text: _('cancel')
            ,params: {a:MODx.action['marvin:locationtype']}
        }]
        ,components: [{
            xtype: 'marvin-panel-location-type-form'
            ,renderTo: 'marvin-panel-location-type-div'
            ,isUpdate: false
        }]
    });
    Marvin.page.LocationType.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.page.LocationType,MODx.Component);
Ext.reg('marvin-page-location-type',Marvin.page.LocationType);
