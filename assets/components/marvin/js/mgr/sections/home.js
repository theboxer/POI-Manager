Ext.onReady(function() {
    MODx.load({ xtype: 'marvin-page-home'});
});

Marvin.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'marvin-panel-home'
            ,renderTo: 'marvin-panel-home-div'
        }]
    });
    Marvin.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.page.Home,MODx.Component);
Ext.reg('marvin-page-home',Marvin.page.Home);
