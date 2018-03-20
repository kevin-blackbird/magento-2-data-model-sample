<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Teacher\Relation;


use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\TeacherStudents\Model\ResourceModel\Teacher;

/**
 * Class ReadHandler
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Teacher\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Teacher
     */
    private $resourceTeacher;

    /**
     * ReadHandler constructor.
     * @param MetadataPool $metadataPool
     * @param Teacher $resourceTeacher
     */
    public function __construct(
        MetadataPool $metadataPool,
        Teacher $resourceTeacher
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceTeacher = $resourceTeacher;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getIdTeacher()) {
            $teacherStudentId = $this->resourceTeacher->lookupStudentIds((int)$entity->getIdTeacher());
            $entity->setData('id_student', $teacherStudentId);
        }
        return $entity;
    }
}