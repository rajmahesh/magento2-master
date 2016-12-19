<?php
namespace Infobeans\MultiFilter\Block\Navigation;

use Magento\Catalog\Model\Layer\Filter\FilterInterface;
use Magento\Framework\View\Element\Template;
use Infobeans\MultiFilter\Block\Navigation\FilterRendererInterface;

class FilterRenderer extends Template implements FilterRendererInterface 
{
    const MINPRICE = 0;
    const MAXPRICE = 0;
    const GENERICPRICE = 10000000000;
    /**
     * Logging instance
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    public function __construct(
		Template\Context $context, 
		\Infobeans\MultiFilter\Helper\Data $helper, 
		\Psr\Log\LoggerInterface $logger, 
		array $data = array()
	) {

        parent::__construct($context, $data);
        $this->_logger = $logger;
    }

    /**
     * @param FilterInterface $filter
     * @return string
     */
    public function render(FilterInterface $filter) {
        $this->assign('filter', $filter);
        $this->assign('filterItems', $filter->getItems());
        $html = $this->_toHtml();
        $this->assign('filterItems', []);
        return $html;
    }
    /**
     * Function to get min max price range of current filter
     *
     * @param $filter: filter instance
     * @return array of filter price
     */
    public function getPriceRange($filter) {
        $filterPrice = array('min' => self::MINPRICE, 'max' => self::MAXPRICE);
        
		if ($filter->getName() == 'Price') {
            $priceArr = $filter->getResource()->loadPrices(self::GENERICPRICE);
            $filterPrice['min'] = reset($priceArr);
            $filterPrice['max'] = end($priceArr);
        }
        return $filterPrice;
    }
    /**
     * Function to get filter url
     *
     * @param $filter: filter instance
     * @return filter url
     */
    public function getFilterUrl($filter) {
        $query = ['price' => ''];
        return $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true, '_query' => $query]);
    }
}