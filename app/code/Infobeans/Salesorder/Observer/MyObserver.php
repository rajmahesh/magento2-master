<?php

namespace Infobeans\Salesorder\Observer;
use Magento\Catalog\Model\Product;

use Magento\Framework\Event\Observer;

use Magento\Framework\Event\ObserverInterface;
class MyObserver implements ObserverInterface{

    public function execute(\Magento\Framework\Event\Observer $observer){
        $order = $observer->getEvent()->getOrder();
        $productType = array();
        foreach ($order->getAllVisibleItems() as $item) {
            if(!in_array($item->getProductType(), $productType)){
                $productType []=$item->getProductType();
            }
        }
        $order->setProductTypes(implode(", ", $productType));
    }
}
