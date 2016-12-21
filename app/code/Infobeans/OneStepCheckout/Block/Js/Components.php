<?php

namespace Infobeans\OneStepCheckout\Block\Js;

use Magento\Customer\Model\Url;
use Magento\Framework\View\Element\Template;

class Components extends \Magento\Framework\View\Element\Template
{

    const DISCOUNTS_ENABLE = 'infobeans_onestepcheckout/general/ib_discount_enable';

    public function getDiscountsEnable() {
        return true;
        return $this->_scopeConfig->getValue(self::DISCOUNTS_ENABLE);
    }
}