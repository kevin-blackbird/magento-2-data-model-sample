<?php

namespace Blackbird\TeacherStudents\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Blackbird\TeacherStudents\Api\Data;
use Blackbird\TeacherStudents\Api\StudentRepositoryInterface;
use Blackbird\TeacherStudents\Model\ResourceModel;

/**
 * Class StudentRepository
 * @package Blackbird\TeacherStudents\Model
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @var ResourceModel\Student
     */
    protected $resourceStudent;

    /**
     * @var Data\StudentInterfaceFactory
     */
    protected $studentFactory;

    /**
     * StudentRepository constructor.
     * @param ResourceModel\Student $resourceStudent
     * @param Data\StudentInterfaceFactory $studentFactory
     */
    function __construct(
        ResourceModel\Student $resourceStudent,
        Data\StudentInterfaceFactory $studentFactory
    ) {
        $this->resourceStudent = $resourceStudent;
        $this->studentFactory = $studentFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Data\StudentInterface $student)
    {
        try {
            $this->resourceStudent->save($student);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($studentId)
    {
        $student = $this->studentFactory->create();
        $this->resourceStudent->load($student, $studentId);
        if (!$student->getId()) {
            throw new NoSuchEntityException(__('Student with id "%1" does not exist', $studentId));
        }
        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Data\StudentInterface $student)
    {
        try {
            $this->resourceStudent->delete($student);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($studentId)
    {
        return $this->delete($this->getById($studentId));
    }

}