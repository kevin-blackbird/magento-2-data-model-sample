<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Student\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\TeacherStudents\Model\ResourceModel\Student;

/**
 * Class ReadHandler
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Student\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Student
     */
    private $resourceStudent;

    /**
     * ReadHandler constructor.
     * @param MetadataPool $metadataPool
     * @param Student $resourceStudent
     */
    public function __construct(
        MetadataPool $metadataPool,
        Student $resourceStudent
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceStudent = $resourceStudent;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getIdStudent()) {
            $studentTeacherId = $this->resourceStudent->lookupTeacherIds((int)$entity->getIdStudent());
            $entity->setData('id_teacher', $studentTeacherId);
        }
        return $entity;
    }
}