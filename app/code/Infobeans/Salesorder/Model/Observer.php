<?php

namespace Company\Vendors\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Observer implements ObserverInterface {

    public function execute(Observer $observer) {
        die('testing');
      }
}

