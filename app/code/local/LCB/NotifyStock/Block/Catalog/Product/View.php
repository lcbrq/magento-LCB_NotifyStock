<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Block_Catalog_Product_View extends Mage_Core_Block_Template
{
    
    /**
     * @return Mage_Model_Catalog_Product|null
     */
    public function getProduct()
    {
        return Mage::registry('current_product');
    }
    
    /**
     * @return int
     */
    public function getSubscribers()
    {
        return Mage::helper('lcb_notifystock')->countSubscribersForProduct($this->getProduct()->getSku());
    }
}
