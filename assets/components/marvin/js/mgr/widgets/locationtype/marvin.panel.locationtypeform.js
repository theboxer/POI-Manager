Marvin.panel.LocationTypeForm = function(config) {
    config = config || {};
    this.ident = 'marvin-panel-location-type-form';
    Ext.applyIf(config,{
        id: this.ident
        ,border: false
        ,useLoadingMask: true
        ,cls: 'container'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {action: 'mgr/locationtype/create'}
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
        }
    });
    Marvin.panel.LocationTypeForm.superclass.constructor.call(this, config);
};

Ext.extend(Marvin.panel.LocationTypeForm, MODx.FormPanel, {
    setup: function() {
        if (this.config.isUpdate) {
            MODx.Ajax.request({
                url: this.config.url
                ,params: {
                    action: 'mgr/locationtype/get'
                    ,id: MODx.request.id
                },
                listeners: {
                    'success': {
                        fn: function(r) {
                            this.getForm().setValues(r.object);

                            this.fireEvent('ready', r.object);
                            MODx.fireEvent('ready');
                        },
                        scope: this
                    }
                }
            });
        } else {
            this.fireEvent('ready');
            MODx.fireEvent('ready');
        }
    }

    ,getItems: function(config) {
        var items = [];

        if (config.isUpdate == true) {
            items.push({
                html: '<h2>'+_('marvin.locationtype.update')+'</h2>'
                ,border: false
                ,cls: 'modx-page-header'
            });

            items.push({
                name: 'id'
                ,xtype: 'hidden'
            });
        } else {
            items.push({
                html: '<h2>'+_('marvin.locationtype.create')+'</h2>'
                ,border: false
                ,cls: 'modx-page-header'
            });
        }

        items.push({
            layout: 'form'
            ,border: true
            ,items: [{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,cls: 'form-with-labels main-wrapper'
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
                        columnWidth: 0.3
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.locationtype.name')
                            ,name: 'name'
                            ,id: this.ident +'-name'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,allowBlank: false
                        }]
                    },{
                        columnWidth: 0.7
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.locationtype.description')
                            ,name: 'description'
                            ,id: this.ident +'-description'
                            ,anchor: '100%'
                        }]
                    }]
                },this.getUpdateInfoFields(config)]
            }]
        },{
            html: '<br /><h3>'+_('marvin.locationtype.manage_fields')+'</h3>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            layout: 'form'
            ,border: true
            ,items: [{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,border: false
                ,items: this.getFieldItems(config)
            }]
        });

        return items;
    }

    ,getFieldItems: function(config) {
        var items = [];

        if(config.isUpdate == true) {
            items.push({
                xtype: 'marvin-grid-field'
                ,cls:'main-wrapper'
                ,preventRender: true
            });
        } else {
            items.push({
                html: '<p>'+_('marvin.locationtype.save_before_manage_fields')+'</p>'
                ,bodyCssClass: 'panel-desc info-desc'
                ,border: false
            });
        }

        return items;
    }

    ,getUpdateInfoFields: function(config) {
        var items = [];

        if (config.isUpdate == true) {
            items.push({
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
                    columnWidth: 0.3
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.locationtype.created')
                        ,name: 'created'
                        ,id: this.ident +'-created'
                        ,anchor: '100%'
                    }]
                },{
                    columnWidth: 0.35
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.locationtype.updated')
                        ,name: 'updated'
                        ,id: this.ident +'-updated'
                        ,anchor: '100%'
                    }]
                },{
                    columnWidth: 0.35
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.locationtype.updated_by')
                        ,name: 'updated_by_name'
                        ,id: this.ident +'-updated_by'
                        ,anchor: '100%'
                    }]
                }]
            });
        }

        return items;
    }
    
    ,success: function(o, r) {
        MODx.loadPage(MODx.action['marvin:locationtype'], 'action=locationtype/update&id=' + o.result.object.id);
    }
});
Ext.reg('marvin-panel-location-type-form',Marvin.panel.LocationTypeForm);