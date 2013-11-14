Marvin.panel.Location = function(config) {
    config = config || {};
    this.ident = 'marvin-panel-location';
    Ext.applyIf(config,{
        id: this.ident
        ,border: false
        ,cls: 'container'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/location/create'
        }
        ,useLoadingMask: true
        ,items: this.getItems(config)
        ,listeners: {
            'setup': {
                fn: this.setup
                ,scope: this
            }
            ,'success': {
                fn: this.success
                ,scope: this
            }
            ,'beforeSubmit': {
                fn:this.beforeSubmit
                ,scope:this
            }
        }
    });
    Marvin.panel.Location.superclass.constructor.call(this, config);
};

Ext.extend(Marvin.panel.Location, MODx.FormPanel,{
    setup: function() {

//        this.getForm().setValues({email: MODx.user.email, phone: MODx.user.phone, parent: MODx.request.parent});

//        var parent = MODx.request.parent;
//
//        var buttons = Ext.getCmp('marvin-page-location').buttons;
//        Ext.each(buttons, function(button){
//            if(button.text == _('cancel')){
//                if(parent == 0){
//                    button.params.a = MODx.action['marvin:location'];
//                    delete button.params.id;
//                }else{
//                    button.params.id = parent;
//                }
//            }
//        });

        this.fireEvent('ready');
    }

    ,success: function(o, r) {
        MODx.loadPage(MODx.action['marvin:location'], 'action=location/update&parent=' + MODx.request.parent +'&id='+ o.result.object.id);
    }

    ,beforeSubmit: function(o) {
        var d = {};

        var categories = Ext.getCmp('marvin-panel-location-category');
        if(categories) {d.categories = categories.getValue()}

        Ext.apply(o.form.baseParams, d, {});
    }

    ,getItems: function(config){
        var items = [{
            name: 'parent'
            ,xtype: 'hidden'
        },{
            html: '<h2>' + ((config.isUpdate == true)? _('marvin.location.update_title') : _('marvin.location.create_title')) + '</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            deferredRender: false
            ,border: true
            ,defaults: {
                autoHeight: true
                ,layout: 'form'
                ,labelWidth: 150
                ,bodyCssClass: 'main-wrapper'
                ,layoutOnTabChange: true
            }
            ,items: [{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,cls: 'form-with-labels'
                ,border: false
                ,items: [{
                    layout: 'column'
                    ,border: false
                    ,height: 100
                    ,defaults: {
                        layout: 'form'
                        ,labelAlign: 'top'
                        ,labelSeparator: ''
                        ,anchor: '100%'
                        ,border: false
                    }
                    ,items: [{
                        columnWidth: 0.45
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            name: 'id'
                            ,xtype: 'hidden'
                        },{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.location.name')
                            ,name: 'name'
                            ,id: this.ident +'-name'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,maxLength: 250
                            ,allowBlank: false
                        },{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.location.alias')
                            ,name: 'alias'
                            ,id: this.ident +'-alias'
                            ,anchor: '100%'
                        }]
                    },{
                        columnWidth: 0.35
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'marvin-combo-location-category'
                            ,fieldLabel: _('marvin.location.category')
                            ,name: 'fake_category'
                            ,hiddenName: 'fake_category'
                            ,id: this.ident +'-category'
                            ,anchor: '100%'
                        }]
                    },{
                        columnWidth: 0.2
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'marvin-combo-location-state'
                            ,fieldLabel: _('marvin.location.state')
                            ,name: 'state'
                            ,id: this.ident +'-state'
                            ,anchor: '100%'
                        }]
                    }]
                }]
            }]
        }];

        return items;
    }
});
Ext.reg('marvin-panel-location',Marvin.panel.Location);