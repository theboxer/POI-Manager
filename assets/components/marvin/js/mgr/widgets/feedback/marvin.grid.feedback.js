
Marvin.grid.Feedback = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'marvin-grid-feedback'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/feedback/getlist'
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
            header: _('marvin.feedback.text')
            ,dataIndex: 'text'
        },{
            header: _('marvin.feedback.authors_name')
            ,dataIndex: 'authors_name'
            ,width: 100
        },{
            header: _('marvin.feedback.authors_email')
            ,dataIndex: 'authors_email'
            ,width: 100
        },{
            header: _('marvin.feedback.created')
            ,dataIndex: 'created'
            ,width: 100
        },{
            header: _('marvin.feedback.state')
            ,dataIndex: 'state'
            ,width: 100
            ,renderer: Marvin.renderers.state.createDelegate(this, ['feedback'], true)
        }]
        ,tbar: ['->',{
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

    Marvin.grid.Feedback.superclass.constructor.call(this,config);

};
Ext.extend(Marvin.grid.Feedback,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('marvin.feedback.review')
            ,handler: this.reviewFeedback
        });
        m.push('-');
        m.push({
            text: _('marvin.feedback.delete')
            ,handler: this.deleteFeedback
        });
        this.addContextMenuItem(m);
    }

    ,reviewFeedback: function(btn, e) {
        var feedbackReview = MODx.load({
            xtype: 'marvin-window-feedback-review'
            ,title: _('marvin.feedback.review')
            ,record: this.menu.record
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        feedbackReview.fp.getForm().reset();
        feedbackReview.fp.getForm().setValues(this.menu.record);
        feedbackReview.show(e.target);
    }

    ,deleteFeedback: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('marvin.feedback.delete')
            ,text: _('marvin.feedback.delete_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/feedback/delete'
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
Ext.reg('marvin-grid-feedback',Marvin.grid.Feedback);

