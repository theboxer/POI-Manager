
Marvin.grid.Items = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-items'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/item/getlist'
        }
        ,save_action: 'mgr/item/updatefromgrid'
        ,autosave: true
        ,fields: ['id','name','description']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,ddGroup: 'marvinItemDDGroup'
        ,enableDragDrop: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        },{
            header: _('name')
            ,dataIndex: 'name'
            ,width: 200
            ,editor: { xtype: 'textfield' }
        },{
            header: _('description')
            ,dataIndex: 'description'
            ,width: 250
            ,editor: { xtype: 'textfield' }
        }]
        ,tbar: [{
            text: _('marvin.item_create')
            ,handler: this.createItem
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,id: 'marvin-search-filter'
            ,emptyText: _('marvin.search...')
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
        ,listeners: {
            'render': function(g) {
                var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    copy: false
                    ,listeners: {
                        'beforerowmove': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowmove': function(objThis, oldIndex, newIndex, records) {

                            MODx.Ajax.request({
                                url: Marvin.config.connectorUrl
                                ,params: {
                                    action: 'mgr/item/reorder'
                                    ,idItem: records.pop().id
                                    ,oldIndex: oldIndex
                                    ,newIndex: newIndex
                                }
                                ,listeners: {

                                }
                            });
                        }

                        ,'beforerowcopy': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowcopy': function(objThis, oldIndex, newIndex, records) {
                        }
                    }
                });

                Ext.dd.ScrollManager.register(g.getView().getEditorParent());
            }
            ,beforedestroy: function(g) {
                Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
            }

        }
    });
    Marvin.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.grid.Items,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.item_update')
            ,handler: this.updateItem
        });
        m.push('-');
        m.push({
            text: _('marvin.item_remove')
            ,handler: this.removeItem
        });
        this.addContextMenuItem(m);
    }
    
    ,createItem: function(btn,e) {
        this.createUpdateItem(btn, e, false);
    }

    ,updateItem: function(btn,e) {
        this.createUpdateItem(btn, e, true);
    }

    ,createUpdateItem: function(btn,e,isUpdate) {
        var r;

        if(isUpdate){
            if (!this.menu.record || !this.menu.record.id) return false;
            r = this.menu.record;
        }else{
            r = {};
        }

        this.windows.createUpdateItem = MODx.load({
            xtype: 'marvin-window-item-create-update'
            ,isUpdate: isUpdate
            ,title: (isUpdate) ?  _('marvin.item_update') : _('marvin.item_create')
            ,record: r
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.createUpdateItem.fp.getForm().reset();
        this.windows.createUpdateItem.fp.getForm().setValues(r);
        this.windows.createUpdateItem.show(e.target);
    }
    
    ,removeItem: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('marvin.item_remove')
            ,text: _('marvin.item_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/item/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }

    ,getDragDropText: function(){
        return this.selModel.selections.items[0].data.name;
    }
});
Ext.reg('marvin-grid-items',Marvin.grid.Items);

Marvin.window.CreateUpdateItem = function(config) {
    config = config || {};
    this.ident = config.ident || 'marvin-mecitem'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident
        ,height: 150
        ,width: 475
        ,closeAction: 'close'
        ,url: Marvin.config.connectorUrl
        ,action: (config.isUpdate)? 'mgr/item/update' : 'mgr/item/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,id: this.ident+'-id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('name')
            ,name: 'name'
            ,id: this.ident+'-name'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('description')
            ,name: 'description'
            ,id: this.ident+'-description'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,name: 'position'
            ,id: this.ident+'-position'
            ,hidden: true
        }]
    });
    Marvin.window.CreateUpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.window.CreateUpdateItem,MODx.Window);
Ext.reg('marvin-window-item-create-update',Marvin.window.CreateUpdateItem);

