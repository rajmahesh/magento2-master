define([
    'uiComponent'
], function (Component) {
    'use strict';
    var show_hide_custom_blockConfig = window.checkoutConfig.show_hide_custom_block;
    return Component.extend({
        defaults: {
            template: 'Infobeans_OneStepCheckout/checkout/custom-block'
        },
        canVisibleBlock: show_hide_custom_blockConfig
    });
});
