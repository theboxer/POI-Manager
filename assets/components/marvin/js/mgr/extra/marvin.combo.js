Marvin.combo.LocationState = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.SimpleStore({
            fields: ['d','v']
            ,data: [
                [_('marvin.location.state_new'), 'new']
                ,[_('marvin.location.state_published'), 'published']
                ,[_('marvin.location.state_unpublished'), 'unpublished']
            ]
        })
        ,displayField: 'd'
        ,valueField: 'v'
        ,value: 'new'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    Marvin.combo.LocationState.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.combo.LocationState,MODx.combo.ComboBox);
Ext.reg('marvin-combo-location-state',Marvin.combo.LocationState);

Marvin.combo.FeedbackState = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.SimpleStore({
            fields: ['d','v']
            ,data: [
                [_('marvin.feedback.state_new'), 'new']
                ,[_('marvin.feedback.state_in_progress'), 'in_progress']
                ,[_('marvin.feedback.state_solved'), 'solved']
            ]
        })
        ,displayField: 'd'
        ,valueField: 'v'
        ,value: 'new'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    Marvin.combo.FeedbackState.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.combo.FeedbackState,MODx.combo.ComboBox);
Ext.reg('marvin-combo-feedback-state',Marvin.combo.FeedbackState);

Marvin.combo.CommentState = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.SimpleStore({
            fields: ['d','v']
            ,data: [
                [_('marvin.comment.state_unapproved'), 'unapproved']
                ,[_('marvin.comment.state_approved'), 'approved']
            ]
        })
        ,displayField: 'd'
        ,valueField: 'v'
        ,value: 'new'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    Marvin.combo.CommentState.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.combo.CommentState,MODx.combo.ComboBox);
Ext.reg('marvin-combo-comment-state',Marvin.combo.CommentState);

Marvin.combo.LocationCategory = function(config, getStore) {
    config = config || {};
    Ext.applyIf(config,{
        name: 'category'
        ,hiddenName: 'category'
        ,displayField: 'pagetitle'
        ,valueField: 'id'
        ,fields: ['pagetitle','id']
        ,mode: 'remote'
        ,triggerAction: 'all'
        ,typeAhead: true
        ,editable: true
        ,forceSelection: false
        ,pageSize: 20
        ,stackItems: true
        ,url: Marvin.config.connectorUrl
        ,baseParams: {action: 'mgr/category/getlist'}
    });
    Ext.applyIf(config,{
        store: new Ext.data.JsonStore({
            url: config.url
            ,root: 'results'
            ,totalProperty: 'total'
            ,fields: config.fields
            ,errorReader: MODx.util.JSONReader
            ,baseParams: config.baseParams || {}
            ,remoteSort: config.remoteSort || false
            ,autoDestroy: true
        })
    });
    if (getStore === true) {
        config.store.load();
        return config.store;
    }
    Marvin.combo.LocationCategory.superclass.constructor.call(this,config);
    this.config = config;
    return this;
};
Ext.extend(Marvin.combo.LocationCategory,Ext.ux.form.SuperBoxSelect);
Ext.reg('marvin-combo-location-category',Marvin.combo.LocationCategory);