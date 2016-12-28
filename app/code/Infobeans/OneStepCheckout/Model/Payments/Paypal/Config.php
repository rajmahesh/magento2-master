<?php

namespace Infobeans\OneStepCheckout\Model\Payments\Paypal;

use \Magento\Paypal\Model\Config as paypalConfig;

class Config extends paypalConfig{

    public function getBuildNotationCode()
    {
        return '';

    }
}