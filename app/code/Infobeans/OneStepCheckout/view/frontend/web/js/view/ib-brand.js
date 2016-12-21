define(
    [
        'ko',
        'jquery',
        'uiComponent'
    ],
    function (ko, $, Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Infobeans_OneStepCheckout/checkout/ib-brand'
            }

        });
    }
);
