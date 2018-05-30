<?php
/**
 * Blackbird Data Model Sample Module
 *
 * NOTICE OF LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 *
 * @category    Blackbird
 * @package     Blackbird_DataModelSample
 * @copyright   Copyright (c) 2018 Blackbird (https://black.bird.eu)
 * @author      Blackbird Team
 * @license     MIT
 * @support     help@bird.eu
 */
namespace Blackbird\DataModelSample\Model\ResourceModel\Student\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\DataModelSample\Api\Data\StudentInterface;
use Blackbird\DataModelSample\Model\ResourceModel\Student;

/**
 * Class SaveHandler
 * @package Blackbird\DataModelSample\Model\ResourceModel\Student\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var \Magento\Framework\EntityManager\MetadataPool
     */
    private $metadataPool;

    /**
     * @var \Blackbird\DataModelSample\Model\ResourceModel\Student
     */
    protected $resourceStudent;

    /**
     * @param \Magento\Framework\EntityManager\MetadataPool $metadataPool
     * @param \Blackbird\DataModelSample\Model\ResourceModel\Student $resourceStudent
     */
    public function __construct(
        MetadataPool $metadataPool,
        Student $resourceStudent
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceStudent = $resourceStudent;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(StudentInterface::class);
        $linkField      = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldTeachers = $this->resourceStudent->lookupTeacherIds((int)$entity->getIdStudent());
        $newTeacher = (array)$entity->getTeacherIds();

        $table = $this->resourceStudent->getTable('blackbird_ts_teacher_students');

        $delete = array_diff($oldTeachers, $newTeacher);
        if ($delete) {
            $where = [
                $linkField . ' = ?'        => $entity->getIdStudent(),
                'id_teacher IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newTeacher, $oldTeachers);
        if ($insert) {
            $data = [];
            foreach ($insert as $teacherId) {
                $data[] = [
                    $linkField          => $entity->getIdStudent(),
                    'id_teacher' => (int)$teacherId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
