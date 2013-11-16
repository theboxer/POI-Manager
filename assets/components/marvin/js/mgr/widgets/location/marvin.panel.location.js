Marvin.panel.Location = function(config) {
    config = config || {};
    this.ident = 'marvin-panel-location';
    Ext.applyIf(config,{
        id: this.ident
        ,border: false
        ,cls: 'container'
        ,url: Marvin.config.connectorUrl
        ,baseParams: {
            action: 'mgr/location/create'
        }
        ,useLoadingMask: true
        ,items: [{
            html: '<h2>' + ((config.isUpdate == true)? _('marvin.location.update_title') : _('marvin.location.create_title')) + '</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: false
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: this.getTabs(config)
        }]
        ,listeners: {
            'setup': {
                fn: this.setup
                ,scope: this
            }
            ,'success': {
                fn: this.success
                ,scope: this
            }
            ,'beforeSubmit': {
                fn:this.beforeSubmit
                ,scope:this
            }
        }
    });
    Marvin.panel.Location.superclass.constructor.call(this, config);
};

Ext.extend(Marvin.panel.Location, MODx.FormPanel,{
    setup: function() {
//        this.getForm().setValues({email: MODx.user.email, phone: MODx.user.phone, parent: MODx.request.parent});
        var c = Ext.getCmp('marvin-panel-location-categories');
        c.store.reload();

        var parent = MODx.request.parent;

        var buttons = Ext.getCmp('marvin-page-location').buttons;
        Ext.each(buttons, function(button){
            if(button.text == _('cancel')){
                if(parent == 0){
                    button.params.a = MODx.action['marvin:location'];
                    delete button.params.id;
                }else{
                    button.params.id = parent;
                }
            }
        });

        var zoomField = Ext.getCmp('marvin-panel-location-zoom');
        var latField = Ext.getCmp('marvin-panel-location-lat');
        var lngField = Ext.getCmp('marvin-panel-location-lng');
        var mapPanel = Ext.getCmp('marvin-panel-location-map');

        mapPanel.on('mapready', function() {
            zoomField.on('change', function(field, newValue) {
                mapPanel.setZoom(parseInt(newValue));
            });

            latField.on('change', function(field, newValue) {
                if (parseFloat(lngField.getValue()) != '') {
                    mapPanel.setMarkerPosition(newValue, parseFloat(lngField.getValue()));
                }
            });

            lngField.on('change', function(field, newValue) {
                if (parseFloat(latField.getValue()) != '') {
                    mapPanel.setMarkerPosition(parseFloat(latField.getValue()), newValue);
                }
            });

            if (mapPanel.marker) {
                mapPanel.gmap.setCenter(mapPanel.marker.getPosition());
            }

        }, this);


        if (this.config.isUpdate) {
            MODx.Ajax.request({
                url: this.config.url
                ,params: {
                    action: 'mgr/location/get'
                    ,id: MODx.request.id
                },
                listeners: {
                    'success': {
                        fn: function(r) {
                            this.getForm().setValues(r.object);

                            mapPanel.setZoom(r.object.zoom);
                            mapPanel.setMarkerPosition(r.object.lat, r.object.lng);

                            this.fireEvent('ready', r.object);
                            MODx.fireEvent('ready');
                        },
                        scope: this
                    }
                }
            });
        } else {
            this.fireEvent('ready');
            MODx.fireEvent('ready');
        }
    }

    ,success: function(o, r) {
        MODx.loadPage(MODx.action['marvin:location'], 'action=location/update&parent=' + MODx.request.parent +'&id='+ o.result.object.id);
    }

    ,beforeSubmit: function(o) {
        var d = {};
        var categories = Ext.getCmp('marvin-panel-location-categories');
        if(categories) {d.categories = categories.getValue()}

        Ext.apply(o.form.baseParams, d, {});
    }

    ,getTabs: function(config) {
        var tabs = [];
        tabs.push({
            title: _('marvin.location.location')
            ,items: this.getLocationTab(config)
        });

        if (config.isUpdate) {
            tabs.push({
                title: _('marvin.location.photos')
            },{
                title: _('marvin.location.comments')
            },{
                title: _('marvin.location.feedback')
            });
        }

        return tabs;
    }

    ,getLocationTab: function(config){
        var items = [{
            name: 'parent'
            ,xtype: 'hidden'
        },{
            deferredRender: false
            ,border: true
            ,defaults: {
                autoHeight: true
                ,layout: 'form'
                ,labelWidth: 150
                ,bodyCssClass: 'main-wrapper'
                ,layoutOnTabChange: true
            }
            ,items: [{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,cls: 'form-with-labels'
                ,border: false
                ,items: [{
                    layout: 'column'
                    ,border: false
                    ,height: 100
                    ,defaults: {
                        layout: 'form'
                        ,labelAlign: 'top'
                        ,labelSeparator: ''
                        ,anchor: '100%'
                        ,border: false
                    }
                    ,items: [{
                        columnWidth: 0.45
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            name: 'id'
                            ,xtype: 'hidden'
                        },{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.location.name')
                            ,name: 'name'
                            ,id: this.ident +'-name'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,maxLength: 250
                            ,allowBlank: false
                        },{
                            xtype: 'textfield'
                            ,fieldLabel: _('marvin.location.alias')
                            ,name: 'alias'
                            ,id: this.ident +'-alias'
                            ,anchor: '100%'
                        }]
                    },{
                        columnWidth: 0.35
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'marvin-combo-location-category'
                            ,fieldLabel: _('marvin.location.category')
                            ,name: 'fake_categories'
                            ,hiddenName: 'fake_categories'
                            ,id: this.ident +'-categories'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                        }]
                    },{
                        columnWidth: 0.20
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'marvin-combo-location-state'
                            ,fieldLabel: _('marvin.location.state')
                            ,name: 'state'
                            ,id: this.ident +'-state'
                            ,anchor: '100%'
                        },this.getInfoFields(config)]
                    }]
                }]
            }]
        },{
            html: '<br />'
//          @TODO: add style to remvoe left&right border and add same bg color as ouside of panel
        },{
            deferredRender: false
            ,border: true
            ,defaults: {
                layout: 'form'
                ,labelWidth: 150
                ,bodyCssClass: 'main-wrapper'
                ,layoutOnTabChange: true
            }
            ,items: [{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,cls: 'form-with-labels'
                ,border: false
                ,items: [{
                    layout: 'column'
                    ,border: false
                    ,height: 100
                    ,defaults: {
                        layout: 'form'
                        ,labelAlign: 'top'
                        ,labelSeparator: ''
                        ,anchor: '100%'
                        ,border: false
                    }
                    ,items: [{
                        columnWidth: 0.4
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'numberfield'
                            ,fieldLabel: _('marvin.location.lat')
                            ,name: 'lat'
                            ,id: this.ident +'-lat'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,allowBlank: false
                            ,allowNegative: false
                            ,decimalPrecision: 15
                        }]
                    },{
                        columnWidth: 0.4
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'numberfield'
                            ,fieldLabel: _('marvin.location.lng')
                            ,name: 'lng'
                            ,id: this.ident +'-lng'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,allowBlank: false
                            ,allowNegative: false
                            ,decimalPrecision: 15
                        }]
                    },{
                        columnWidth: 0.2
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'numberfield'
                            ,fieldLabel: _('marvin.location.zoom')
                            ,name: 'zoom'
                            ,id: this.ident +'-zoom'
                            ,itemCls: 'required'
                            ,anchor: '100%'
                            ,allowBlank: false
                            ,allowNegative: false
                            ,allowDecimals: false
                            ,value: MODx.config['marvin.default_zoom']
                        }]
                    }]
                }]
            },{
                defaults: {
                    msgTarget: 'side'
                    ,autoHeight: true
                }
                ,cls: 'form-with-labels'
                ,border: false
                ,items: [{
                    layout: 'column'
                    ,border: false
                    ,height: 100
                    ,defaults: {
                        layout: 'form'
                        ,labelAlign: 'top'
                        ,labelSeparator: ''
                        ,anchor: '100%'
                        ,border: false
                    }
                    ,items: [{
                        columnWidth: 1
                        ,border: false
                        ,defaults: {
                            msgTarget: 'under'
                        }
                        ,items: [{
                            xtype: 'marvin-panel-map'
                            ,id: this.ident + '-map'
                            ,zoomLevel: parseInt(MODx.config['marvin.default_zoom'])
                            ,gmapType: 'map'
                            ,mapControls: ['GSmallMapControl','GMapTypeControl','NonExistantControl']
                            ,mapOptions: {
                                'scrollwheel': false
                                ,'center': new google.maps.LatLng(parseFloat(MODx.config['marvin.default_lat']), parseFloat(MODx.config['marvin.default_lng']))
                            }
                            ,height: 400
                        }]
                    }]
                }]
            }]
        }];

        return items;
    }

    ,getInfoFields: function(config) {
        var fields = [];

        if (config.isUpdate) {
            fields.push({
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
            });
        }

        return fields;
    }
});
Ext.reg('marvin-panel-location',Marvin.panel.Location);