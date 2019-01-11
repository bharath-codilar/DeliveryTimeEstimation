define(
    [
        'jquery',
        'ko',
        'uiComponent'
    ],
    function ($, ko, Component) {
        return Component.extend({
            defaults: {
                template: 'Codilar_DeliveryTimeEstimation/delivery_time'
            },
            testData: window.checkoutConfig.testData,
            initialize: function () {
                this._super();
            },
        });
    }
);