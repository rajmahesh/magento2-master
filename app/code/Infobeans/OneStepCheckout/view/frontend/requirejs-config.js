var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/place-order': {
                'Infobeans_OneStepCheckout/js/model/agreements/place-order-mixin': true,
                'Infobeans_OneStepCheckout/js/model/place-order-with-comments-mixin': true
            },
            'Magento_Checkout/js/action/set-payment-information': {
                'Infobeans_OneStepCheckout/js/model/payment/place-order-mixin': true
            }
        }
    },
    map: {
        "*": {
            "Magento_Checkout/js/model/shipping-save-processor/default": "Infobeans_OneStepCheckout/js/model/shipping-save-processor/default"
        }
    }
};