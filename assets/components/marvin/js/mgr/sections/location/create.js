Ext.onReady(function() {
    MODx.load({ xtype: 'marvin-page-location'});
});

Marvin.page.Location = function(config) {
    config = config || {};

    config.isUpdate = (MODx.request.id) ? true : false;

    if(config.isUpdate == false){
        config.parent = MODx.request.parent;
    }

    Ext.applyIf(config,{
        formpanel: 'marvin-panel-location'
        ,id: 'marvin-page-location'
        ,buttons: [{
            text: _('save')
            ,method: 'remote'
            ,process: config.isUpdate ? 'mgr/location/update' : 'mgr/location/create'
            ,checkDirty: false
            ,keys: [{
                key: MODx.config.keymap_save || 's'
                ,ctrl: true
            }]
        },{
            text: _('cancel')
            ,params: {a:MODx.action['resource/update'], id:config.parent}
        }]
        ,components: [{
            xtype: 'marvin-panel-location'
            ,renderTo: 'marvin-panel-location-div'
            ,isUpdate: config.isUpdate
        }]
    });
    Marvin.page.Location.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.page.Location,MODx.Component);
Ext.reg('marvin-page-location',Marvin.page.Location);