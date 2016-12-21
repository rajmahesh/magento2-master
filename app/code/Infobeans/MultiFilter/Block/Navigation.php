<?php
namespace Infobeans\MultiFilter\Block;
use Magento\Framework\View\Element\Template;

class Navigation extends \Magento\LayeredNavigation\Block\Navigation 
{
    /**
     * @param Template\Context $context
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \Magento\Catalog\Model\Layer\FilterList $filterList
     * @param \Magento\Catalog\Model\Layer\AvailabilityFlagInterface $visibilityFlag
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Model\Layer\FilterList $filterList,
        \Magento\Catalog\Model\Layer\AvailabilityFlagInterface $visibilityFlag,
        array $data = []
    ) {
        parent::__construct(
			$context,
			$layerResolver,
			$filterList,
			$visibilityFlag,
			$data
		);
    }   
}