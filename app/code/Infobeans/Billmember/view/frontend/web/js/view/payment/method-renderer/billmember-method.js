/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
        [
            'Magento_Checkout/js/view/payment/default'
        ],
        function (Component) {
            'use strict';
            return Component.extend({
                defaults: {
                    template: 'Infobeans_Billmember/payment/billmember'
                },
                
                /** Returns payment method instructions */
                getInstructions: function () {
                    return window.checkoutConfig.payment.instructions[this.item.method];
                },
                /** Returns payment method instructions */
                getGetBillmemberAmount: function () {
                    return window.checkoutConfig.payment.billmemberamount[this.item.method];
                }
            });
        }
);
