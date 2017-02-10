<?php

namespace Infobeans\Category\Block\Product;

class CustomListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
 

    /**
     * Retrieve loaded category collection
     *
     * @return AbstractCollection
     */
    protected function _getProductCollection()
    {
        if ($this->_productCollection === null) {
            $layer = $this->getLayer();
            /* @var $layer \Magento\Catalog\Model\Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId($this->_storeManager->getStore()->getRootCategoryId());
            }

            // if this is a product view page
            if ($this->_coreRegistry->registry('product')) {
                // get collection of categories this product is associated with
                $categories = $this->_coreRegistry->registry('product')
                    ->getCategoryCollection()->setPage(1, 1)
                    ->load();
                // if the product is associated with any category
                if ($categories->count()) {
                    // show products from this category
                    $this->setCategoryId(current($categories->getIterator()));
                }
            }

            $origCategory = null;
            if ($this->getCategoryId()) {
                try {
                    $category = $this->categoryRepository->get($this->getCategoryId());
                } catch (NoSuchEntityException $e) {
                    $category = null;
                }

                if ($category) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                }
            }
            $this->_productCollection = $layer->getProductCollection();
            
            // Added custom filter
            $dataHelper = \Magento\Framework\App\ObjectManager::getInstance()->get("\Infobeans\Category\Helper\Data");
            $isEnabled = $dataHelper->getConfig('infobeans_category_config/general/enabledisable');
            if ($isEnabled) {
                $displayMode = $this->_coreRegistry->registry('current_category')->getDisplayMode();
                if ($displayMode == "FEATURED_PRODUCTS") {
                    $this->_productCollection->addAttributeToFilter('is_featured', '1');
                } else if ($displayMode == "NEW_PRODUCTS") {
                    $todayStartOfDayDate = $this->_localeDate->date()->setTime(0, 0, 0)->format('Y-m-d H:i:s');
                    $todayEndOfDayDate = $this->_localeDate->date()->setTime(23, 59, 59)->format('Y-m-d H:i:s');
                    $this->_productCollection->addAttributeToFilter(
                        'news_from_date',
                        [
                            'or' => [
                                0 => ['date' => true, 'to' => $todayEndOfDayDate],
                                1 => ['is' => new \Zend_Db_Expr('null')],
                            ]
                        ],
                        'left'
                    )->addAttributeToFilter(
                        'news_to_date',
                        [
                            'or' => [
                                0 => ['date' => true, 'from' => $todayStartOfDayDate],
                                1 => ['is' => new \Zend_Db_Expr('null')],
                            ]
                        ],
                        'left'
                    )->addAttributeToFilter(
                        [
                            ['attribute' => 'news_from_date', 'is' => new \Zend_Db_Expr('not null')],
                            ['attribute' => 'news_to_date', 'is' => new \Zend_Db_Expr('not null')],
                        ]
                    );
                } else if ($displayMode == "ONSELL_PRODUCTS") {
                    // Update later
                }

                $this->_productCollection->getSize();
            }
            
            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            }
        }

        return $this->_productCollection;
    }
}
