<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Student\Relation;


use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\TeacherStudents\Api\Data\StudentInterface;
use Blackbird\TeacherStudents\Model\ResourceModel\Student;

/**
 * Class SaveHandler
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Student\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var Student
     */
    protected $resourceStudent;

    /**
     * SaveHandler constructor.
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
     * @throws \Exception
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