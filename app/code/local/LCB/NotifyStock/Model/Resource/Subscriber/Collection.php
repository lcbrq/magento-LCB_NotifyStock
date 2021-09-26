<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Model_Resource_Subscriber_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Init the model and resource model for the current collection
     */
    protected function _construct()
    {
        $this->_init('lcb_notifystock/subscriber');
    }
}
