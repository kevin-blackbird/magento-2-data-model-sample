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
namespace Blackbird\DataModelSample\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Blackbird\DataModelSample\Api\Data;
use Blackbird\DataModelSample\Api\StudentRepositoryInterface;
use Blackbird\DataModelSample\Model\ResourceModel;

/**
 * Class StudentRepository
 * @package Blackbird\DataModelSample\Model
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @var \Blackbird\DataModelSample\Model\ResourceModel\Student
     */
    private $resourceStudent;

    /**
     * @var \Blackbird\DataModelSample\Api\Data\StudentInterfaceFactory
     */
    private $studentFactory;

    /**
     * @param \Blackbird\DataModelSample\Model\ResourceModel\Student $resourceStudent
     * @param \Blackbird\DataModelSample\Api\Data\StudentInterfaceFactory $studentFactory
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
