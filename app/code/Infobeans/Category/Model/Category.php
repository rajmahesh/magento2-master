<?php

namespace Infobeans\Category\Model;

/**
 * Catalog product landing page attribute source
 */
class Category extends \Magento\Catalog\Model\Category
{

    const IB_FEATURED = 'FEATURED_PRODUCTS';
    const IB_NEW = 'NEW_PRODUCTS';
    const IB_ONSELL = 'ONSELL_PRODUCTS';

}
