<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function subscribeAction()
    {
        $result = array('success' => false, 'responseText' => '');

        $email = $this->getRequest()->getParam('email');
        $sku = $this->getRequest()->getParam('sku');
        
        if ($email && $sku) {
            try {
                $result = array('success' => true, 'message' => Mage::helper('lcb_notifystock')->__('Alert subscription was saved successfully'));

                $subscriber = Mage::getModel('lcb_notifystock/subscriber')->getCollection()
                    ->addFieldToFilter('email', $email)
                    ->addFieldToFilter('sku', $sku)
                    ->getFirstItem();

                if (!$subscriber->getId()) {
                    $subscriber = Mage::getModel('lcb_notifystock/subscriber');
                    $subscriber->setEmail($email);
                    $subscriber->setSku($sku);
                    $subscriber->setStoreId(Mage::app()->getStore()->getId());
                    $subscriber->save();
                }
            } catch (\Exception $e) {
                $result = array('success' => false);
            }
        }
        
        $this->getResponse()->clearHeaders()->setHeader('Content-type', 'application/json', true);
        $this->getResponse()->setBody(json_encode($result));
    }
}
