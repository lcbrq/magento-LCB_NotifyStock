<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->getConnection()->createTable(
    $installer->getConnection()->newTable($installer->getTable('lcb_notifystock_subscriber'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
             'identity' => true,
             'unsigned' => true,
             'nullable' => false,
             'primary'  => true,
        ), 'Entity Id')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array('nullable' => false), 'Email')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array('nullable' => false), 'SKU')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array('nullable' => false), 'Store Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(), 'Created At')
);

$installer->endSetup();
