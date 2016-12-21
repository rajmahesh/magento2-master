<?php

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * OfflinePayments Observer
 */
namespace Infobeans\Billmember\Observer;
use Magento\Framework\Event\ObserverInterface;

class Paymentloadbefore implements ObserverInterface {

    public function __construct(
    \Psr\Log\LoggerInterface $logger, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $this->testlog = $logger;
    }

    /**
     * Sets current instructions for bank transfer account
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $event = $observer->getEvent();
        $method = $event->getMethodInstance();
        $result = $event->getResult();
//        $this->testlog->info($method->getCode());
        
        /*Get cart grand total amount*/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        $grandTotal = $cart->getQuote()->getGrandTotal();
        
        /*Get customer billmember amount*/
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $amout = (int) $customerSession->getCustomer()->getBillMemberAmount();
        
        $isLogged = $customerSession->isLoggedIn();
        if (!$isLogged && $grandTotal >= $amout) {
            if ($method->getCode() == 'billmember') {
                $result->setData('is_available', false);
            }
        }
    }

}
