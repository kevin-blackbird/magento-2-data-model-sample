<?php
namespace Blackbird\TeacherStudents\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'blackbird_ts_student'
         */
        if (!$installer->tableExists('blackbird_ts_student')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('blackbird_ts_student'))
                ->addColumn(
                    'id_student',
                    Table::TYPE_INTEGER,
                    11,
                    [
                        'nullable' => false,
                        'precision' => '10',
                        'auto_increment' => true,
                        'primary' => true,
                    ],
                    'Student Id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'Student Name'
                )
                ->addColumn(
                    'age',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => true,
                    ],
                    'Age'
                )
                ->setComment('Students Table');
            $installer->getConnection()->createTable($table);
        }

        /**
         * Create table 'blackbird_ts_student'
         */
        if (!$installer->tableExists('blackbird_ts_teacher')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('blackbird_ts_teacher'))
                ->addColumn(
                    'id_teacher',
                    Table::TYPE_INTEGER,
                    11,
                    [
                        'nullable' => false,
                        'precision' => '10',
                        'auto_increment' => true,
                        'primary' => true,
                    ],
                    'Teacher Id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'Teacher Name'
                )
                ->addColumn(
                    'age',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => true,
                    ],
                    'Age'
                )
                ->addColumn(
                    'classes',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'Teacher Classes'
                )
                ->setComment('Teachers Table');
            $installer->getConnection()->createTable($table);
        }

        /**
         * Create table 'blackbird_ets_preparation_time_rule_holidays_group'
         */
        if (!$installer->tableExists('blackbird_ts_teacher_students')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('blackbird_ts_teacher_students'))
                ->addColumn(
                    'id_student',
                    Table::TYPE_INTEGER,
                    11,
                    [
                        'nullable' => false,
                        'precision' => '10',
                        'primary' => true,
                    ],
                    'Student Id'
                )
                ->addColumn(
                    'id_teacher',
                    Table::TYPE_INTEGER,
                    11,
                    [
                        'nullable' => false,
                        'precision' => '10',
                        'primary' => true,
                    ],
                    'Teacher Id'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'blackbird_ts_teacher_students',
                        'id_student',
                        'blackbird_ts_student',
                        'id_student'
                    ),
                    'id_student',
                    $installer->getTable('blackbird_ts_student'),
                    'id_student',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'blackbird_ts_teacher_students',
                        'id_teacher',
                        'blackbird_ts_teacher',
                        'id_teacher'
                    ),
                    'id_teacher',
                    $installer->getTable('blackbird_ts_teacher'),
                    'id_teacher',
                    Table::ACTION_CASCADE
                )
                ->setComment('Teacher Students');
            $installer->getConnection()->createTable($table);
        }
    }
}