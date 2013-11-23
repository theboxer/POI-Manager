
Marvin.grid.LocationType = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-location-type'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/locationtype/getlist'
        }
        ,fields: ['id','name','description', 'created', 'updated', 'updated_by', 'updated_by_name', 'deleted']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 10
            ,hidden: true
        },{
            header: _('marvin.locationtype.name')
            ,dataIndex: 'name'
            ,width: 50
        },{
            header: _('marvin.locationtype.description')
            ,dataIndex: 'description'
            ,width: 100
        }]
        ,tbar: [{
            text: _('marvin.locationtype.create')
            ,handler: this.createLocationType
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

    Marvin.grid.LocationType.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.LocationType,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.locationtype.update')
            ,handler: this.updateLocationType
        });
        m.push('-');
        m.push({
            text: _('marvin.locationtype.delete')
            ,handler: this.deleteLocationType
        });
        this.addContextMenuItem(m);
    }

    ,updateLocationType: function() {
        MODx.loadPage(MODx.action['marvin:locationtype'], 'action=locationtype/update&id=' + this.menu.record.id)
    }

    ,deleteLocationType: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.locationtype.delete')
            ,text: _('marvin.locationtype.delete_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/locationtype/delete'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,createLocationType: function() {
        MODx.loadPage(MODx.action['marvin:locationtype'], 'action=locationtype/create')
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
});
Ext.reg('marvin-grid-location-type',Marvin.grid.LocationType);

