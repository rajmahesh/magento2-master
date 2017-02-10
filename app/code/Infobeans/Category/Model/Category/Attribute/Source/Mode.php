<?php

namespace Infobeans\Category\Model\Category\Attribute\Source;

/**
 * Catalog product landing page attribute source
 */
class Mode extends \Magento\Catalog\Model\Category\Attribute\Source\Mode
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $dataHelper = \Magento\Framework\App\ObjectManager::getInstance()->get("\Infobeans\Category\Helper\Data");
            $isEnabled = $dataHelper->getConfig('infobeans_category_config/general/enabledisable');
            if ($isEnabled) {
                $this->_options = [
                    ['value' => \Magento\Catalog\Model\Category::DM_PRODUCT, 'label' => __('Products only')],
                    ['value' => \Magento\Catalog\Model\Category::DM_PAGE, 'label' => __('Static block only')],
                    ['value' => \Magento\Catalog\Model\Category::DM_MIXED, 'label' => __('Static block and products')],
                    ['value' => \Infobeans\Category\Model\Category::IB_FEATURED, 'label' => __('Featured products')],
                    ['value' => \Infobeans\Category\Model\Category::IB_NEW, 'label' => __('New products')],
                    ['value' => \Infobeans\Category\Model\Category::IB_ONSELL, 'label' => __('On sell products')],
                ];
            } else {
                $this->_options = [
                    ['value' => \Magento\Catalog\Model\Category::DM_PRODUCT, 'label' => __('Products only')],
                    ['value' => \Magento\Catalog\Model\Category::DM_PAGE, 'label' => __('Static block only')],
                    ['value' => \Magento\Catalog\Model\Category::DM_MIXED, 'label' => __('Static block and products')]
                ];
            }
        }
        return $this->_options;
    }
}
