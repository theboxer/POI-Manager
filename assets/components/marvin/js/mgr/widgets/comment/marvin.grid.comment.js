
Marvin.grid.Comment = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-comment'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/comment/getlist'
        }
        ,fields: ['id','text','authors_name', 'authors_email', 'state', 'location', 'created', 'updated', 'updated_by', 'updated_by_name', 'deleted']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,autoExpandColumn: 'text'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 10
            ,hidden: true
        },{
            header: _('marvin.comment.text')
            ,dataIndex: 'text'
        },{
            header: _('marvin.comment.authors_name')
            ,dataIndex: 'authors_name'
            ,width: 100
        },{
            header: _('marvin.comment.authors_email')
            ,dataIndex: 'authors_email'
            ,width: 100
        },{
            header: _('marvin.comment.created')
            ,dataIndex: 'created'
            ,width: 100
        },{
            header: _('marvin.comment.state')
            ,dataIndex: 'state'
            ,width: 100
            ,renderer: Marvin.renderers.state.createDelegate(this, ['comment'], true)
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

    Marvin.grid.Comment.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.Comment,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.comment.review')
            ,handler: this.reviewComment
        });
        m.push('-');
        m.push({
            text: _('marvin.comment.delete')
            ,handler: this.deleteComment
        });
        this.addContextMenuItem(m);
    }

    ,reviewComment: function(btn, e) {
        var commentReview = MODx.load({
            xtype: 'marvin-window-comment-review'
            ,title: _('marvin.comment.review')
            ,record: this.menu.record
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        commentReview.fp.getForm().reset();
        commentReview.fp.getForm().setValues(this.menu.record);
        commentReview.show(e.target);
    }

    ,deleteComment: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.comment.delete')
            ,text: _('marvin.comment.delete_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/comment/delete'
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
Ext.reg('marvin-grid-comment',Marvin.grid.Comment);

