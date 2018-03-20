<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Blackbird\TeacherStudents\Api\Data\StudentInterface;

/**
 * Class Student
 * @package Blackbird\TeacherStudents\Model\ResourceModel
 */
class Student extends AbstractDb
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Student constructor.
     * @param Context $context
     * @param MetadataPool $metadataPool
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        MetadataPool $metadataPool,
        EntityManager $entityManager,
        $connectionName = null
    ) {
        $this->metadataPool = $metadataPool;
        $this->entityManager = $entityManager;
        parent::__construct($context, $connectionName);
    }

    /**
     * Set the table and the primary key
     */
    protected function _construct()
    {
        $this->_init('blackbird_ts_student', StudentInterface::ID);
    }

    /**
     * Get all Teacher IDs for a student
     *
     * @param int $studentId
     * @return array
     */
    public function lookupTeacherIds($studentId)
    {
        $connection = $this->getConnection();

        $entityMetadata = $this->metadataPool->getMetadata(StudentInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['ts' => $this->getTable('blackbird_ts_teacher_students')], 'id_teacher')
            ->join(
                ['stud' => $this->getMainTable()],
                'stud.' . $linkField . ' = ts.' . $linkField,
                []
            )
            ->where('ts.' . $entityMetadata->getIdentifierField() . ' = :id_student');

        return $connection->fetchCol($select, ['id_student' => (int)$studentId]);
    }

    /**
     * {@inheritDoc}
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        return $this->entityManager->load($object, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->entityManager->delete($object);
    }
}