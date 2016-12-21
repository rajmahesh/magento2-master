<?php
/**
 * Copyright © 2015 Customer Paradigm. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Infobeans\OneStepCheckout\Model\CustomBlock;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;

class CustomBlock implements ConfigProviderInterface
{
    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    protected $scopeConfiguration;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
    ) {
        $this->scopeConfiguration = $scopeConfiguration;
    }

    /**
     * @return array() $showHide
     */
    public function getConfig()
    {
        /** @var array() $showHide */
        $showHide = [];
        /** @var boolean $enabled */
        $enabled = $this->scopeConfiguration
            ->getValue('infobeans_onestepcheckout/general/onepage_checkout_customblock_enabled', ScopeInterface::SCOPE_STORE);
        $showHide['show_hide_custom_block'] = ($enabled) ? true:false;
        return $showHide;
    }
}