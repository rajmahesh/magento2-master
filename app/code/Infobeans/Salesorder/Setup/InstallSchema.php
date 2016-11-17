<?php
/**
 * Copyright © 2015 Infobeans. All rights reserved.
 */

namespace Infobeans\Salesorder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
	
        $setup->startSetup();

        /**
         * Create table 'salesorder_observer'
         */
        $setup->getConnection()->addColumn(
                $setup->getTable('sales_order_grid'), 'product_types', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'comment' => 'Product Types'
                ]
        );

        $setup->endSetup();

    }
}
