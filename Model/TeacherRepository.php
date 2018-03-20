<?php

namespace Blackbird\TeacherStudents\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Blackbird\TeacherStudents\Api\Data;
use Blackbird\TeacherStudents\Api\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    /**
     * @var ResourceModel\Teacher
     */
    protected $resourceTeacher;

    /**
     * @var Data\TeacherInterfaceFactory
     */
    protected $teacherFactory;

    /**
     * TeacherRepository constructor.
     * @param ResourceModel\Teacher $resourceTeacher
     * @param Data\TeacherInterfaceFactory $teacherFactory
     */
    function __construct(
        ResourceModel\Teacher $resourceTeacher,
        Data\TeacherInterfaceFactory $teacherFactory
    ) {
        $this->resourceTeacher = $resourceTeacher;
        $this->teacherFactory = $teacherFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->save($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($teacherId)
    {
        $teacher = $this->teacherFactory->create();
        $this->resourceTeacher->load($teacher, $teacherId);
        if (!$teacher->getId()) {
            throw new NoSuchEntityException(__('Teacher with id "%1" does not exist', $teacherId));
        }
        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->delete($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($teacherId)
    {
        return $this->delete($this->getById($teacherId));
    }
}