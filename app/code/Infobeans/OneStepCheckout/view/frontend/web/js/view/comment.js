define(
    [
        'jquery',
        'ko',
        'uiComponent',
    ],
    function ($, ko, Component) {
        'use strict';
        var show_hide_custom_blockConfig = window.checkoutConfig.show_hide_custom_block;
        return Component.extend({
            defaults: {
                template: 'Infobeans_OneStepCheckout/checkout/comment'
            },
            canVisibleBlock: show_hide_custom_blockConfig
        });
    });
