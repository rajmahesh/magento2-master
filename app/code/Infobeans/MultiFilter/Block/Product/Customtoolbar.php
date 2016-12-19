<?php
namespace Infobeans\MultiFilter\Block\Product;

use Magento\Catalog\Helper\Product\ProductList;
use Magento\Catalog\Model\Product\ProductList\Toolbar as ToolbarModel;

class Customtoolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar 
{

    /**
     * Products collection
     *
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected $_collection = null;

    /**
     * List of available order fields
     *
     * @var array
     */
    protected $_availableOrder = null;

    /**
     * List of available view types
     *
     * @var array
     */
    protected $_availableMode = [];

    /**
     * Is enable View switcher
     *
     * @var bool
     */
    protected $_enableViewSwitcher = true;

    /**
     * Is Expanded
     *
     * @var bool
     */
    protected $_isExpanded = true;

    /**
     * Default Order field
     *
     * @var string
     */
    protected $_orderField = null;

    /**
     * Default direction
     *
     * @var string
     */
    protected $_direction = ProductList::DEFAULT_SORT_DIRECTION;

    /**
     * Default View mode
     *
     * @var string
     */
    protected $_viewMode = null;

    /**
     * @var bool $_paramsMemorizeAllowed
     */
    protected $_paramsMemorizeAllowed = true;

    /**
     * @var string
     */
    protected $_template = 'product/list/toolbar.phtml';

    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     */
    protected $_catalogConfig;

    /**
     * Catalog session
     *
     * @var \Magento\Catalog\Model\Session
     */
    protected $_catalogSession;

    /**
     * @var ToolbarModel
     */
    protected $_toolbarModel;

    /**
     * @var ProductList
     */
    protected $_productListHelper;

    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $_postDataHelper;

    /**
     *
     * @var \Magento\Framework\Session\Generic
     */
    public $multifilterSession;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    public $coreRegistry = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\Session $catalogSession
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @param ToolbarModel $toolbarModel
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param ProductList $productListHelper
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param array $data
     */
    public function __construct(
		\Magento\Framework\View\Element\Template\Context $context, 
		\Magento\Catalog\Model\Session $catalogSession, 
		\Magento\Catalog\Model\Config $catalogConfig, 
		ToolbarModel $toolbarModel, 
		\Magento\Framework\Url\EncoderInterface $urlEncoder, 
		ProductList $productListHelper, 
		\Magento\Framework\Data\Helper\PostHelper $postDataHelper,
		\Magento\Framework\Session\Generic $multifilterSession,
		\Magento\Framework\Registry  $coreRegistry,
		array $data = []
    ) {
        $this->multifilterSession = $multifilterSession;
        $this->coreRegistry = $coreRegistry;
        
		parent::__construct(
			$context, 
			$catalogSession, 
			$catalogConfig, 
			$toolbarModel, 
			$urlEncoder, 
			$productListHelper, 
			$postDataHelper, 
			$data
		);
    }

    /**
     * Function to getPagerHtml to create custom pagination for ajax block
     * @return pager block instance
     */
    public function getPagerHtml() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $categories = $this->coreRegistry ->registry('catagories');
        $attributes = $this->coreRegistry ->registry('attributes');
        $type = $this->multifilterSession->getType();
        
		if ($type == 'custom') {
            $pagerBlock = $this->getChildBlock('product_list_toolbar_pager');
            $implodeArr = $objectManager->get('Infobeans\MultiFilter\Controller\Category\View')
										->getProducts($categories, $attributes);
            
			$activeLimit= $this->multifilterSession->setActiveLimit();
            $activeSort = $this->multifilterSession->getActiveSort();
            
			$collection = $objectManager->get('Infobeans\MultiFilter\Controller\Category\View')
										->getParentCollection($implodeArr, $activeLimit, $activeSort);
            
			if ($pagerBlock instanceof \Magento\Framework\DataObject) {
                /* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
                $pagerBlock->setCollection(
                        $collection
                );

                return $pagerBlock->toHtml();
            }
        } else {
            return parent::getPagerHtml();
        }
    }
}