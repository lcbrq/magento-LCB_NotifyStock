<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Block_Adminhtml_Subscriber extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = "adminhtml_subscriber";
        $this->_blockGroup = "lcb_notifystock";
        $this->_headerText = Mage::helper("lcb_notifystock")->__("Subscribers");
        parent::__construct();
        $this->_removeButton('add');
    }
}
