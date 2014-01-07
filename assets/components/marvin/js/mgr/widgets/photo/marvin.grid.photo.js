
Marvin.grid.Photo = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-photo'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/photo/getlist'
        }
        ,fields: ['id', 'file','name', 'description','authors_name', 'authors_email', 'location', 'created', 'updated', 'updated_by', 'updated_by_name', 'deleted']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,autoExpandColumn: 'name'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 10
            ,hidden: true
        },{
            header: _('marvin.photo.file')
            ,dataIndex: 'file'
            ,renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                var url = Marvin.config.assetsUrl + 'photos/' + record.id + '/' + value;
                metaData.attr = 'ext:qtip=\'<img src="'+url+'" width="300">\'';
                return '<img src="'+url+'" width="100">';
            }
        },{
            header: _('marvin.photo.name')
            ,dataIndex: 'name'
            ,width: 100
        },{
            header: _('marvin.photo.description')
            ,dataIndex: 'description'
            ,width: 100
        },{
            header: _('marvin.photo.authors_name')
            ,dataIndex: 'authors_name'
            ,width: 100
        },{
            header: _('marvin.photo.authors_email')
            ,dataIndex: 'authors_email'
            ,width: 100
        },{
            header: _('marvin.photo.created')
            ,dataIndex: 'created'
            ,width: 100
        }]
        ,tbar: ['->',{
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

    Marvin.grid.Photo.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.Photo,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.photo.delete')
            ,handler: this.deletePhoto
        });
        this.addContextMenuItem(m);
    }

    ,deletePhoto: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.photo.delete')
            ,text: _('marvin.photo.delete_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/photo/delete'
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
Ext.reg('marvin-grid-photo',Marvin.grid.Photo);

