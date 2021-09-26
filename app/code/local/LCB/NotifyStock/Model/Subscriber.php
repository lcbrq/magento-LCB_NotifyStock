<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Model_Subscriber extends Mage_Core_Model_Abstract
{
    /**
     * Init the resource model and resource collection model
     */
    protected function _construct()
    {
        $this->_init('lcb_notifystock/subscriber');
    }

    /**
     * Append created_at date
     */
    protected function _beforeSave()
    {
        if (!(bool) $this->getData('created_at')) {
            $this->setData('created_at', Varien_Date::now());
        }

        return parent::_beforeSave();
    }
}
