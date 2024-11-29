<?php
namespace Eleafus\Tips\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('sales_order');
        $connection = $setup->getConnection();

        // Add tips column
        $connection->addColumn(
            $tableName,
            'tips',
            [
                'type' => Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable' => true,
                'comment' => 'Order Tips'
            ]
        );

        // Add clover_id column
        $connection->addColumn(
            $tableName,
            'clover_id',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Clover ID'
            ]
        );

        $setup->endSetup();
    }
}
