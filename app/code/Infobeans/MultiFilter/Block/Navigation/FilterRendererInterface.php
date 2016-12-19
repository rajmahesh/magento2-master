<?php
namespace Infobeans\MultiFilter\Block\Navigation;

use Magento\Catalog\Model\Layer\Filter\FilterInterface;

/**
 * Interface FilterRendererInterface
 * @api
 */
interface FilterRendererInterface 
{

    /**
     * Render filter
     *
     * @param FilterInterface $filter
     * @return string
     */
    public function render(FilterInterface $filter);
}