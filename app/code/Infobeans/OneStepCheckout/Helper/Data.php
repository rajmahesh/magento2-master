<?php

namespace Infobeans\OneStepCheckout\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const ENABLE_OSC = 'infobeans_onestepcheckout/general/enable_in_frontend';
    const META_TITLE = 'infobeans_onestepcheckout/general/osc_title';



    public function getEnable(){
        return (bool)$this->scopeConfig->getValue(self::ENABLE_OSC);
    }

    public function getMetaTitle(){
        return $this->scopeConfig->getValue(self::META_TITLE);
    }

}