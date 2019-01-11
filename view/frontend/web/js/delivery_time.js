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
            distance: window.checkoutConfig.distance,
            time: window.checkoutConfig.time,
            initialize: function () {
                this._super();
            },
        });
    }
);