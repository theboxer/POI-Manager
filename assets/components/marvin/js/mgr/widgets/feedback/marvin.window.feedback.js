Marvin.window.FeedbackReview = function(config) {
    config = config || {};
    this.ident = config.ident || 'marvin-window-'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident
        ,url: Marvin.config.connectorUrl
        ,action: 'mgr/feedback/update'
        ,closeAction: 'close'
        ,width: 600
        ,fields: [{
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
                columnWidth: 0.7
                ,border: false
                ,defaults: {
                    msgTarget: 'under'
                }
                ,items: [{
                    xtype: 'textarea'
                    ,fieldLabel: _('marvin.feedback.text')
                    ,name: 'text'
                    ,id: this.ident+'-text'
                    ,anchor: '100%'
                    ,grow: true
                    ,growMax: 400
                    ,readOnly: true
                    ,disabled: true
                    ,fieldClass: 'x-static-text-field'
                }]
            },{
                columnWidth: 0.3
                ,border: false
                ,defaults: {
                    msgTarget: 'under'
                }
                ,items: [{
                    xtype: 'marvin-combo-feedback-state'
                    ,fieldLabel: _('marvin.feedback.state')
                    ,hiddenName: 'state'
                    ,anchor: '100%'
                    ,id: this.ident+'-state'
                },{
                    xtype: 'statictextfield'
                    ,fieldLabel: _('marvin.feedback.authors_name')
                    ,name: 'authors_name'
                    ,id: this.ident+'-authors_name'
                    ,anchor: '100%'
                },{
                    xtype: 'statictextfield'
                    ,fieldLabel: _('marvin.feedback.authors_email')
                    ,name: 'authors_email'
                    ,id: this.ident+'-authors_email'
                    ,anchor: '100%'
                },{
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
        }]
    });
    Marvin.window.FeedbackReview.superclass.constructor.call(this,config);
    this.on('afterRender', function() {
        this.originalHeight = this.el.getHeight();
        this.toolsHeight = this.originalHeight - this.body.getHeight() + 50;
        this.resizeWindow();
    });
    Ext.EventManager.onWindowResize(this.resizeWindow, this);
};
Ext.extend(Marvin.window.FeedbackReview,MODx.Window,{
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
});
Ext.reg('marvin-window-feedback-review',Marvin.window.FeedbackReview);

