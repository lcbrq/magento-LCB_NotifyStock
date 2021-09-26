<?php

/**
 * @category LCB
 * @package  LCB_NotifyStock
 * @author   Silpion Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_NotifyStock_Model_Observer
{
    /**
     * Log the data for the given observer model.
     *
     * @param Varien_Event_Observer $observer
     */
    public function stockChange(Varien_Event_Observer $observer)
    {
        $stockItem = $observer->getItem();
        $product = $stockItem->getProduct();
        $stockBack = $stockItem->getOrigData('is_in_stock') !== $stockItem->getIsInStock() && $stockItem->getIsInStock();
        $qtyBack = !$stockItem->getOrigData('qty') && $stockItem->getQty();
        if ($stockItem->getIsInStock() && $stockItem->getQty() && ($stockBack || $qtyBack)) {
            $sku = $product->getSku();
            $product = Mage::getModel('catalog/product');
            $product->load($product->getIdBySku($sku));
            if ($product->getId()) {
                $subscribers = Mage::getModel('lcb_notifystock/subscriber')->getCollection()
                    ->addFieldToFilter('sku', $sku);
                foreach ($subscribers as $subscriber) {
                    $customer = Mage::getModel('customer/customer')->getCollection()
                            ->addFieldToFilter('email', $subscriber->getEmail())
                            ->getFirstItem();
                    $sender = array(
                        'name' => Mage::getStoreConfig('trans_email/ident_general/name'),
                        'email' => Mage::getStoreConfig('trans_email/ident_general/email')
                    );
                    $recepientEmail = $subscriber->getEmail();
                    $recepientName = $customer->getName();
                    $storeId = 1;
                    $templateId = Mage::helper('lcb_notifystock')->getEmailTemplate($storeId);
                    $variables = array(
                        'subscriber' => $subscriber,
                        'customer' => $customer,
                        'product' => $product
                    );
                    try {
                        $result = Mage::getModel('core/email_template')->sendTransactional(
                            $templateId,
                            $sender,
                            $recepientEmail,
                            $recepientName,
                            $variables,
                            $storeId
                        );
                        if ($result->getSentSuccess()) {
                            $subscriber->delete();
                        }
                    } catch (Exception $e) {
                        Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                    }
                }
            }
        }
    }
}
