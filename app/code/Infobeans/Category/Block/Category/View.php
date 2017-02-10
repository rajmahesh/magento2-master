<?php
namespace Infobeans\Category\Block\Category;

use \Magento\Catalog\Block\Product\ListProduct;

class View extends \Magento\Catalog\Block\Product\AbstractProduct 
{

    protected $_productcollection;
    

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
	\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productcollection
    ) {
        $this->_productcollection = $productcollection;
        parent::__construct($context);
    }
    
//    protected function _prepareLayout()
//    {
//        parent::_prepareLayout();
//        $this->pageConfig->getTitle()->set(__('Featured Products'));
//
//
//        if ($this->getFeaturedProduct()) {
//            $pager = $this->getLayout()->createBlock(
//                'Magento\Theme\Block\Html\Pager',
//                'ib.featured.pager'
//            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
//                $this->getFeaturedProduct()
//            );
//            $this->setChild('pager', $pager);
//            $this->getFeaturedProduct()->load();
//        }
//        return $this;
//    }
//    
//    public function getPagerHtml()
//    {
//        return $this->getChildHtml('pager');
//    }
    
    public function getFeaturedProduct(){ 
        
//        //get values of current page
//        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
//        //get values of current limit
//        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest
//        ()->getParam('limit') : 5;
        
        $toolbar = $this->getToolbarBlock();
        $category = $this->getCurrentCategory();
        $categoryId = $category->getId();
        $collection =  $this->_productcollection->create()
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('status', '1')
                        ->addAttributeToFilter('is_featured', '1');
        $collection->addCategoriesFilter(['eq' => $categoryId]);
//        $collection->setPageSize($pageSize);
//        $collection->setCurPage($page);
        
//      $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());	
//	$collection = $this->_addProductAttributesAndPrices($collection);
                            
		
        return $collection;
    }
    
    public function getCurrentCategory()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->get('Magento\Framework\Registry')->registry('current_category');
        return $category;
    }

	
}
