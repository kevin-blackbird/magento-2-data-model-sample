<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Teacher\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\TeacherStudents\Api\Data\TeacherInterface;
use Blackbird\TeacherStudents\Model\ResourceModel\Teacher;

/**
 * Class SaveHandler
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Teacher\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var Teacher
     */
    protected $resourceTeacher;

    /**
     * SaveHandler constructor.
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
     * @throws \Exception
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