<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Adminhtml_SubscriberController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('lcb_notifystock');
    }

    /**
     * @return LCB_NotifyStock_Adminhtml_SubscriberController
     */
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("lcb_notifystock/subscriber")->_addBreadcrumb(
            Mage::helper("lcb_notifystock")->__("Notify Stock"),
            Mage::helper("lcb_notifystock")->__("Subscribers")
        );
        return $this;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__("Notify Stock"));

        $this->_initAction();
        $this->renderLayout();
    }
    
    /**
     * @return void
     */
    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel("lcb_notifystock/subscriber");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Subscribers(s) were successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
}
