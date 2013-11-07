Marvin.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('marvin')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('marvin.items')
                ,items: [{
                    html: '<p>'+_('marvin.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'marvin-grid-items'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    Marvin.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.panel.Home,MODx.Panel);
Ext.reg('marvin-panel-home',Marvin.panel.Home);
