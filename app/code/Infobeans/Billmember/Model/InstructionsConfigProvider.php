<?php

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Infobeans\Billmember\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Escaper;
use Magento\Payment\Helper\Data as PaymentHelper;

class InstructionsConfigProvider implements ConfigProviderInterface {

    /**
     * @var string[]
     */
    protected $methodCodes = [
        Billmember::PAYMENT_METHOD_BILLMEMBER_CODE,
    ];

    /**
     * @var \Magento\Payment\Model\Method\AbstractMethod[]
     */
    protected $methods = [];

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @param PaymentHelper $paymentHelper
     * @param Escaper $escaper
     */
    public function __construct(
    PaymentHelper $paymentHelper, Escaper $escaper
    ) {
        $this->escaper = $escaper;
        foreach ($this->methodCodes as $code) {
            $this->methods[$code] = $paymentHelper->getMethodInstance($code);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig() {
        $config = [];
        foreach ($this->methodCodes as $code) {
            if ($this->methods[$code]->isAvailable()) {
                $config['payment']['instructions'][$code] = $this->getInstructions($code);
                $config['payment']['billmemberamount'][$code] = $this->getGetBillmemberAmount($code);
            }
        }
        return $config;
    }

    /**
     * Get instructions text from config
     *
     * @param string $code
     * @return string
     */
    protected function getInstructions($code) {
        return nl2br($this->escaper->escapeHtml($this->methods[$code]->getInstructions()));
    }

    /**
     * Get instructions text from config
     *
     * @param string $code
     * @return string
     */
    protected function getGetBillmemberAmount($code) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $amout = $objectManager->create('\Magento\Framework\Pricing\PriceCurrencyInterface')->format($customerSession->getCustomer()->getBillMemberAmount(),true,0);
        if ($customerSession->isLoggedIn() && $customerSession->getCustomer()->getBillMemberAmount()>0) {
            return "Your billmember amout is : ".$amout;
        }
        return "Not a member";
    }

}
