<?php

namespace Infobeans\SocialLogin\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Social extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('infobeans_social_customer', 'social_customer_id');
    }
}