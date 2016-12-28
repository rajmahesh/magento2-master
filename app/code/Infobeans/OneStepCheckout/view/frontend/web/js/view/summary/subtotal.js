/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*global define*/
define(
    [
        'Infobeans_OneStepCheckout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote'
    ],
    function (Component, quote) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Infobeans_OneStepCheckout/summary/subtotal'
            },
            getPureValue: function() {
                var totals = quote.getTotals()();
                if (totals) {
                    return totals.subtotal;
                }
                return quote.subtotal;
            },
            getValue: function () {
                return this.getFormattedPrice(this.getPureValue());
            }

        });
    }
);