define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote'
    ],
    function (Component, quote) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Infobeans_OneStepCheckout/summary/giftwrap'
            },
            totals: quote.getTotals(),
            isDisplayed: function() {
                return this.isFullMode() && this.getPureValue() != 0;
            },
            getPureValue: function() {
                var price = 0;
                if (this.totals().total_segments) {
                    var totals = this.totals().total_segments;
                    for(var key in totals) {
                        if(totals[key].code == 'ib-osc_giftwrap') {
                            price = parseFloat(totals[key].value);
                        }
                    }
                }
                return price;
            },
            getValue: function() {
                return this.getFormattedPrice(this.getPureValue());
            }
        });
    }
);
