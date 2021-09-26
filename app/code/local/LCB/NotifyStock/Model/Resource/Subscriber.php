<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Model_Resource_Subscriber extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Init the main table and the id field name
     */
    protected function _construct()
    {
        $this->_init('lcb_notifystock/subscriber', 'entity_id');
    }
}
