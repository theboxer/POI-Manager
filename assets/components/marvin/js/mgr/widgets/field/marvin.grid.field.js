
Marvin.grid.Field = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-field'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/field/getlist'
            ,location_type: MODx.request.id
        }
        ,fields: ['id','name','type', 'default', 'required', 'read_only', 'position', 'created', 'updated', 'updated_by', 'updated_by_name', 'deleted']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 10
            ,hidden: true
        },{
            header: _('marvin.field.name')
            ,dataIndex: 'name'
            ,width: 50
        },{
            header: _('marvin.field.type')
            ,dataIndex: 'type'
            ,width: 50
        },{
            header: _('marvin.field.default')
            ,dataIndex: 'default'
            ,width: 50
        },{
            header: _('marvin.field.required')
            ,dataIndex: 'required'
            ,width: 50
        },{
            header: _('marvin.field.read_only')
            ,dataIndex: 'read_only'
            ,width: 50
        },{
            header: _('marvin.field.position')
            ,dataIndex: 'position'
            ,width: 50
        }]
        ,tbar: [{
            text: _('marvin.field.create')
            ,handler: this.addField
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,emptyText: _('marvin.global.search') + '...'
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                },scope:this}
            }
        }]
    });

    Marvin.grid.Field.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.Field,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.field.update')
            ,handler: this.updateField
        });
        m.push('-');
        m.push({
            text: _('marvin.field.delete')
            ,handler: this.deleteField
        });
        this.addContextMenuItem(m);
    }

    ,updateField: function(btn, e) {
        this.menu.record.location_type = MODx.request.id;

        var updateField = MODx.load({
            xtype: 'marvin-window-field'
            ,title: _('marvin.field.update')
            ,isUpdate: true
            ,record: this.menu.record
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        updateField.fp.getForm().reset();
        updateField.fp.getForm().setValues(this.menu.record);
        updateField.show(e.target);
    }

    ,deleteField: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.field.delete')
            ,text: _('marvin.field.delete_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/field/delete'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,addField: function(btn, e) {
        var record = {location_type: MODx.request.id};

        var addField = MODx.load({
            xtype: 'marvin-window-field'
            ,title: _('marvin.field.create')
            ,isUpdate: false
            ,record: record
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        addField.fp.getForm().reset();
        addField.fp.getForm().setValues(record);
        addField.show(e.target);
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
});
Ext.reg('marvin-grid-field',Marvin.grid.Field);

