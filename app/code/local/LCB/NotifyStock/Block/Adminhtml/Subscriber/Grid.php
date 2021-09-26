<?php

/**
 * @category   LCB
 * @package    LCB_NotifyStock
 * @author Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Block_Adminhtml_Subscriber_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("notifystockSubscriberGrids");
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    /**
     * @inheritDoc
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel("lcb_notifystock/subscriber")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @inheritDoc
     */
    protected function _prepareColumns()
    {
        $this->addColumn("id", array(
            "header" => Mage::helper("lcb_notifystock")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "entity_id",
        ));

        $this->addColumn("email", array(
            "header" => Mage::helper("lcb_notifystock")->__("Email"),
            "index" => "email",
        ));

        $this->addColumn("product", array(
            "header" => Mage::helper("lcb_notifystock")->__("Product"),
            "index" => "sku",
        ));

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return '#';
    }

    /**
     * @inheritDoc
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_subscribers', array(
            'label' => Mage::helper('lcb_notifystock')->__('Remove subscribers'),
            'url' => $this->getUrl('lcb_notifystock/adminhtml_subscriber/massRemove'),
            'confirm' => Mage::helper('lcb_notifystock')->__('Are you sure?')
        ));
        return $this;
    }
}
