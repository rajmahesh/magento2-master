<?php

namespace Infobeans\Category\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Catalog data helper
 */
class Data extends AbstractHelper
{

    /**
     * Get config of product slider
     * @param $configPath
     * @param null $store
     * @return mixed
     */
    public function getConfig($configPath, $store = null)
    {
        return $this->scopeConfig->getValue(
                $configPath,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $store
        );
    }
    
    /**
    * Get feature product module enabled in admin and in configuration file
    * @param null $store
    * @return bool
    */

    public function isEnabled($store = null)
    {
        $isModuleEnabled       = $this->isModuleEnabled();
        $isModuleOutputEnabled = $this->isModuleOutputEnabled();

        return $isModuleOutputEnabled && $isModuleEnabled && $this->getConfig(self::GENERAL_IS_ENABLED, $store);
    }

    /**
     * Get feature product module enabled in configuration file
     * @return bool
     */

    public function isModuleEnabled()
    {
        $moduleName = "Infobeans_Category";

        return $this->_moduleManager->isEnabled($moduleName);
    }
}
