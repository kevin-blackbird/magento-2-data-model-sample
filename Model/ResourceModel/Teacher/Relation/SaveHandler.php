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
namespace Blackbird\DataModelSample\Model\ResourceModel\Teacher\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\DataModelSample\Api\Data\TeacherInterface;
use Blackbird\DataModelSample\Model\ResourceModel\Teacher;

/**
 * Class SaveHandler
 * @package Blackbird\DataModelSample\Model\ResourceModel\Teacher\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var \Magento\Framework\EntityManager\MetadataPool
     */
    private $metadataPool;

    /**
     * @var \Blackbird\DataModelSample\Model\ResourceModel\Teacher
     */
    private $resourceTeacher;

    /**
     * @param \Magento\Framework\EntityManager\MetadataPool $metadataPool
     * @param \Blackbird\DataModelSample\Model\ResourceModel\Teacher $resourceTeacher
     */
    public function __construct(
        MetadataPool $metadataPool,
        Teacher $resourceTeacher
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceTeacher = $resourceTeacher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(TeacherInterface::class);
        $linkField      = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldStudents = $this->resourceTeacher->lookupStudentIds((int)$entity->getTeacherId());
        $newStudents = (array)$entity->getStudentIds();

        $table = $this->resourceTeacher->getTable('blackbird_ts_teacher_students');

        $delete = array_diff($oldStudents, $newStudents);
        if ($delete) {
            $where = [
                $linkField . ' = ?'        => $entity->getIdTeacher(),
                'id_student IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStudents, $oldStudents);
        if ($insert) {
            $data = [];
            foreach ($insert as $studentId) {
                $data[] = [
                    $linkField          => $entity->getIdTeacher(),
                    'id_student' => (int)$studentId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
