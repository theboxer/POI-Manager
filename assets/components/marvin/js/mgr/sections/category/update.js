Marvin.page.UpdateCategory = function(config) {
    config = config || {record:{}};
    config.record = config.record || {};
    Ext.applyIf(config,{
        panelXType: 'marvin-panel-category'
    });
    config.canDelete = false;
    Marvin.page.UpdateCategory.superclass.constructor.call(this,config);
};
Ext.extend(Marvin.page.UpdateCategory,MODx.page.UpdateResource,{
    getButtons: function(cfg) {
        var btns = [];
        if (cfg.canSave == 1) {
            btns.push({
                process: 'update'
                ,text: _('save')
                ,method: 'remote'
                ,checkDirty: false
                ,id: 'modx-abtn-save'
                ,keys: [{
                    key: MODx.config.keymap_save || 's'
                    ,ctrl: true
                }]
            });
            btns.push('-');
        } else if (cfg.locked) {
            btns.push({
                text: cfg.lockedText || _('locked')
                ,handler: Ext.emptyFn
                ,id: 'modx-abtn-locked'
                ,disabled: true
            });
            btns.push('-');
        }
        btns.push({
            process: 'preview'
            ,text: _('view')
            ,handler: this.preview
            ,scope: this
            ,id: 'modx-abtn-preview'
        });
        btns.push('-');
        btns.push({
            process: 'cancel'
            ,text: _('cancel')
            ,handler: this.cancel
            ,scope: this
            ,id: 'modx-abtn-cancel'
        });
        return btns;
    }
});
Ext.reg('marvin-page-category-update',Marvin.page.UpdateCategory);
