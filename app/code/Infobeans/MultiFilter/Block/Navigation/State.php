<?php
namespace Infobeans\MultiFilter\Block\Navigation;

class State extends \Magento\LayeredNavigation\Block\Navigation\State 
{

    /**
     * Catalog layer
     *
     * @var \Magento\Catalog\Model\Layer
     */
    protected $_catalogLayer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param array $data
     */
    public function __construct(
		\Magento\Framework\View\Element\Template\Context $context, 
		\Magento\Catalog\Model\Layer\Resolver $layerResolver, 
		array $data = []
    ) {
        $this->_catalogLayer = $layerResolver->get();
        parent::__construct($context,$layerResolver,$data);
    }
}