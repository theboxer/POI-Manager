var Marvin = function(config) {
    config = config || {};
    Marvin.superclass.constructor.call(this,config);
};
Ext.extend(Marvin,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('marvin',Marvin);
Marvin = new Marvin();
