<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    /**
     * @var string
     */
    const XML_PATH_EMAIL_TEMPLATE = 'sales_email/notifystock/subscriber_template';
    
    /**
     * Get email template from admin
     *
     * @param int $store
     * @return string
     */
    public function getEmailTemplate($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE, $store);
    }
    
    /**
     * Count subscribers for particular product
     *
     * @param string $sku
     * @return int
     */
    public function countSubscribersForProduct($sku)
    {
        return Mage::getModel('lcb_notifystock/subscriber')
                ->getCollection()
                ->addFieldToFilter('sku', $sku)
                ->getSize();
    }
}
