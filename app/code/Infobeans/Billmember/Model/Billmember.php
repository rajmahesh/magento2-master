<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Infobeans\Billmember\Model;

/**
 * Cash on delivery payment method model
 *
 * @method \Magento\Quote\Api\Data\PaymentMethodExtensionInterface getExtensionAttributes()
 */
class Billmember extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_BILLMEMBER_CODE = 'billmember';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_BILLMEMBER_CODE;

    /**
     * Cash On Delivery payment block paths
     *
     * @var string
     */
    protected $_formBlockType = 'Infobeans\Billmember\Block\Form\Billmember';

    /**
     * Info instructions block path
     *
     * @var string
     */
    protected $_infoBlockType = 'Infobeans\Billmember\Block\Info\Instructions';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions_billmember'));
    }
}
