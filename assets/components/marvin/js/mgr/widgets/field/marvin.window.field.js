Marvin.window.Field = function(config) {
    config = config || {};
    this.ident = config.ident || 'marvin-window-'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident
        ,width: 600
        ,url: Marvin.config.connectorUrl
        ,action: config.isUpdate ? 'mgr/field/update' : 'mgr/field/create'
        ,closeAction: 'close'
        ,fields: this.getItems(config)
    });
    Marvin.window.Field.superclass.constructor.call(this,config);
    this.on('afterRender', function() {
        this.originalHeight = this.el.getHeight();
        this.toolsHeight = this.originalHeight - this.body.getHeight() + 50;
        this.resizeWindow();
    });
    Ext.EventManager.onWindowResize(this.resizeWindow, this);
};
Ext.extend(Marvin.window.Field,MODx.Window,{
    resizeWindow: function(){
        var viewHeight = Ext.getBody().getViewSize().height;
        var el = this.fp.getForm().el;
        if(viewHeight < this.originalHeight){
            el.setStyle('overflow-y', 'scroll');
            el.setHeight(viewHeight - this.toolsHeight);
        }else{
            el.setStyle('overflow-y', 'auto');
            el.setHeight('auto');
        }
    }

    ,getItems: function(config) {
        var items = [];

        items.push({
            xtype: 'textfield'
            ,name: 'location_type'
            ,id: this.ident+'-location-type'
            ,hidden: true
        });

            if (config.isUpdate == true) {
            items.push({
                xtype: 'textfield'
                ,name: 'id'
                ,id: this.ident+'-id'
                ,hidden: true
            },{
                layout: 'column'
                ,border: false
                ,defaults: {
                    layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,anchor: '100%'
                    ,border: false
                }
                ,items: [{
                    columnWidth: 0.35
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'textfield'
                        ,fieldLabel: _('marvin.field.name')
                        ,name: 'name'
                        ,id: this.ident+'-name'
                        ,anchor: '100%'
                        ,itemCls: 'required'
                        ,allowBlank: false
                    },{
                        xtype: 'marvin-combo-field-type'
                        ,fieldLabel: _('marvin.field.type')
                        ,hiddenName: 'type'
                        ,id: this.ident+'-type'
                        ,anchor: '100%'
                        ,itemCls: 'required'
                        ,allowBlank: false
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('marvin.field.default')
                        ,name: 'default'
                        ,id: this.ident+'-default'
                        ,anchor: '100%'
                    }]
                },{
                    columnWidth: 0.35
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'xcheckbox'
                        ,fieldLabel: _('marvin.field.required')
                        ,name: 'required'
                        ,id: this.ident+'-required'
                        ,anchor: '100%'
                    },{
                        xtype: 'xcheckbox'
                        ,fieldLabel: _('marvin.field.read_only')
                        ,name: 'read_only'
                        ,id: this.ident+'-read_only'
                        ,anchor: '100%'
                    },{
                        xtype: 'numberfield'
                        ,fieldLabel: _('marvin.field.position')
                        ,name: 'position'
                        ,id: this.ident+'-position'
                        ,anchor: '100%'
                        ,allowDecimals: false
                        ,allowNegative: false
                    }]
                },{
                    columnWidth: 0.3
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.location.created')
                        ,name: 'created'
                        ,anchor: '100%'
                    },{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.location.updated_by')
                        ,name: 'updated_by_name'
                        ,anchor: '100%'
                    },{
                        xtype: 'statictextfield'
                        ,fieldLabel: _('marvin.location.updated')
                        ,name: 'updated'
                        ,anchor: '100%'
                    }]
                }]
            });
        } else {
            items.push({
                layout: 'column'
                ,border: false
                ,defaults: {
                    layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,anchor: '100%'
                    ,border: false
                }
                ,items: [{
                    columnWidth: 0.5
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'textfield'
                        ,fieldLabel: _('marvin.field.name')
                        ,name: 'name'
                        ,id: this.ident+'-name'
                        ,anchor: '100%'
                        ,itemCls: 'required'
                        ,allowBlank: false
                    },{
                        xtype: 'marvin-combo-field-type'
                        ,fieldLabel: _('marvin.field.type')
                        ,hiddenName: 'type'
                        ,id: this.ident+'-type'
                        ,anchor: '100%'
                        ,itemCls: 'required'
                        ,allowBlank: false
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('marvin.field.default')
                        ,name: 'default'
                        ,id: this.ident+'-default'
                        ,anchor: '100%'
                    }]
                },{
                    columnWidth: 0.5
                    ,border: false
                    ,defaults: {
                        msgTarget: 'under'
                    }
                    ,items: [{
                        xtype: 'xcheckbox'
                        ,fieldLabel: _('marvin.field.required')
                        ,name: 'required'
                        ,id: this.ident+'-required'
                        ,anchor: '100%'
                    },{
                        xtype: 'xcheckbox'
                        ,fieldLabel: _('marvin.field.read_only')
                        ,name: 'read_only'
                        ,id: this.ident+'-read_only'
                        ,anchor: '100%'
                    },{
                        xtype: 'numberfield'
                        ,fieldLabel: _('marvin.field.position')
                        ,name: 'position'
                        ,id: this.ident+'-position'
                        ,anchor: '100%'
                        ,allowDecimals: false
                        ,allowNegative: false
                    }]
                }]
            });
        }

        return items;

    }
});
Ext.reg('marvin-window-field',Marvin.window.Field);

