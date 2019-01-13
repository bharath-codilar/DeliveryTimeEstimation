<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $this->addTableColumnIfNotExists($setup, $setup->getTable('quote'), "latitude", [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Latitude'
            ]);

            $this->addTableColumnIfNotExists($setup, $setup->getTable('quote'), "longitude", [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Longitude'
            ]);

            $this->addTableColumnIfNotExists($setup, $setup->getTable('sales_order'), "latitude", [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Latitude'
            ]);

            $this->addTableColumnIfNotExists($setup, $setup->getTable('sales_order'), "longitude", [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Longitude'
            ]);
        }
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $table
     * @param string $columnName
     * @param array $data
     */
    protected function addTableColumnIfNotExists(SchemaSetupInterface $setup, string $table, string $columnName, $data = []) {
        if (!$setup->getConnection()->tableColumnExists($table, $columnName)) {
            $setup->getConnection()->addColumn($table, $columnName, $data);
        }
    }
}