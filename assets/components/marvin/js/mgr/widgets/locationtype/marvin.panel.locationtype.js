Marvin.panel.LocationType = function(config) {
    config = config || {};
    this.ident = 'marvin-panel-locationtype';
    Ext.applyIf(config,{
        id: this.ident
        ,border: false
        ,cls: 'container'
        ,url: Marvin.config.connectorUrl
        ,items: [{
            html: '<h2>'+_('marvin.locationtype.menu')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            layout: 'form'
            ,border: true
            ,items: [{
                html: '<p>'+_('marvin.locationtype.list_desc')+'</p>'
                ,bodyCssClass: 'panel-desc'
                ,border: false
            },{
                xtype: 'marvin-grid-location-type'
                ,cls:'main-wrapper'
                ,preventRender: true
            }]
        }]

    });
    Marvin.panel.LocationType.superclass.constructor.call(this, config);
};

Ext.extend(Marvin.panel.LocationType, MODx.FormPanel);
Ext.reg('marvin-panel-location-type',Marvin.panel.LocationType);