Marvin.panel.Map = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        zoomField: Ext.getCmp('marvin-panel-location-zoom')
        ,latField: Ext.getCmp('marvin-panel-location-lat')
        ,lngField: Ext.getCmp('marvin-panel-location-lng')
    });
    Marvin.panel.Map.superclass.constructor.call(this,config);

    this.on('mapready', this.setup);
};
Ext.extend(Marvin.panel.Map,Ext.ux.GMapPanel, {
    setup: function() {
        google.maps.event.addListener(this.gmap, 'rightclick', this.addLatLng.createDelegate(this));
        google.maps.event.addListener(this.gmap, 'zoom_changed', this.updateZoom.createDelegate(this));
//        google.maps.event.addListener(this.gmap, 'dragend', this.setLatLng.createDelegate(this));
    }
    ,marker: null

    ,setMarkerPosition: function(lat, lng) {
        var point = {latLng: new google.maps.LatLng(lat, lng)};

        if (this.marker) {
            this.marker.setPosition(point.latLng);
        } else {
            this.addLatLng(point);
        }
    }

    ,addLatLng: function (point){
        if(this.marker) {
            this.marker.setMap(null);
        }

        this.marker = new google.maps.Marker({
            map: this.gmap,
            draggable: true,
            // animation: google.maps.Animation.DROP,
            position: point.latLng
        });

        google.maps.event.addListener(this.marker, 'dragend', this.setLatLng.createDelegate(this));

        new_lat = point.latLng.lat().toFixed(6);
        new_lng = point.latLng.lng().toFixed(6);
        this.setLatLng(point);
    }

    ,updateZoom: function() {
        this.zoomField.setValue(this.gmap.getZoom());
    }

    ,setZoom: function(zoom) {
        this.gmap.setZoom(zoom);
    }

    ,setLatLng: function(point) {
        this.latField.setValue(point.latLng.ob);
        this.lngField.setValue(point.latLng.pb);
    }
});
Ext.reg('marvin-panel-map',Marvin.panel.Map);

