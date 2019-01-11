<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 24/8/18
 * Time: 12:39 AM
 */

namespace Codilar\DeliveryTimeEstimation\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install (SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /*
         * ProductPost table 'delivery_time_estimation'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('delivery_time_estimation'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'customer_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'customer_id'
            )
            ->addColumn(
                'order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                40,
                ['unsigned' => true, 'nullable' => false],
                'order_id'
            )
            ->addColumn(
                'to_address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                40,
                ['unsigned' => true, 'nullable' => false],
                'to_address'
            )
            ->addColumn(
                'distance',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                40,
                ['unsigned' => true, 'nullable' => false],
                'distance'
            )
            ->addColumn(
                'delivery_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                40,
                ['unsigned' => true, 'nullable' => false],
                'delivery_time'
            )
            ->addColumn(
                'calculated_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                40,
                [],
                'calculated_time'
            )
            ->setComment('Delivery Time Estimation');
        $installer->getConnection()->createTable($table);



    }
}