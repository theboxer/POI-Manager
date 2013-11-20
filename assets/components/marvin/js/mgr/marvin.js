var Marvin = function(config) {
    config = config || {};
    Marvin.superclass.constructor.call(this,config);
};
Ext.extend(Marvin,Ext.Component,{
    page:{}
    ,window:{}
    ,grid:{}
    ,tree:{}
    ,panel:{}
    ,combo:{}
    ,config: {}
    ,renderers: {
        state: function(value, metaData, record, rowIndex, colIndex, store, objectType) {
            if (objectType != undefined) {
                return _('marvin.' + objectType + '.state_' + value);
            }

            return value;
        }
    }
});

Ext.reg('marvin',Marvin);
Marvin = new Marvin();
