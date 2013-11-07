
Marvin.grid.Locations = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-locations'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/location/getlist'
        }
//        ,save_action: 'mgr/item/updatefromgrid'
//        ,autosave: true
        ,fields: ['id','name','alias']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,autoExpandColumn: 'name'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 10
        },{
            header: _('name')
            ,dataIndex: 'name'
//            ,editor: { xtype: 'textfield' }
        },{
            header: _('marvin.location.alias')
            ,dataIndex: 'alias'
            ,width: 100
        }]
        ,tbar: [{
            text: _('marvin.location.create_location')
//            ,handler: this.createItem
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,id: 'marvin-search-filter'
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

    Marvin.grid.Locations.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.Locations,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
//        m.push({
//            text: _('marvin.item_update')
//            ,handler: this.updateItem
//        });
        m.push('-');
        m.push({
            text: _('marvin.item_remove')
            ,handler: this.removeItem
        });
        this.addContextMenuItem(m);
    }

    ,removeItem: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.location.delete')
            ,text: _('marvin.location.delete_confirm')
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
});
Ext.reg('marvin-grid-locations',Marvin.grid.Locations);

